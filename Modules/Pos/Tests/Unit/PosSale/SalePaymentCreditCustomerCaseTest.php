<?php

namespace Modules\Pos\Tests\Unit\PosSale;

use Tests\TestCase;
use Modules\Sale\Services\PosSale\CreditInvoiceService;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Modules\Sale\Entities\SlCustomerAccount;
use Modules\Pos\Entities\PosSale;

class SalePaymentCreditCustomerCaseTest extends TestCase
{
    private $okSale = 17;
    private $customerId = 1;

    private $saleJSON = [
        "pos_sale_type" => 2, // 1: Boleta, 2: Factura
        "customer_id" => 1, // Si es factura es obligatorio

        "sale_id" => 17,
        "cashier_user_id" => 1,
        "cash_desk_id" => 1,
        // Si el total es $2.000 y el cliente paga con $3.000, se sigue
        // enviando $2.000 (El vuelto se trabaja en el frontend)
        // En este caso, para id: 1, la venta es de $262 (Factura)
        "sale_payment" => [
            [
                "id_sale_payment_id" => 5,
                "amount_payment" => 262,
                'customer_credit_option_id' => 3
            ]
        ]
    ];

    private $tempSaleJson;

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
     * Test should be ok dividing account receivable.
     * $100.000 30 días. => $100.000
     * $100.000 60 días. => $50.000, $50.000
     * $100.000 90 días. => $33.333, $33.333, $33.334
     *
     * @return void
     */
    public function test_DivideAccountsReceivable_Case1()
    {
        $creditInvoiceService = new CreditInvoiceService();
        $amounts1 = $creditInvoiceService->divideAccountsReceivable(SaleConstant::POS_CUSTOMER_CREDIT_30_DAYS, 100000);
        $amounts2 = $creditInvoiceService->divideAccountsReceivable(SaleConstant::POS_CUSTOMER_CREDIT_60_DAYS, 100000);
        $amounts3 = $creditInvoiceService->divideAccountsReceivable(SaleConstant::POS_CUSTOMER_CREDIT_90_DAYS, 100000);

        $this->assertEquals($amounts1[0], 100000);

        $this->assertEquals($amounts2[0], 50000);
        $this->assertEquals($amounts2[1], 50000);

        $this->assertEquals($amounts3[0], 33333);
        $this->assertEquals($amounts3[1], 33333);
        $this->assertEquals($amounts3[2], 33334);
    }

    /**
     * Test should throw exception if customer credit is combined with another payment
     * Ex. Customer credit with cash or debit card
     *
     * @return void
     */
    public function test_ShouldThrowException_IfCustomerCreditIsCombinedWithAnotherPaymentType()
    {
        $this->tempSaleJson['sale_payment'] = [
            [
                "id_sale_payment_id" => 5,
                "amount_payment" => 162,
                'customer_credit_option_id' => 3
            ],
            [
                "id_sale_payment_id" => 2,
                "amount_payment" => 100,
                'voucher_number' => 200000
            ]
        ];
        $response = $this->paySale();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if customer credit option doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfCustomerCreditOptionDoesntExists()
    {
        $this->tempSaleJson['sale_payment'][0]['customer_credit_option_id'] = -1;
        $response = $this->paySale();
        $this->assertError($response);
    }

    /**
     * Test should be ok
     *
     * @return void
     */
    public function test_ShouldBeOK()
    {
        $preCustomerAccount = SlCustomerAccount::where('sl_customer_id', $this->customerId)->where('flag_delete', false)->first();

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
        // Assert pos sale
        $this->assertDatabaseHas('pos_sale',[
            'id' => $this->tempSaleJson['sale_id'],
            'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
            'pos_customer_credit_option_id' => $this->tempSaleJson['sale_payment'][0]['customer_credit_option_id'],
            'sl_customer_id' => $this->customerId,
            'pos_sale_type_id' => SaleConstant::INVOICE,
            'pos_cash_desk_id' => $this->tempSaleJson['cash_desk_id']
        ]);
        // Get sale to get sl_sale_invoice
        $sale = PosSale::where('id', $this->tempSaleJson['sale_id'])->first();
        // Assert payment table
        $this->assertDatabaseHas('pos_sale_pos_payment_type', [
            'pos_sale_payment_type_id' => $this->tempSaleJson['sale_payment'][0]['id_sale_payment_id'],
            'pos_sale_id' => $this->tempSaleJson['sale_id'],
            'amount' => $this->tempSaleJson['sale_payment'][0]['amount_payment']
        ]);
        // Assert sl_customer_account
        $this->assertDatabaseHas('sl_customer_account', [
            'sl_customer_id' => $this->customerId,
            'debt_amount' => $preCustomerAccount->debt_amount + $this->tempSaleJson['sale_payment'][0]['amount_payment'],
            'flag_delete' => false
        ]);
        // Assert sl_customer_account_receivable
        $this->assertDatabaseHas('sl_customer_account_receivable', [
            'sl_customer_account_id' => $preCustomerAccount->id,
            'sl_sale_invoice_id' => $sale->sl_sale_invoice_id,
            'amount' => 87,
            'pay_date' => date('Y-m-d', strtotime('+30 days')),
            'real_pay_date' => null,
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('sl_customer_account_receivable', [
            'sl_customer_account_id' => $preCustomerAccount->id,
            'sl_sale_invoice_id' => $sale->sl_sale_invoice_id,
            'amount' => 87,
            'pay_date' => date('Y-m-d', strtotime('+60 days')),
            'real_pay_date' => null,
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('sl_customer_account_receivable', [
            'sl_customer_account_id' => $preCustomerAccount->id,
            'sl_sale_invoice_id' => $sale->sl_sale_invoice_id,
            'amount' => 88,
            'pay_date' => date('Y-m-d', strtotime('+90 days')),
            'real_pay_date' => null,
            'flag_delete' => false
        ]);
    }

}
