<?php

namespace Modules\Pos\Services\PosPayment;

use Modules\Pos\Entities\PosPaymentCash;
use Dotenv\Exception\ValidationException;
use Modules\Pos\Entities\PosPaymentVoucher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Pos\Entities\PosPaymentCheck;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Modules\Pos\Entities\PosPaymentCheckType;
use Modules\Pos\Entities\PosPaymentElectronicTransfer;

class PosPaymentService
{


    /**
     * Add a Bank Check
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
     * @param integer $posSaleId
     * @param array $salePayment
     * @return void
     */
    public function addBankCheck($posSaleId, $salePayment) {
        $this->validateBankCheckData($posSaleId, $salePayment);
        // Check if "Cheque a Fecha" is sended with "Charge Date"
        PosPaymentCheckType::findOrFail($salePayment['pos_payment_check_type_id']);
        if ( $salePayment['pos_payment_check_type_id'] == SaleConstant::CHEQUE_FECHA && !$salePayment['charge_date'] ) {
            throw new ValidationException('Se debe indicar la fecha para cobrar si es Cheque a Fecha');
        }
        // Generates Bank Check
        $bankCheck = new PosPaymentCheck([
            'pos_sale_id' => $posSaleId,
            'pos_sale_payment_type_id' => $salePayment['id_sale_payment_id'],
            'amount' => $salePayment['amount_payment'],
            'g_bank_id' => $salePayment['g_bank_id'],
            'account_number' => $salePayment['account_number'],
            'plaza' => $salePayment['plaza'],
            'pos_payment_check_type_id' => $salePayment['pos_payment_check_type_id'],
            'emission_date' => date('Y-m-d H:i:s'),
            'charge_date' => $salePayment['pos_payment_check_type_id'] == SaleConstant::CHEQUE_FECHA ? $salePayment['charge_date'] : null,
            'serial_number' => $salePayment['serial_number'] ? $salePayment['serial_number'] : '',
            'flag_delete' => false
        ]);
        $bankCheck->save();
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
     * @param integer $posSaleId
     * @param array $salePayment
     * @return void
     */
    public function validateBankCheckData($posSaleId, $salePayment) {
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

    /**
     * Add Voucher
     *
     * Needed salePayment data
     *
     * [
     *  'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_DEBITO,
     *  'amount_payment' => 261,
     *  'voucher_number' => 100
     * ]
     *
     * @param integer $posSaleId
     * @param array $salePayment
     * @return void
     */
    public function addVoucher($posSaleId, $salePayment) {
        // Validate if voucher number is sended.
        if (!isset($salePayment['voucher_number']) || !$salePayment['voucher_number']) {
            throw new ValidationException('Debe enviar un número de voucher');
        }
        // Generates new Voucher
        $voucher = new PosPaymentVoucher([
            'pos_sale_id' => $posSaleId,
            'pos_sale_payment_type_id' => $salePayment['id_sale_payment_id'],
            'voucher_number' => $salePayment['voucher_number'],
            'flag_delete' => false
        ]);
        $voucher->save();
    }

    /**
     * Add Cash (rounding law)
     *
     * Needed salePayment data
     *
     * [
     *  'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_EFECTIVO,
     *  'amount_payment' => 260,
     *  'rounding_law' => 1
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
        $cash = new PosPaymentCash([
            'pos_sale_id' => $posSaleId,
            'pos_sale_payment_type_id' => $salePayment['id_sale_payment_id'],
            'rounding_law' => $salePayment['rounding_law'],
            'flag_delete' => false
        ]);
        $cash->save();
    }

    /**
     * Add Electronic Transfer
     *
     * Needed salePayment data
     *
     * [
     *  'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_ELECTRONIC_TRANSFER,
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
        $transfer = new PosPaymentElectronicTransfer([
            'pos_sale_id' => $posSaleId,
            'pos_sale_payment_type_id' => $salePayment['id_sale_payment_id'],
            'transfer_number' => $salePayment['transfer_number'],
            'flag_delete' => false
        ]);
        $transfer->save();
    }

}
