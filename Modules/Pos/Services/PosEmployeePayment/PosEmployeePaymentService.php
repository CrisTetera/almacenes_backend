<?php

namespace Modules\Pos\Services\PosEmployeePayment;

use Modules\Pos\Entities\PosEmployeePaymentElectronicTransfer;
use Dotenv\Exception\ValidationException;
use Modules\Pos\Entities\PosEmployeePaymentCash;
use Modules\Pos\Entities\PosEmployeeInternalCredit;
use Modules\Pos\Entities\PosEmployeePaymentVoucher;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Modules\Pos\Entities\PosEmployeePaymentCheck;
use Modules\Pos\Entities\PosPaymentCheckType;
use Modules\General\Entities\GBank;
use Modules\Pos\Services\PosEmployeeSale\CheckEmployeeSaleService;

class PosEmployeePaymentService
{

    /** @var CheckEmployeeSaleService $checkService */
    private $checkService;

    public function __construct(CheckEmployeeSaleService $checkService)
    {
        $this->checkService = $checkService;
    }

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
    public function addBankCheck($posEmployeeSaleId, $salePayment) {
        $this->checkService->validateBankCheckData($posEmployeeSaleId, $salePayment);
        // Check if "Cheque a Fecha" is sended with "Charge Date"
        PosPaymentCheckType::findOrFail($salePayment['pos_payment_check_type_id']);
        if ( $salePayment['pos_payment_check_type_id'] == SaleConstant::CHEQUE_FECHA && !$salePayment['charge_date'] ) {
            throw new ValidationException('Se debe indicar la fecha para cobrar si es Cheque a Fecha');
        }
        // Generates Bank Check
        $bankCheck = new PosEmployeePaymentCheck([
            'pos_employee_sale_id' => $posEmployeeSaleId,
            'pos_employee_sale_payment_type_id' => $salePayment['id_sale_payment_id'],
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
     * @param integer $posEmployeeSaleId
     * @param array $salePayment
     * @return void
     */
    public function addVoucher($posEmployeeSaleId, $salePayment) {
        // Validate if voucher number is sended.
        if (!isset($salePayment['voucher_number']) || !$salePayment['voucher_number']) {
            throw new ValidationException('Debe enviar un número de voucher');
        }
        // Generates new Voucher
        $voucher = new PosEmployeePaymentVoucher([
            'pos_employee_sale_id' => $posEmployeeSaleId,
            'pos_employee_sale_payment_type_id' => $salePayment['id_sale_payment_id'],
            'voucher_number' => $salePayment['voucher_number'],
            'flag_delete' => false
        ]);
        $voucher->save();
    }

    /**
     * Add Internal Credit
     *
     * Needed salePayment data
     *
     * [
     *  'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_INTERNAL_CREDIT,
     *  'amount_payment' => 261,
     *  'credit_installments' => 3
     * ]
     *
     * @param integer $posEmployeeSaleId
     * @param array $salePayment
     * @return void
     */
    public function addInternalCredit($posEmployeeSaleId, $salePayment) {
        // Validate if credit_installments is sended.
        if (!isset($salePayment['credit_installments']) || !$salePayment['credit_installments']) {
            throw new ValidationException('Debe enviar el número de cuotas');
        }
        // Generates new Voucher
        $voucher = new PosEmployeeInternalCredit([
            'pos_employee_sale_id' => $posEmployeeSaleId,
            'pos_employee_sale_payment_type_id' => $salePayment['id_sale_payment_id'],
            'credit_installments' => $salePayment['credit_installments'],
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
        $cash = new PosEmployeePaymentCash([
            'pos_employee_sale_id' => $posSaleId,
            'pos_employee_sale_payment_type_id' => $salePayment['id_sale_payment_id'],
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
        // Generates new Cash
        $transfer = new PosEmployeePaymentElectronicTransfer([
            'pos_employee_sale_id' => $posSaleId,
            'pos_employee_sale_payment_type_id' => $salePayment['id_sale_payment_id'],
            'transfer_number' => $salePayment['transfer_number'],
            'flag_delete' => false
        ]);
        $transfer->save();
    }

}
