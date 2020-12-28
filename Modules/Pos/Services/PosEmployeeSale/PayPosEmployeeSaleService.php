<?php

namespace Modules\Pos\Services\PosEmployeeSale;

use Modules\Pos\Entities\PosCashDesk;
use Modules\General\Entities\GUser;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Modules\Pos\Entities\PosEmployeeSale;
use Modules\Pos\Entities\PosEmployeeSalePaymentType;
use Modules\Pos\Entities\PosPaymentCheckType;
use Dotenv\Exception\ValidationException;
use Modules\Pos\Entities\PosEmployeePaymentCheck;
use Modules\Pos\Entities\PosEmployeePaymentVoucher;
use Modules\Pos\Entities\PosEmployeeInternalCredit;
use Illuminate\Http\Request;
use Modules\Pos\Entities\PosEmployeePaymentCash;
use Modules\Pos\Services\PosSale\DtePosSaleService;
use Modules\Pos\Services\PosEmployeePayment\PosEmployeePaymentService;
use Modules\Pos\Services\DTE\Exceptions\ResponseFromOFException;

class PayPosEmployeeSaleService
{
    /** @var CheckPosSaleService $checkService */
    private $checkService;
    /** @var PosEmployeePaymentService */
    private $posEmployeePaymentService;

    /**
     * Constructor
     *
     * @param CheckEmployeeSaleService $checkService
     */
    function __construct(
        CheckEmployeeSaleService $checkService,
        PosEmployeePaymentService $posEmployeePaymentService
    ) {
        $this->checkService = $checkService;
        $this->posEmployeePaymentService = $posEmployeePaymentService;
    }

    /**
     * Pay the sale
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function payEmployeeSale(Request $request)
    {
        try {
            DB::beginTransaction();
            // Check Cashier and cash desk
            PosCashDesk::where('id', $request->cash_desk_id)->where('flag_delete', false)->firstOrFail();
            GUser::where('id', $request->cashier_user_id)->where('flag_delete', false)->firstOrFail();

            $sale = PosEmployeeSale::findOrFail($request->employee_sale_id);
            $this->checkService->checkCanPaySale($sale);

            // Set Data
            $sale->close_sale_datetime = date('Y-m-d H:i:s');
            $sale->pos_cash_desk_id = $request->cash_desk_id;
            $sale->g_cashier_user_id = $request->cashier_user_id;
            $sale->g_state_id = SaleConstant::SALE_STATE_REALIZADA;
            $sale->save();

            // Insert each payment
            $this->checkService->checkCashPayments($request->sale_payment);
            $isCash = $this->checkService->isCash($request->sale_payment);
            $this->addPayments($request, $sale);

            // Solo se genera el DTE cuando no es efectivo.
            DB::commit();

            if ( $isCash ) {
                return CustomResponse::ok(['message' => 'Venta empleado pagada con éxito']);
            }

            /** @var DtePosSaleService $dtePosSaleService */
            // Siempre boleta electrónica
            $dtePosSaleService = new DtePosSaleService();
            $sale->pos_sale_type_id = SaleConstant::TICKET;
            $dteResponse = $dtePosSaleService->generateAndSaveDTE($sale);

            return CustomResponse::ok([
                'dte' => $dteResponse['dte'],
                "global_discount_value" => $sale->getGlobalDiscountValueAttribute(),
            ]);
        } catch(ResponseFromOFException $e) {
            DB::rollBack();
            return CustomResponse::error($e, [ 'details'=> $e->dteResponse['error'] ]);
        } catch(\Exception $e) {
            DB::rollback();
            if ($e instanceof LaravelValidationException) {
                throw $e;
            }
            return CustomResponse::error($e, [
                'error_dte' => ( isset($dteResponse) ? $dteResponse : null )
            ]);
        }
    }

    /**
     * Add payments to PosEmployeeSale
     *
     * @param Request $request
     * @param PosEmployeeSale $sale
     * @return void
     */
    private function addPayments($request, PosEmployeeSale $sale)
    {
        $totalPaymentAmount = 0;
        foreach( $request->sale_payment as $salePayment ) {
            // rounding law solo efectivo, para los demás 0.
            $roundingLaw = isset( $salePayment['rounding_law'] ) && $salePayment['rounding_law']? (int) $salePayment['rounding_law'] : 0;
            $totalPaymentAmount += (int) $salePayment['amount_payment'] - $roundingLaw;
            $payment = $this->addPosPaymentType($sale, $salePayment['id_sale_payment_id'], $salePayment['amount_payment']);
            // Add payment due to type
            $paymentId = $salePayment['id_sale_payment_id'];
            if ( $paymentId === SaleConstant::PAYMENT_TYPE_BANK_CHECK ) {
                $this->posEmployeePaymentService->addBankCheck($sale->id, $salePayment);
            } else if ( in_array($paymentId, [SaleConstant::PAYMENT_TYPE_DEBITO, SaleConstant::PAYMENT_TYPE_CREDITO]) ) {
                $this->posEmployeePaymentService->addVoucher($sale->id, $salePayment);
            } else if ( $paymentId === SaleConstant::PAYMENT_TYPE_INTERNAL_CREDIT ) {
                $this->posEmployeePaymentService->addInternalCredit($sale->id, $salePayment);
            } else if ( $paymentId === SaleConstant::PAYMENT_TYPE_EFECTIVO ) {
                $this->posEmployeePaymentService->addCash($sale->id, $salePayment);
            } else if ( $paymentId === SaleConstant::PAYMENT_TYPE_ELECTRONIC_TRANSFER ) {
                $this->posEmployeePaymentService->addElectronicTransfer($sale->id, $salePayment);
            }
        }
        $this->checkService->checkPaymentTotals($sale, $totalPaymentAmount, $request->sale_payment);
    }

    /**
     * Attach a new pos employee payment type
     *
     * @param Modules\Pos\Entities\PosEmployeeSale $posEmployeeSale
     * @param integer $paymentTypeId
     * @param integer $amount
     * @return void
     *
     */
    public function addPosPaymentType(PosEmployeeSale $posEmployeeSale, $paymentTypeId, $amount) {
        PosEmployeeSalePaymentType::where('id', $paymentTypeId)->where('flag_delete', false)->firstOrFail();
        $posEmployeeSale->paymentTypes()->attach([$paymentTypeId => ['amount' => $amount]]);

    }

}
