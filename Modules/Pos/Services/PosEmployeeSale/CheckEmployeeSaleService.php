<?php

namespace Modules\Pos\Services\PosEmployeeSale;

use Dotenv\Exception\ValidationException;
use Modules\Pos\Entities\PosEmployeeSale;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Illuminate\Support\Facades\Validator;
use Modules\General\Entities\GBank;

class CheckEmployeeSaleService
{
    /**
     * Check if you can pay employee sale,
     * If not, throws Dotenv\Exception\ValidationException
     *
     * @param PosSale $posSale
     * @return void
     */
    public function checkCanPaySale(PosEmployeeSale $posSale) {
        if ($posSale->flag_delete) {
            throw new ValidationException("La venta está eliminada.");
        }
        if ($posSale->g_state_id === SaleConstant::SALE_STATE_ANULADA) {
            throw new ValidationException("La venta está anulada.");
        }
        if ($posSale->g_state_id === SaleConstant::SALE_STATE_REALIZADA) {
            throw new ValidationException("La venta ya ha sido pagada.");
        }
    }

    /**
     * Check if sale is paid with cash or debit, credit, banck check or internal credit
     *
     * array structure:
     *
     * [
     *    [
     *       "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_EFECTIVO,
     *       "amount_payment" => 220
     *    ], ...
     * ]
     *
     * @param array $paymentDetails
     * @return void
     */
    public function checkCashPayments($paymentDetails) {
        $isCash = false;
        $isOther = false;
        foreach($paymentDetails as $payment)
        {
            if ($payment['id_sale_payment_id'] === SaleConstant::PAYMENT_TYPE_EFECTIVO)
            {
                $isCash = true;
            } else
            {
                $isOther = true;
            }
        }
        if ($isCash && $isOther)
        {
            throw new ValidationException("Debe pagar solo con Efectivo o con una combinación de: Débito, Crédito, Cheque y/o Crédito interno");
        }
    }

    /**
     * Check if sale is paid with cash or debit, credit, banck check or internal credit
     *
     * array structure:
     *
     * [
     *    [
     *       "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_EFECTIVO,
     *       "amount_payment" => 220
     *    ], ...
     * ]
     *
     * @param array $paymentDetails
     * @return void
     */
    public function isCash($paymentDetails) {
        foreach($paymentDetails as $payment)
        {
            if ($payment['id_sale_payment_id'] === SaleConstant::PAYMENT_TYPE_EFECTIVO)
            {
                return true;
            }
        }
    }

    /**
     * Check if sended total is equal total.
     * If payment is with cash, you check new_net_subtotal,
     * if not, you check ticket_total
     * If not, throws Dotenv\Exception\ValidationException
     *
     * array structure of $paymentDetails:
     *
     * [
     *    [
     *       "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_EFECTIVO,
     *       "amount_payment" => 220
     *    ], ...
     * ]
     *

     *
     * @param PosEmployeeSale $sale
     * @param integer $paymentTotal
     * @param array $paymentDetails
     * @return void
     */
    public function checkPaymentTotals(PosEmployeeSale $sale, $paymentTotal, $paymentDetails) {
        $totalVenta = $this->isCash($paymentDetails) ? $sale->new_net_subtotal : $sale->ticket_total;
        if ($totalVenta !== $paymentTotal) {
            throw new ValidationException("El total de la venta ($totalVenta) no corresponde al total del monto pagado ($paymentTotal).");
        }
    }

    /**
     * Validates Bank Check Data
     *
     * Needed salePayment data
     *
     * [
     *  'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
     *  'amount_payment' => 261,
     *  'g_bank_id' => 1,
     *  'account_number' => 123456,
     *  'plaza' => 453,
     *  'pos_payment_check_type_id' => 1, // 1: Cheque a Fecha, 2: Cheque al Día
     *  'charge_date' => date('Y-m-d', strtotime('+15 days')),
     *  'serial_number' => 'ABC-DEF-GHI'
     * ]
     *
     * @param integer $posEmployeeSaleId
     * @param array $salePayment
     * @return void
     */
    public function validateBankCheckData($posEmployeeSaleId, $salePayment) {
        // ValidateData
        $request = new Request([
            'pos_sale_payment_type_id' => $salePayment['id_sale_payment_id'] ? $salePayment['id_sale_payment_id'] : null,
            'amount' => $salePayment['amount_payment'] ? $salePayment['amount_payment'] : null,
            'account_number' => isset( $salePayment['account_number'] ) ? $salePayment['account_number'] : null,
            'plaza' => isset( $salePayment['plaza'] ) ? $salePayment['plaza'] : null,
            'g_bank_id' => isset( $salePayment['g_bank_id'] ) ? $salePayment['g_bank_id'] : null,
            'pos_payment_check_type_id' => isset( $salePayment['pos_payment_check_type_id'] ) ? $salePayment['pos_payment_check_type_id'] : null,
            'charge_date' => isset( $salePayment['charge_date'] ) ? $salePayment['charge_date'] : null,
            'serial_number' => isset( $salePayment['serial_number'] ) ? $salePayment['serial_number'] : null,
        ]);
        $validateData = Validator::make($request->all(), [
            'pos_sale_payment_type_id' => 'required|min:1',
            'amount' => 'required|min:1',
            'g_bank_id' => 'required|integer|min:1|exists:g_bank,id',
            'account_number' => 'required|integer|min:0',
            'plaza' => 'required|integer|min:0',
            'pos_payment_check_type_id' => 'required|min:1',
            'charge_date' => 'nullable',
            'serial_number' => 'max:40'
        ]);
        if ($validateData->fails()) {
            throw new LaravelValidationException($validateData);
        }
    }

}
