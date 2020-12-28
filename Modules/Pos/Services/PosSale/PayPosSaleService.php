<?php

namespace Modules\Pos\Services\PosSale;

use Modules\Pos\Entities\PosSale;
use Illuminate\Http\Request;
use Modules\Pos\Services\PosSale\CheckPosSaleService;
use Modules\Pos\Entities\PosCashDesk;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Modules\Sale\Services\PosSale\CreditInvoiceService;
use Modules\Pos\Services\DTE\Exceptions\ResponseFromOFException;
use Modules\Pos\Services\PosPayment\PosPaymentService;
use Modules\Pos\Entities\PosSaleInvoiceData;

class PayPosSaleService
{

    /** @var CheckPosSaleService $checkService */
    private $checkService;
    /** @var CreditInvoiceService */
    private $creditInvoiceService;
    /** @var PosPaymentService */
    private $posPaymentService;

    function __construct(
        CheckPosSaleService $checkService,
        CreditInvoiceService $creditInvoiceService,
        PosPaymentService $posPaymentService
    )
    {
        $this->checkService = $checkService;
        $this->creditInvoiceService = $creditInvoiceService;
        $this->posPaymentService = $posPaymentService;
    }

    /**
     * Pay the sale
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function paySale(Request $request)
    {
        $sale = PosSale::where('id', $request->sale_id)->firstOrFail();
        $this->checkService->checkPosSaleType($request->pos_sale_type);
        if ($request->pos_sale_type != $sale->pos_sale_type) {
            $branchOfficeId = $sale->sl_customer_branch_offices_id ? $sale->sl_customer_branch_offices_id : $request->default_branch_office_id;
            $this->changeDTEInfo($sale, $request->pos_sale_type, $request->customer_id, $branchOfficeId);
        }

        $this->checkService->checkCanPaySale($sale);

        PosCashDesk::findOrFail($request->cash_desk_id);
        $sale->close_sale_datetime = date('Y-m-d H:i:s');
        $sale->g_cashier_user_id = $request->has('cashier_user_id') ? $request->cashier_user_id : null;
        $sale->pos_cash_desk_id = $request->cash_desk_id;
        $sale->g_state_id = SaleConstant::SALE_STATE_REALIZADA;
        $sale->save();

        if ($sale->isInvoice())
        {
            $this->handleInvoiceData($sale, $request);
        }

        $this->addPayments($request, $sale);

        // Before generate DTE, we check customer credit (invoice credit)
        // because sl_sale_invoice is stored after generating DTE
        $this->creditInvoiceService->checkIfNeeded($sale, $request->sale_payment);
        $dteResponse = $this->sendDTE($sale);
        $this->creditInvoiceService->handleIfNeeded($sale, $request->sale_payment);

        return [
            'dte' => $dteResponse['dte'],
            "global_discount_value" => $sale->getGlobalDiscountValueAttribute(),
        ];
    }

    /**
     * Add payments to PosSale
     *
     * @param Request $request
     * @param PosSale $sale
     * @return void
     */
    private function addPayments($request, PosSale $sale)
    {
        // Insert each payment
        $totalPaymentAmount = 0;
        foreach( $request->sale_payment as $salePayment ) {
            // rounding law solo efectivo, para los demás 0.
            $roundingLaw = isset( $salePayment['rounding_law'] ) && $salePayment['rounding_law']? (int) $salePayment['rounding_law'] : 0;
            $totalPaymentAmount += (int) $salePayment['amount_payment'] - $roundingLaw;
            $paymentId = $salePayment['id_sale_payment_id'];
            $this->checkService->checkPaymentType($paymentId);
            if ( $paymentId === SaleConstant::PAYMENT_TYPE_BANK_CHECK ) {
                $this->posPaymentService->addBankCheck($sale->id, $salePayment);
            } else if ( in_array($paymentId, [SaleConstant::PAYMENT_TYPE_DEBITO, SaleConstant::PAYMENT_TYPE_CREDITO]) ) {
                $this->posPaymentService->addVoucher($sale->id, $salePayment);
            } else if ( $paymentId === SaleConstant::PAYMENT_TYPE_EFECTIVO ) {
                $this->posPaymentService->addCash($sale->id, $salePayment);
            } else if ( $paymentId === SaleConstant::PAYMENT_TYPE_ELECTRONIC_TRANSFER ) {
                $this->posPaymentService->addElectronicTransfer($sale->id, $salePayment);
            }
        }
        $this->checkService->checkPaymentTotals($sale, $totalPaymentAmount);
    }

    /**
     * Send DTE
     *
     * @param PosSale $sale
     * @return array
     */
    private function sendDTE(PosSale $sale)
    {
        /** @var DtePosSaleService $dtePosSaleService */
        $dtePosSaleService = new DtePosSaleService();
        $dteResponse = $dtePosSaleService->generateAndSaveDTE($sale);

        if($dteResponse['status'] === 'error') {
            throw new ResponseFromOFException($dteResponse);
        }
        return $dteResponse;
    }

    /**
     * Change DTE Information,
     * From ticket  => invoice
     * Or   invoice => ticket
     *
     * @param integer $posSaleTypeId
     * @param integer $customerId
     * @return void
     */
    public function changeDTEInfo(PosSale $posSale, $posSaleTypeId, $customerId, $customerBranchOfficeId)
    {
        $this->checkService->checkCustomer($customerId);
        $this->checkService->checkIfCustomerRelatedWithInvoice($customerId, $posSaleTypeId);
        $posSale->pos_sale_type_id = $posSaleTypeId;
        $posSale->sl_customer_id =  $posSaleTypeId == SaleConstant::TICKET ? null : $customerId;
        $posSale->sl_customer_branch_offices_id =  $posSaleTypeId == SaleConstant::TICKET ? null : $customerBranchOfficeId;
        $posSale->save();
    }

    /**
     * Handles invoice data
     *
     * @param PosSale $posSale
     * @param array $request
     * @return void
     */
    private function handleInvoiceData(PosSale $posSale, $request)
    {
        if ($request->has('purchase_order') && $request['purchase_order'] && ((int)$request['purchase_order']) > 0)
        {
            $invoiceData = new PosSaleInvoiceData();
            $invoiceData->pos_sale_id = $posSale->id;
            $invoiceData->purchase_order = $request['purchase_order'];
            $invoiceData->flag_delete = false;
            $invoiceData->save();
        }
    }

    /**
     * Attach a new pos payment type
     *
     * @param Modules\Pos\Entities\PosSale $posSale
     * @param integer $paymentTypeId
     * @param integer $amount
     * @return void
     *
     */
    public function addPosPaymentType($posSale, $paymentTypeId, $amount, $rounding_law = 0) {
        $this->checkService->checkPaymentType($paymentTypeId);
        $posSale->paymentTypes()->attach([$paymentTypeId => ['amount' => $amount]]);
    }

}
