<?php

namespace Modules\Pos\Services\PosSalePos;

use Modules\Pos\Entities\PosSalePos;
use Modules\Pos\Entities\PosTrustSalePos;
use Illuminate\Http\Request;
use Modules\Pos\Services\PosSalePos\CheckPosSaleService;
use Modules\Pos\Entities\PosCashDeskPos;
use Modules\Pos\Services\PosSalePos\Entities\SaleConstant;
use Modules\Sale\Services\PosSalePos\CreditInvoiceService;
use Modules\Pos\Services\DTE\Exceptions\ResponseFromOFException;
use Modules\Pos\Services\PosPaymentPos\PosPaymentService;
use Modules\Pos\Entities\PosSaleInvoiceData;
use Modules\Pos\Http\Requests\Pos\PaySaleRequest;
use Modules\Pos\Http\Requests\Pos\PayTrustedSaleRequest;
use Modules\Pos\Entities\PosMovementIngressTypePos;
use Modules\Pos\Entities\PosCashDeskMovementPos;
use Modules\Pos\Entities\PosPaymentMethodPos;

class PayPosSaleService
{

    /** @var CheckPosSaleService $checkService */
    private $checkService;
    /** @var PosPaymentService */
    private $posPaymentService;

    function __construct(
        CheckPosSaleService $checkService,
        PosPaymentService $posPaymentService
    )
    {
        $this->checkService = $checkService;
        $this->posPaymentService = $posPaymentService;
    }

    /**
     * Pay the sale
     *
     * @param  Modules\Pos\Http\Requests\Pos\PaySaleRequest  $request
     * @return array
     */
    public function paySale(PaySaleRequest $request)
    {
        $sale = PosSalePos::where('id', $request->pos_sale_id)->firstOrFail();
        $this->checkService->checkPosSaleType($request->pos_sale_type_id);
        if ($request->pos_sale_type != $sale->pos_sale_type) {
            
            $this->changeDTEInfo($sale, $request->pos_sale_type_id, $request->sl_customer_id);
        }
        $this->checkService->checkCanPaySale($sale);
        
        PosCashDeskPos::findOrFail($request->pos_cash_desk_id);
        $sale->close_sale_datetime = date('Y-m-d H:i:s');
        $sale->g_cashier_id = $request->has('g_cashier_id') ? $request->g_cashier_id : null;
        $sale->pos_cash_desk_id = $request->pos_cash_desk_id;
        $sale->g_state_id = SaleConstant::SALE_STATE_REALIZADA;
        $sale->save();

        // if ($sale->isInvoice())
        // {
        //     $this->handleInvoiceData($sale, $request);
        // }
        
        $this->addPayments($request, $sale);
        $sale = PosSalePos::where('id', $request->pos_sale_id)->firstOrFail();

        // Before generate DTE, we check customer credit (invoice credit)
        // because sl_sale_invoice is stored after generating DTE
        // $this->creditInvoiceService->checkIfNeeded($sale, $request->sale_payment);
        $dteResponse = $this->sendDTE($sale);
        // $this->creditInvoiceService->handleIfNeeded($sale, $request->sale_payment);

        return [
            'dte' => $dteResponse['dte'],
            "global_discount_amount" => $sale->getGlobalDiscountValueAttribute(),
        ];
    }
    /**
     * Pay the sale
     *
     * @param  Modules\Pos\Http\Requests\Pos\PayTrustedSaleRequest  $request
     * @return array
     */
    public function payTrustSale(PayTrustedSaleRequest $request)
    {
        $trustSale = PosTrustSalePos::where('id', $request->pos_sale_id)->firstOrFail();
        $this->checkService->checkCanPayTrustSale($trustSale->flag_is_payed);
        // if ($request->pos_sale_type != $sale->pos_sale_type) {
            
        //     $this->changeDTEInfo($sale, $request->pos_sale_type_id, $request->sl_customer_id);
        // }
        // $this->checkService->checkCanPayTrustSale($trustSale);
        
        PosCashDeskPos::findOrFail($request->pos_cash_desk_id);
        $ingressMovement = new PosCashDeskMovementPos();
        $ingressMovement->amount = $request->pos_payment_sale->amount_payment;
        $ingressMovement->pos_cash_desk_id = $request->pos_cash_desk_id;
        $ingressMovement->pos_movement_ingress_type_id = SaleConstant::INGRESS_TYPE_FIADO;
        $ingressMovement->g_user_id = $request->g_cashier_id;
        $ingressMovement->observation = 'Pago de venta fiada';
        $ingressMovement->save();
        
        // $trustSale->flag_is_payed = true;
    

        $sale = PosSalePos::where('id', $trustSale->pos_sale_id)->where('flag_delete',0)->firstOrFail();
        $this->addPaymentsTrusted($request, $sale);
        if ($trustSale->isTrustSale()){
            $this->payedTrustSale($sale); 
        }
        // Before generate DTE, we check customer credit (invoice credit)
        // because sl_sale_invoice is stored after generating DTE
        // $this->creditInvoiceService->checkIfNeeded($sale, $request->sale_payment);
        // $dteResponse = $this->sendDTE($sale);
        // $this->creditInvoiceService->handleIfNeeded($sale, $request->sale_payment);

        return [
            // 'dte' => $dteResponse['dte'],
            // "global_discount_amount" => $trustSale->getGlobalDiscountValueAttribute(),
        ];
    }

