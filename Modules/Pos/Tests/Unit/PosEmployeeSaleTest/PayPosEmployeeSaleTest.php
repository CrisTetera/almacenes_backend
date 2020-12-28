<?php

namespace Modules\Pos\Tests\Unit\PosEmployeeSale;

use Tests\TestCase;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;

/**
 * This test check the instance when the customer pays for their purchase
 *
 * In "PosEmployeeSaleTableSeeder" exists four use case:
 * sale:
 *  id: 1 => OK
 *  id: 4 => flag_delete = true, so you can't pay
 *  id: 5 => state: Anulada, so you can't pay
 *  id: 6 => state: Realizada, so you can't pay
 *  id: 7 => OK
 */
class PayPosEmployeeSaleTest extends TestCase
{
    private const EMPLOYEE_SALE_OK = 1;
    private const EMPLOYEE_SALE_DELETED = 4;
    private const EMPLOYEE_SALE_CANCELED = 5;
    private const EMPLOYEE_SALE_REALIZADA = 6;
    private const EMPLOYEE_SALE_OK_ANOTHER = 7;

    // JSON EXAMPLE.
    public $saleJSON = [
        "employee_sale_id" => 1,
        "cashier_user_id" => 1,
        "cash_desk_id" => 1,
        // Si el total es $2.000 y el cliente paga con $3.000, se sigue
        // enviando $2.000 (El vuelto se trabaja en el frontend)
        // En este caso, para id: 1, la venta es de $261 (Siempre boleta) o $220, si es efectivo (neto)
        // Solo puede pagar con:
        // 1. Efectivo
        // 2. Combinación de estos 4: Débito, Crédito, Cheque, Crédito Interno
        "sale_payment" => [
            [
                "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_EFECTIVO,
                "amount_payment" => 220,
                'rounding_law' => 0
            ]
        ]
    ];

    public $tempSaleJson;

    /**
     * Reset tempSaleJSON after each test
     *
     * @return void
     */
    protected function setUp() {
        parent::setUp();
        $this->tempSaleJson = $this->saleJSON;
    }

    /**
     * Function to call a HTTP POST Request to pay a sale
     *
     * @return void
     */
    private function payEmployeeSale() {
        return $this->json('POST', 'api/pos_employee_sale/pay', $this->tempSaleJson);
    }

