<?php

namespace Modules\Pos\Tests\Unit\PosSale;

use Tests\TestCase;
use Modules\Pos\Entities\PosSale;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dotenv\Exception\ValidationException;

/**
 * This test check the instance when the customer pays for their purchase
 *
 * In "PosSaleTableSeeder" exists four use case:
 * sale:
 *  id: 1 => OK
 *  id: 2 => flag_delete = true, so you can't pay
 *  id: 3 => state: Anulada, so you can't pay
 *  id: 4 => state: Realizada, so you can't pay
 *  id: 5 => OK (But the payment amount would be different)
 */
class SalePaymentCaseTest extends TestCase
{
    // JSON EXAMPLE.
    public $saleJSON = [
        // Puede cambiar de Boleta o Factura, o de Factura a Boleta
        // Si es de Boleta => Factura, se debe enviar el cliente.
        // Si es de Factura => Boleta, el cliente será null.
        "pos_sale_type" => 2, // 1: Boleta, 2: Factura
        "customer_id" => 2, // Si es factura es obligatorio
        "default_branch_office_id" => 2, // Si es factura es obligatorio

        "sale_id" => 1,
        "cashier_user_id" => 1,
        "cash_desk_id" => 1,
        // Si el total es $2.000 y el cliente paga con $3.000, se sigue
        // enviando $2.000 (El vuelto se trabaja en el frontend)
        // En este caso, para id: 1, la venta es de $261 (Era boleta)
        "sale_payment" => [
            [
                "id_sale_payment_id" => 1,
                "amount_payment" => 101,
                "rounding_law" => 0
            ],
            [
                "id_sale_payment_id" => 2,
                "amount_payment" => 160,
                'voucher_number' => 168901
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
        $this->withoutExceptionHandling();
        $this->tempSaleJson = $this->saleJSON;
    }

    /**
     * Function to call a HTTP POST Request to pay a sale
     *
     * @return void
     */
    private function paySale() {
        return $this->json('POST', 'api/pos_sale/pay', $this->tempSaleJson);
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
     * Should throw exception if sale doesn't exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleDoesntExists() {
        $this->expectException(ModelNotFoundException::class);
        $this->tempSaleJson['sale_id'] = -1;
        $response = $this->paySale();
    }

    /**
     * Test should throw exception if DTE is invoice and customer is not sended
     *
     * @return void
     */
    public function test_shouldThrowException_IfDTEIsInvoice_AndCustomerIsNotSended()
    {
        $this->expectException(ValidationException::class);
        $this->tempSaleJson['customer_id'] = null;
        $response = $this->paySale();
    }

    /**
     * Test should throw exception if DTE is invoice and customer doesn't exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfDTEIsInvoice_AndCustomerDoesntExists()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->tempSaleJson['customer_id'] = -1;
        $response = $this->paySale();
    }

    public function test_shouldThrowExceptionIfPosSaleType_DoesntExists()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->tempSaleJson['pos_sale_type'] = -1;
        $response = $this->paySale();
    }

    /**
     * Should throw exception if sale payment doesn't exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfSalePaymentDoesntExists() {
        $this->expectException(ModelNotFoundException::class);
        $this->tempSaleJson['sale_id'] = 5;
        $this->tempSaleJson['pos_sale_type'] = SaleConstant::TICKET;
        $this->tempSaleJson['sale_payment'][0]['id_sale_payment_id'] = -1;
        $response = $this->paySale();
    }

    /**
     * Should throw exception if cash desk doesn't exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfCashDeskDoesntExists() {
        $this->expectException(ModelNotFoundException::class);
        $this->tempSaleJson['sale_id'] = 5;
        $this->tempSaleJson['cash_desk_id'] = -1;
        $response = $this->paySale();
    }

    /**
     * Should throw exception if sale flag_delete property is true
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleFlagDeleteIsTrue() {
        $this->expectException(ValidationException::class);
        $this->tempSaleJson['sale_id'] = 2;
        $response = $this->paySale();
    }

    /**
     * Should throw exception if sale is canceled
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleIsCanceled() {
        $this->expectException(ValidationException::class);
        $this->tempSaleJson['sale_id'] = 3;
        $response = $this->paySale();
    }

    /**
     * Should throw exception if sale is accomplished
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleIsAccomplished() {
        $this->expectException(ValidationException::class);
        $this->tempSaleJson['sale_id'] = 4;
        $response = $this->paySale();
    }

    /**
     * Should throw exception if sum of payment is not equals to sale total
     *
     * @return void
     */
    public function test_shouldThrowException_IfPaymentIsDifferentToTotalSale() {
        $this->expectException(ValidationException::class);
        $this->tempSaleJson['sale_id'] = 5;
        $this->tempSaleJson['sale_payment'][0]['amount_payment'] = 2000;
        $response = $this->paySale();
    }

    /**
     * Should be Ok if a payment is generated in normal conditions
     * and DTE Changes from Ticket to Invoice
     *
     * @return void
     */
    public function test_paySale_FromTicketToInvoice()
    {
        // Factura es 262 y boleta es 261.
        PosSale::where('id', $this->tempSaleJson['sale_id'])->update(['g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA]);
        $this->tempSaleJson['sale_payment'][0]['amount_payment'] = 102;
        $this->tempSaleJson['purchase_order'] = 848484;
        $response = $this->paySale();
        $response->assertStatus(200)
                         ->assertJson([
                             'status' => 'success',
                             'http_status_code' => 200
                         ])
                         ->assertJsonStructure([
                             'status',
                             'http_status_code',
                             'dte'
                         ]);

        $this->assertDatabaseHas('pos_sale',[
            'id' => $this->tempSaleJson['sale_id'],
            'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
            'pos_sale_type_id' => SaleConstant::INVOICE,
            'sl_customer_id' => $this->tempSaleJson['customer_id'],
            'pos_cash_desk_id' => $this->tempSaleJson['cash_desk_id']
        ]);

        $this->assertDatabaseHas('pos_payment_voucher',[
            'pos_sale_id' => $this->tempSaleJson['sale_id'],
            'pos_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_DEBITO,
            'voucher_number' => $this->tempSaleJson['sale_payment'][1]['voucher_number'],
        ]);

        // Assert pos sale invoice data
        $this->assertDatabaseHas('pos_sale_invoice_data', [
            'pos_sale_id' => $this->tempSaleJson['sale_id'],
            'purchase_order' => $this->tempSaleJson['purchase_order'],
            'flag_delete' => false
        ]);

    }

    /**
     * Should be Ok if a payment is generated in normal conditions
     * and DTE changes from Invoice to Ticket
     *
     * @return void
     */
    public function test_paySale_FromInvoiceToTicket()
    {
        $this->tempSaleJson['sale_id'] = 10;
        PosSale::where('id', $this->tempSaleJson['sale_id'])->update(['g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA]);
        $this->tempSaleJson['pos_sale_type'] = SaleConstant::TICKET;
        $response = $this->paySale();
        $response->assertStatus(200)
                         ->assertJson([
                             'status' => 'success',
                             'http_status_code' => 200
                         ])
                         ->assertJsonStructure([
                             'status',
                             'http_status_code',
                             'dte'
                         ]);

        $this->assertDatabaseHas('pos_sale',[
            'id' => $this->tempSaleJson['sale_id'],
            'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
            'sl_customer_id' => null,
            'pos_sale_type_id' => SaleConstant::TICKET,
            'pos_cash_desk_id' => $this->tempSaleJson['cash_desk_id']
        ]);

        $this->assertDatabaseHas('pos_payment_voucher',[
            'pos_sale_id' => $this->tempSaleJson['sale_id'],
            'pos_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_DEBITO,
            'voucher_number' => $this->tempSaleJson['sale_payment'][1]['voucher_number'],
        ]);

    }

    /**
     * Should be Ok if a payment is generated in normal conditions with no DTE changes
     *
     * @return void
     */
    public function test_paySale_withNoDTEChanges_And_CashWith_RoundingLaw()
    {
        // Factura es 262 y boleta es 261. (con ley redondeo es 260 y redondeo 1)
        $this->tempSaleJson['pos_sale_type'] = SaleConstant::TICKET;
        $this->tempSaleJson['sale_id'] = 11;
        PosSale::where('id', $this->tempSaleJson['sale_id'])->update(['g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA]);
        $this->tempSaleJson["sale_payment"] = [
            [
                "id_sale_payment_id" => 1,
                "amount_payment" => 260,
                "rounding_law" => -1
            ]
        ];
        $response = $this->paySale();
        $response->assertStatus(200)
                         ->assertJson([
                             'status' => 'success',
                             'http_status_code' => 200
                         ])
                         ->assertJsonStructure([
                             'status',
                             'http_status_code',
                             'dte'
                         ]);

        $this->assertDatabaseHas('pos_sale',[
            'id' => $this->tempSaleJson['sale_id'],
            'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
            'pos_sale_type_id' => SaleConstant::TICKET,
            'pos_cash_desk_id' => $this->tempSaleJson['cash_desk_id']
        ]);

        $this->assertDatabaseHas('pos_payment_cash',[
            'pos_sale_id' => $this->tempSaleJson['sale_id'],
            'pos_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_EFECTIVO,
            'rounding_law' => $this->tempSaleJson['sale_payment'][0]['rounding_law'],
        ]);

    }

    /**
     * Should throw exception if payment is with bank check with no bank check data
     *
     * @return void
     */
    public function test_paySale_withNoDTEChanges_And_NoBankCheckData()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);
        // Factura es 262 y boleta es 261.
        $this->tempSaleJson['pos_sale_type'] = SaleConstant::TICKET;
        $this->tempSaleJson['sale_id'] = 12;
        $this->tempSaleJson['sale_payment'] = [
            [
                'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
                'amount_payment' => 261
            ]
        ];
        $response = $this->paySale();
    }

    /**
     * Should throw exception if check payment type doesnt exists
     *
     * @return void
     */
    public function test_paySale_withNoDTEChanges_And_BankCheckPaymentCheckTypeDoesntExists()
    {
        $this->expectException(ModelNotFoundException::class);
        // Factura es 262 y boleta es 261.
        $this->tempSaleJson['pos_sale_type'] = SaleConstant::TICKET;
        $this->tempSaleJson['sale_id'] = 12;
        $this->tempSaleJson['sale_payment'] = [
            [
                'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
                'amount_payment' => 261,
                'g_bank_id' => 1,
                'account_number' => 123456,
                'plaza' => 453,
                'pos_payment_check_type_id' => -1, // 1: Cheque a Fecha, 2: Cheque al Día
                'charge_date' => date('Y-m-d', strtotime('+15 days')),
                'serial_number' => 'ABC-DEF-GHI'
            ]
        ];
        $response = $this->paySale();
    }

    /**
     * Should throw exception if check payment is "Cheque a Fecha", and "charge_date" is not sended
     *
     * @return void
     */
    public function test_paySale_withNoDTEChanges_And_BankCheckPaymentIsChequeFecha_And_ChargeDateIsNotSended()
    {
        $this->expectException(ValidationException::class);
        // Factura es 262 y boleta es 261.
        $this->tempSaleJson['pos_sale_type'] = SaleConstant::TICKET;
        $this->tempSaleJson['sale_id'] = 12;
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
        $response = $this->paySale();

        $this->assertError($response);
    }

    /**
     * Should throw exception if voucher number is not sended
     *
     * @return void
     */
    public function test_paySale_ShouldThrowException_IfVoucherNumberIsNotSended()
    {
        $this->expectException(ValidationException::class);
        // Factura es 262 y boleta es 261.
        $this->tempSaleJson['pos_sale_type'] = SaleConstant::TICKET;
        $this->tempSaleJson['sale_id'] = 14;
        $this->tempSaleJson['sale_payment'][1] = [
            "id_sale_payment_id" => 2,
            "amount_payment" => 160,
            // 'voucher_number' => 168901
        ];
        $response = $this->paySale();

    }

    /**
     * Should be Ok if a payment is paid with a bank check (cheque a fecha)
     *
     * @return void
     */
    public function test_paySale_withNoDTEChanges_And_WithABankCheck_ChequeAFecha()
    {
        // Factura es 262 y boleta es 261.
        $this->tempSaleJson['pos_sale_type'] = SaleConstant::TICKET;
        $this->tempSaleJson['sale_id'] = 12;
        $this->tempSaleJson['sale_payment'] = [
            [
                'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
                'amount_payment' => 261,
                'g_bank_id' => 1,
                'account_number' => 123456,
                'plaza' => 453,
                'pos_payment_check_type_id' => SaleConstant::CHEQUE_FECHA, // 1: Cheque a Fecha, 2: Cheque al Día
                'charge_date' => date('Y-m-d', strtotime('+15 days')),
                'serial_number' => 'ABC-DEF-GHI'
            ]
        ];
        $response = $this->paySale();
        $response->assertStatus(200)
                         ->assertJson([
                             'status' => 'success',
                             'http_status_code' => 200
                         ])
                         ->assertJsonStructure([
                             'status',
                             'http_status_code',
                             'dte'
                         ]);

        $this->assertDatabaseHas('pos_sale',[
            'id' => $this->tempSaleJson['sale_id'],
            'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
            'pos_sale_type_id' => SaleConstant::TICKET,
            'pos_cash_desk_id' => $this->tempSaleJson['cash_desk_id']
        ]);

        $this->assertDatabaseHas('pos_payment_check',[
            'pos_sale_id' => $this->tempSaleJson['sale_id'],
            'pos_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
            'pos_payment_check_type_id' => SaleConstant::CHEQUE_FECHA,
            'amount' => 261,
            'g_bank_id' => 1,
            'account_number' => 123456,
            'plaza' => 453,
            'pos_payment_check_type_id' => SaleConstant::CHEQUE_FECHA, // 1: Cheque a Fecha, 2: Cheque al Día
            'charge_date' => date('Y-m-d', strtotime('+15 days')),
            'serial_number' => 'ABC-DEF-GHI'
        ]);

    }

    /**
     * Should be Ok if a payment is paid with a bank check (cheque al día)
     *
     * @return void
     */
    public function test_paySale_withNoDTEChanges_And_WithABankCheck_ChequeAlDia()
    {
        // Factura es 262 y boleta es 261.
        $this->tempSaleJson['pos_sale_type'] = SaleConstant::TICKET;
        $this->tempSaleJson['sale_id'] = 13;
        $this->tempSaleJson['sale_payment'] = [
            [
                'id_sale_payment_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
                'amount_payment' => 261,
                'g_bank_id' => 1,
                'account_number' => 123456,
                'plaza' => 453,
                'pos_payment_check_type_id' => SaleConstant::CHEQUE_DIA, // 1: Cheque a Fecha, 2: Cheque al Día
                'charge_date' => null,
                'serial_number' => 'ABC-DEF-GHJ'
            ]
        ];
        $response = $this->paySale();
        $response->assertStatus(200)
                         ->assertJson([
                             'status' => 'success',
                             'http_status_code' => 200
                         ])
                         ->assertJsonStructure([
                             'status',
                             'http_status_code',
                             'dte'
                         ]);

        $this->assertDatabaseHas('pos_sale',[
            'id' => $this->tempSaleJson['sale_id'],
            'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
            'pos_sale_type_id' => SaleConstant::TICKET,
            'pos_cash_desk_id' => $this->tempSaleJson['cash_desk_id']
        ]);

        $this->assertDatabaseHas('pos_payment_check',[
            'pos_sale_id' => $this->tempSaleJson['sale_id'],
            'pos_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_BANK_CHECK,
            'pos_payment_check_type_id' => SaleConstant::CHEQUE_FECHA,
            'amount' => 261,
            'g_bank_id' => 1,
            'account_number' => 123456,
            'plaza' => 453,
            'pos_payment_check_type_id' => SaleConstant::CHEQUE_DIA, // 1: Cheque a Fecha, 2: Cheque al Día
            'charge_date' => null,
            'serial_number' => 'ABC-DEF-GHJ'
        ]);

    }

}
