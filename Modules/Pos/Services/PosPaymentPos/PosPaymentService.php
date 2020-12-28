<?php

namespace Modules\Pos\Services\PosPaymentPos;

use Modules\Pos\Entities\PosPaymentCash;
use Dotenv\Exception\ValidationException;
use Modules\Pos\Entities\PosPaymentVoucher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Pos\Entities\PosPaymentCheck;
use Modules\Pos\Services\PosSalePos\Entities\SaleConstant;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Modules\Pos\Entities\PosPaymentMethodPos;
use Modules\Pos\Entities\PosSalePos;
use Modules\Pos\Entities\PosTrustSalePos;

class PosPaymentService
{
    /**
     * Add Voucher
     *
     * Needed salePayment data
     *
     * [
     *  'pos_type_payment_method_id' => SaleConstant::PAYMENT_TYPE_DEBITO,
     *  'amount_payment' => 261,
     *  'voucher_number' => 100
     * ]
     *
     * @param integer $posSaleId
     * @param array $salePayment
     * @return void
     */
    public function addVoucher($posSaleId, $salePayment) {
        // Generates new Voucher
        $payment = new PosPaymentMethodPos([
            'pos_sale_id' => $posSaleId,
            'pos_type_payment_method_id' => $salePayment['pos_type_payment_method_id'],
            'amount_payment' => $salePayment['amount_payment']
        ]);
        $payment->save();
        
    }
    /**
     * Add Trusted Sale
     *
     * Needed salePayment data
     *
     * [
     *  'pos_type_payment_method_id' => SaleConstant::PAYMENT_TYPE_FIADO,
     *  'amount_payment' => 261,
     *  'voucher_number' => 100
     * ]
     *
     * @param integer $posSaleId
     * @param array $salePayment
     * @return void
     */
    public function addTrusted($posSaleId, $salePayment) {
        // dump($slCustomerId);
        // Generates new Voucher
        $payment = new PosPaymentMethodPos([
            'pos_sale_id' => $posSaleId,
            'pos_type_payment_method_id' => $salePayment['pos_type_payment_method_id'],
            'amount_payment' => $salePayment['amount_payment']
        ]);
        $payment->save();
        $trusSale =new PosTrustSalePos([
            'pos_payment_method_id' => $payment->id,
            'pos_sale_id' => $posSaleId,
            'sl_customer_id' => $salePayment['sl_customer_id'],
            'flag_delete' => false
        ]);
        $trusSale->save();
        // dump($posSaleId, $salePayment['sl_customer_id']);
        $sale = PosSalePos::where('id', $posSaleId)->where('flag_delete',0)->first();
        $sale->update([
            'sl_customer_id' => $salePayment['sl_customer_id'],
        ]);
    }

    /**
     * Add Cash (rounding law)
     *
     * Needed salePayment data
     *
     * [
     *  'pos_type_payment_method_id' => SaleConstant::PAYMENT_TYPE_EFECTIVO,
     *  'amount_payment' => 260,
     *  'rounding_law' => -1
     * ]
     *
     * @param integer $posSaleId
     * @param array $salePayment
     * @return void
     */
    public function addCash($posSaleId, $salePayment) {
        // Validate if rounding law is sended.
        if (!isset($salePayment['rounding_law'])) {
            throw new ValidationException('Debe enviar el monto por ley de redondeo');
        }
        // Generates new Cash
        $payment = new PosPaymentMethodPos([
            'pos_sale_id' => $posSaleId,
            'pos_type_payment_method_id' => $salePayment['pos_type_payment_method_id'],
            'amount_payment' => $salePayment['amount_payment'],
            'rounding_law' => $salePayment['rounding_law']
        ]);
        $payment->save();
        $cash = PosSalePos::where('id',$posSaleId)->where('flag_delete',false)->first();
        $cash['rounding_law'] = $salePayment['rounding_law'];
        
        $cash->save();
    }
    /**
     * Add Electronic Transfer
     *
     * Needed salePayment data
     *
     * [
     *  'pos_type_payment_method_id' => SaleConstant::PAYMENT_TYPE_ELECTRONIC_TRANSFER,
     *  'amount_payment' => 260,
     *  'transfer_number' => 1
     * ]
     *
     * @param integer $posSaleId
     * @param array $salePayment
     * @return void
     */
    public function addElectronicTransfer($posSaleId, $salePayment) {
        // Validate if transfer number is sended.
        if (!isset($salePayment['transfer_number'])) {
            throw new ValidationException('Debe enviar el número de transferencia electrónica');
        }
        // Generates new Electronic Transfer
        $transfer = new PosPaymentMethodPos([
            'pos_sale_id' => $posSaleId,
            'pos_type_payment_method_id' => $salePayment['pos_type_payment_method_id'],
            'amount_payment' => $salePayment['amount_payment'],
            'transfer_number' => $salePayment['transfer_number']
        ]);
        $transfer->save();
    }

}