    /**
     * Function to assert and 500 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    private function assertError($response, $code = 500) {
        $response->assertStatus($code)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    }

    /**
     * Should throw exception if employee sale doesn't exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfEmployeeSaleDoesntExists() {
        $this->tempSaleJson['employee_sale_id'] = -1;
        $response = $this->payEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if cashier doesn't exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfCashierDoesntExists() {
        $this->tempSaleJson['cashier_user_id'] = -1;
        $response = $this->payEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if cash desk doesn't exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfCashDeskDoesntExists() {
        $this->tempSaleJson['cash_desk_id'] = -1;
        $response = $this->payEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if sale payment doesn't exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfSalePaymentDoesntExists() {
        $this->tempSaleJson['sale_payment'][0]['id_sale_payment_id'] = -1;
        $response = $this->payEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if sale flag_delete property is true
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleFlagDeleteIsTrue() {
        $this->tempSaleJson['employee_sale_id'] = self::EMPLOYEE_SALE_DELETED;
        $response = $this->payEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if sale is canceled
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleIsCanceled() {
        $this->tempSaleJson['employee_sale_id'] = self::EMPLOYEE_SALE_CANCELED;
        $response = $this->payEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if sale is accomplished
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleIsAccomplished() {
        $this->tempSaleJson['employee_sale_id'] = self::EMPLOYEE_SALE_REALIZADA;
        $response = $this->payEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if sum of payment is not equals to sale total
     *
     * @return void
     */
    public function test_shouldThrowException_IfPaymentIsDifferentToTotalSale() {
        $this->tempSaleJson['sale_payment'][0]['amount_payment'] = 2000;
        $response = $this->payEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if payment is with bank check with no bank check data
     *
     * @return void
     */
    public function test_payEmployeeSale_withNoBankCheckData()
    {
        $this->tempSaleJson['sale_payment'] = [
            [
                'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
                'amount_payment' => 261
            ]
        ];
        $response = $this->payEmployeeSale();
        $this->assertError($response, 422);
    }

    /**
     * Should throw exception if check payment type doesnt exists
     *
     * @return void
     */
    public function test_payEmployeeSale_And_BankCheckPaymentCheckTypeDoesntExists()
    {
        $this->tempSaleJson['sale_payment'] = [
            [
                'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
                'amount_payment' => 261,
                'g_bank_id' => 1,
                'account_number' => 123456,
                'plaza' => 453,
                'pos_payment_check_type_id' => -1,
                'charge_date' => date('Y-m-d', strtotime('+15 days')),
                'serial_number' => 'ABC-DEF-GHI'
            ]
        ];
        $response = $this->payEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if check payment is "Cheque a Fecha", and "charge_date" is not sended
     *
     * @return void
     */
    public function test_payEmployeeSale_And_BankCheckPaymentIsChequeFecha_And_ChargeDateIsNotSended()
    {
        $this->tempSaleJson['sale_payment'] = [
            [
                'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
                'amount_payment' => 261,
                'g_bank_id' => 1,
                'account_number' => 123456,
                'plaza' => 453,
                'pos_payment_check_type_id' => 1, // 1: Cheque a Fecha, 2: Cheque al Día
                'charge_date' => null,
                'serial_number' => 'ABC-DEF-GHI'
            ]
        ];
        $response = $this->payEmployeeSale();

        $this->assertError($response);
    }

    /**
     * Should throw exception if voucher number is not sended
     *
     * @return void
     */
    public function test_paySale_ShouldThrowException_IfVoucherNumberIsNotSended()
    {
        $this->tempSaleJson['sale_payment'] = [
            [
                "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_DEBITO,
                "amount_payment" => 261,
                // 'voucher_number' => 168901
            ]
        ];
        $response = $this->payEmployeeSale();

        $this->assertError($response);
    }

    /**
     * Should throw exception if credit installments is not sended
     *
     * @return void
     */
    public function test_paySale_ShouldThrowException_IfCreditInstallmentsIsNotSended()
    {
        $this->tempSaleJson['sale_payment'] = [
            [
                "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_INTERNAL_CREDIT,
                "amount_payment" => 261,
                // 'credit_installments' => 3
            ]
        ];
        $response = $this->payEmployeeSale();

        $this->assertError($response);
    }

    /**
     * Should throw exception if cash is mixed with debit, credit, bank check or internal credit
     *
     * @return void
     */
    public function test_paySale_ShouldThrowException_IfCashIsMixedWithOthers()
    {
        $this->tempSaleJson['sale_payment'] = [
            [
                "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_EFECTIVO,
                "amount_payment" => 161,
            ],
            [
                "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_DEBITO,
                "amount_payment" => 100,
                'voucher_number' => 100200300
            ]
        ];
        $response = $this->payEmployeeSale();

        $this->assertError($response);
    }

    /**
     * Should be Ok if employee sale is paid with cash
     *
     * @return void
     */
    public function test_ShouldReturnOk_IfEmployeSale_IsSucessfullyPaid()
    {
        $response = $this->payEmployeeSale();

        $response->assertStatus(200)
                         ->assertJson([
                             'status' => 'success',
                             'http_status_code' => 200
                         ])
                         ->assertJsonStructure([
                             'status',
                             'http_status_code',
                         ]);

        $this->assertDatabaseHas('pos_employee_sale',[
            'id' => $this->tempSaleJson['employee_sale_id'],
            'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
            'pos_cash_desk_id' => $this->tempSaleJson['cash_desk_id'],
            'g_cashier_user_id' => $this->tempSaleJson['cashier_user_id']
        ]);

        $this->assertDatabaseHas('pos_employee_sale_pos_employee_sale_payment_type', [
            'pos_employee_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_EFECTIVO,
            'pos_employee_sale_id' => $this->tempSaleJson['employee_sale_id'],
            'amount' => 220
        ]);

    }

    /**
     * Should be Ok if employee sale is paid with debit, check and internal credit
     *
     * @return void
     */
    public function test_ShouldReturnOk_IfEmployeSale_IsSucessfullyPaid_WithDebitCheckAndInternalCredit()
    {
        $this->tempSaleJson['employee_sale_id'] = self::EMPLOYEE_SALE_OK_ANOTHER;
        $this->tempSaleJson['sale_payment'] = [
            [
                "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_DEBITO,
                "amount_payment" => 61,
                'voucher_number' => 500600700
            ],
            [
                "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_INTERNAL_CREDIT,
                "amount_payment" => 150,
                'credit_installments' => 3
            ],
            [
                "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
                "amount_payment" => 50,
                'g_bank_id' => 1,
                'account_number' => 123456,
                'plaza' => 453,
                'pos_payment_check_type_id' => SaleConstant::CHEQUE_FECHA, // 1: Cheque a Fecha, 2: Cheque al Día
                'charge_date' => date('Y-m-d', strtotime('+15 days')),
                'serial_number' => 'ABC-DEF-GHI'
            ]
        ];
        $response = $this->payEmployeeSale();
        $response->assertStatus(200)
                         ->assertJson([
                             'status' => 'success',
                             'http_status_code' => 200
                         ])
                         ->assertJsonStructure([
                             'status',
                             'http_status_code',
                         ]);

        // Assert pos_employee_sale
        $this->assertDatabaseHas('pos_employee_sale',[
            'id' => $this->tempSaleJson['employee_sale_id'],
            'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
            'pos_cash_desk_id' => $this->tempSaleJson['cash_desk_id'],
            'g_cashier_user_id' => $this->tempSaleJson['cashier_user_id']
        ]);

        // Assert pos_employee_sale_pos_employee_sale_payment_type
        $this->assertDatabaseHas('pos_employee_sale_pos_employee_sale_payment_type', [
            'pos_employee_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_DEBITO,
            'pos_employee_sale_id' => $this->tempSaleJson['employee_sale_id'],
            'amount' => 61
        ]);
        $this->assertDatabaseHas('pos_employee_sale_pos_employee_sale_payment_type', [
            'pos_employee_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_INTERNAL_CREDIT,
            'pos_employee_sale_id' => $this->tempSaleJson['employee_sale_id'],
            'amount' => 150
        ]);
        $this->assertDatabaseHas('pos_employee_sale_pos_employee_sale_payment_type', [
            'pos_employee_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
            'pos_employee_sale_id' => $this->tempSaleJson['employee_sale_id'],
            'amount' => 50
        ]);

        // Assert pos_employee_payment_voucher
        $this->assertDatabaseHas('pos_employee_payment_voucher',[
            'pos_employee_sale_id' => $this->tempSaleJson['employee_sale_id'],
            'pos_employee_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_DEBITO,
            'voucher_number' => 500600700,
        ]);

        // Assert pos_employee_internal_credit
        $this->assertDatabaseHas('pos_employee_internal_credit',[
            'pos_employee_sale_id' => $this->tempSaleJson['employee_sale_id'],
            'pos_employee_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_INTERNAL_CREDIT,
            'credit_installments' => 3,
        ]);

        // Assert pos_employee_internal_credit
        $this->assertDatabaseHas('pos_employee_payment_check',[
            'pos_employee_sale_id' => $this->tempSaleJson['employee_sale_id'],
            'pos_employee_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
            'g_bank_id' => 1,
            'account_number' => 123456,
            'plaza' => 453,
            'pos_payment_check_type_id' => SaleConstant::CHEQUE_FECHA, // 1: Cheque a Fecha, 2: Cheque al Día
            'serial_number' => 'ABC-DEF-GHI',
            'charge_date' => date('Y-m-d', strtotime('+15 days'))
        ]);

    }

}