    public function payedTrustSale($trustSale){
        // $trustSale = PosTrustSalePos::where('pos_sale_id',$sale->id)->where('flag_delete',false)->first();
        $trustSale->flag_is_payed = true;
        $trustSale->save();
        
        $payment = PosPaymentMethodPos::where('id',$trustSale->pos_payment_method_id)->where('flag_delete',0)->first();
        $payment['flag_delete']= true;
        $payment->save();
    }

    /**
     * Add payments to PosSale
     *
     * @param Modules\Pos\Http\Requests\Pos\PaySaleRequest $request
     * @param PosSalePos $sale
     * @return void
     */
    private function addPayments($request, PosSalePos &$sale)
    {
        // Insert each payment
        // dd($request->toArray());
        // dump($request->toArray());
        $totalPaymentAmount = 0;
        foreach( $request->pos_payment_sale as $salePayment ) {
            // rounding law solo efectivo, para los demás 0.
            $roundingLaw = isset( $salePayment['rounding_law'] ) && $salePayment['rounding_law']? (int) $salePayment['rounding_law'] : 0;
            $totalPaymentAmount += (int) $salePayment['amount_payment'] - $roundingLaw;
            $paymentId = $salePayment['pos_type_payment_method_id'];
            $this->checkService->checkPaymentType($paymentId);
            if ( in_array($paymentId, [SaleConstant::PAYMENT_TYPE_DEBITO, SaleConstant::PAYMENT_TYPE_CREDITO]) ) {
                $this->posPaymentService->addVoucher($sale->id, $salePayment);
            } else if ( $paymentId === SaleConstant::PAYMENT_TYPE_EFECTIVO ) {
                $this->posPaymentService->addCash($sale->id, $salePayment);
            } else if ( $paymentId === SaleConstant::PAYMENT_TYPE_ELECTRONIC_TRANSFER ) {
                $this->posPaymentService->addElectronicTransfer($sale->id, $salePayment);
            } else if ( $paymentId === SaleConstant::PAYMENT_TYPE_FIADO ) {
                $this->posPaymentService->addTrusted($sale->id, $salePayment); 
            }
        }

        $this->checkService->checkPaymentTotals($sale, $totalPaymentAmount);
    }

    /**
     * Add payments to PosSale
     *
     * @param Modules\Pos\Http\Requests\Pos\PayTrustedSaleRequest $request
     * @param PosSalePos $sale
     * @return void
     */
    private function addPaymentsTrusted($request, PosSalePos &$sale)
    {
        // Insert each payment
        // dd($request->toArray());
        // dump($request->toArray());
        $totalPaymentAmount = 0;
        foreach( $request->pos_payment_sale as $salePayment ) {
            // rounding law solo efectivo, para los demás 0.
            $roundingLaw = isset( $salePayment['rounding_law'] ) && $salePayment['rounding_law']? (int) $salePayment['rounding_law'] : 0;
            $totalPaymentAmount += (int) $salePayment['amount_payment'] - $roundingLaw;
            $paymentId = $salePayment['pos_type_payment_method_id'];
            $this->checkService->checkPaymentType($paymentId);
            if ( in_array($paymentId, [SaleConstant::PAYMENT_TYPE_DEBITO, SaleConstant::PAYMENT_TYPE_CREDITO]) ) {
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
     * @param PosSalePos $sale
     * @return array
     */
    private function sendDTE(PosSalePos $sale)
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
    public function changeDTEInfo(PosSalePos $posSale, $posSaleTypeId, $customerId)
    {
        $this->checkService->checkCustomer($customerId);
        $this->checkService->checkIfCustomerRelatedWithInvoice($customerId, $posSaleTypeId);
        $posSale->pos_sale_type_id = $posSaleTypeId;
        $posSale->sl_customer_id =  $posSaleTypeId == SaleConstant::TICKET ? null : $customerId;
        $posSale->save();
    }

    /**
     * Handles invoice data
     *
     * @param PosSalePos $posSale
     * @param array $request
     * @return void
     */
    private function handleInvoiceData(PosSalePos $posSale, $request)
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
     * @param integer $paymentTypeId
     * @param integer $amount
     * @return void
     *
     */
    public function addPosPaymentType(PosSalePos $posSale, $paymentTypeId, $amount, $rounding_law = 0) {
        $this->checkService->checkPaymentType($paymentTypeId);
        $posSale->posTypePaymentMethodPos()->attach([$paymentTypeId => ['amount_payment' => $amount]]);
    }

}
