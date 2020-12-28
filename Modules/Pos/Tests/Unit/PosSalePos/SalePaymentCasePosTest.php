<?php

namespace Modules\Pos\Tests\Unit\PosSalePos;

use Tests\TestCase;
use Modules\Pos\Entities\PosSalePos;
use Modules\Pos\Services\PosSalePos\Entities\SaleConstant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dotenv\Exception\ValidationException;
use App\Helpers\CustomTestCase;
use Illuminate\Validation\ValidationException as IlluminateValidationException;

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
class SalePaymentCasePosTest extends CustomTestCase
{
    // JSON EXAMPLE.
    public $saleJSON = [
        // Puede cambiar de Boleta o Factura, o de Factura a Boleta
        // Si es de Boleta => Factura, se debe enviar el cliente.
        // Si es de Factura => Boleta, el cliente será null.
        "pos_sale_type_id" => 1, // 1: Boleta, 2: Factura
        "sl_customer_id" => 1, // Si es factura es obligatorio
        "pos_sale_id" => 148,
        "g_cashier_id" => 1,
        "pos_cash_desk_id" => 1,
        // Si el total es $2.000 y el cliente paga con $3.000, se sigue
        // enviando $2.000 (El vuelto se trabaja en el frontend)
        // En este caso, para id: 1, la venta es de $261 (Era boleta)
        "pos_payment_sale" => [
            [
                "pos_type_payment_method_id" => 4,
                "amount_payment" => 1000,
                "sl_customer_id" => 1,
                // 'transfer_number' => 121212
                // "rounding_law" => 0
            ],
            // [
            //     "pos_type_payment_method_id" => 2,
            //     "amount_payment" => 150,
            //     'rounding_law' => 0
            //     // 'voucher_number' => 168901
            // ]
        ]
    ];

    public $tempSaleJson;

    /**
     * Reset tempSaleJSON after each test
     *
     * @return void
     */
    protected function setUp() : void {
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
        return $this->json('POST', 'api/pos_sale_pos/pay', $this->tempSaleJson);
    }

    /**
     * Function to assert and 500 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    protected function assertError($response, $code = 500) {
        $response->assertStatus($code)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    }

    /** 
     * Should be Ok if a payment is generated in normal conditions with no DTE changes
     *
     * @return void
     */
    public function test_paySale_with_Cash_and_RoundingLaw()
    {
        // Factura es 262 y boleta es 261. (con ley redondeo es 260 y redondeo 1)
        // $this->tempSaleJson['pos_sale_type_id'] = SaleConstant::TICKET;
        // $this->tempSaleJson['pos_sale_id'] = 12;
        PosSalePos::where('id', $this->tempSaleJson['pos_sale_id'])->update(['g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA]);
        // $this->tempSaleJson["pos_payment_sale"] = [
        //     [
        //         "pos_type_payment_method_id" => 5,
        //         "amount_payment" => 4200,
        //         'transfer_number' => 121212
        //         // "rounding_law" => 0
        //     ]
        // ];
        $response = $this->paySale();
        dump($response);
        $response->assertStatus(200)
                         ->assertJson([
                             'status' => 'success',
                             'http_status_code' => 200
                         ])
                         ->assertJsonStructure([
                             'status',
                             'http_status_code'
                            //  'dte'
                         ]);
        $this->assertDatabaseHas('pos_sale_pos',[
            'id' => $this->tempSaleJson['pos_sale_id'],
            'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
            'pos_sale_type_id' => SaleConstant::TICKET,
            'pos_cash_desk_id' => $this->tempSaleJson['pos_cash_desk_id'],
            'rounding_law'=> 0,
        ]);

        $this->assertDatabaseHas('pos_payment_method_pos',[
            'pos_sale_id' => $this->tempSaleJson['pos_sale_id'],
            'pos_type_payment_method_id' => SaleConstant::PAYMENT_TYPE_EFECTIVO,
            // 'sl_customer_id' => $this->tempSaleJson['pos_payment_sale'][0]['sl_customer_id'],
            'amount_payment' => $this->tempSaleJson['pos_payment_sale'][0]['amount_payment'],
            // 'transfer_number' => $this->tempSaleJson['pos_payment_sale'][0]['transfer_number'],
        ]);
        $this->assertDatabaseHas('pos_trust_sale_pos',[
            'pos_sale_id' => $this->tempSaleJson['pos_sale_id'],
            'pos_payment_method_id' => SaleConstant::PAYMENT_TYPE_EFECTIVO,
            'sl_customer_id' => $this->tempSaleJson['pos_payment_sale'][0]['sl_customer_id'],
            'amount_payment' => $this->tempSaleJson['pos_payment_sale'][0]['amount_payment'],
            // 'transfer_number' => $this->tempSaleJson['pos_payment_sale'][0]['transfer_number'],
        ]);

    }

    /**
     * Should throw exception if sale doesn't exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleDoesntExists() {
        // $this->expectException(ModelNotFoundException::class);
        $this->expectException(IlluminateValidationException::class);
        $this->tempSaleJson['pos_sale_id'] = -1;
        $response = $this->paySale();
        $this->dumpError($response);
        $this->assertError($response);
    }

    /*
     * Test should throw exception if DTE is invoice and customer is not sended
     *
     * @return void
     *
    public function test_shouldThrowException_IfDTEIsInvoice_AndCustomerIsNotSended()
    {
        $this->expectException(ValidationException::class);
        $this->tempSaleJson['customer_id'] = null;
        $response = $this->paySale();
        $this->assertError($response);
        //dump($response);
    }*/

    /*
     * Test should throw exception if DTE is invoice and customer doesn't exists
     *
     * @return void
     *
    public function test_shouldThrowException_IfDTEIsInvoice_AndCustomerDoesntExists()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->tempSaleJson['customer_id'] = -1;
        $response = $this->paySale();
    }*/

    // public function test_shouldThrowExceptionIfPosSaleType_DoesntExists()
    // {
    //     $this->expectException(IlluminateValidationException::class);

    //     // $this->expectException(ModelNotFoundException::class);
    //     $this->tempSaleJson['pos_sale_type_id'] = -1;
    //     $response = $this->paySale();
    //     dump($response);
    // }

    // /**
    //  * Should throw exception if sale payment doesn't exists
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfSalePaymentDoesntExists() {
    //     $this->expectException(IlluminateValidationException::class);

    //     // $this->expectException(ModelNotFoundException::class);
    //     $this->tempSaleJson['pos_sale_id'] = 5;
    //     $this->tempSaleJson['pos_sale_type_id'] = SaleConstant::TICKET;
    //     $this->tempSaleJson['pos_payment_sale'][0]['pos_type_payment_method_id'] = -1;
    //     $response = $this->paySale();  
    // }

    // /**
    //  * Should throw exception if cash desk doesn't exists
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfCashDeskDoesntExists() {
    //     // $this->expectException(ModelNotFoundException::class);
    //     $this->expectException(IlluminateValidationException::class);

    //     $this->tempSaleJson['pos_sale_id'] = 5;
    //     $this->tempSaleJson['pos_cash_desk_id'] = -1;
    //     $response = $this->paySale();
    // }

    // /**
    //  * Should throw exception if sale flag_delete property is true
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfSaleFlagDeleteIsTrue() {
    //     $this->expectException(ValidationException::class);
        
    //     $this->tempSaleJson['pos_sale_id'] = 2;
    //     $response = $this->paySale();
    // }

    // /** 
    //  * Should throw exception if sale is canceled
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfSaleIsCanceled() {
    //     $this->expectException(ValidationException::class);
    //     $this->tempSaleJson['pos_sale_id'] = 3;
    //     $response = $this->paySale();
    // }

    // /** 
    //  * Should throw exception if sale is accomplished
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfSaleIsAccomplished() {
    //     $this->expectException(ValidationException::class);
    //     $this->tempSaleJson['pos_sale_id'] = 4;
    //     $response = $this->paySale();
    // }

    // /** 
    //  * Should throw exception if sum of payment is not equals to sale total
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfPaymentIsDifferentToTotalSale() {
    //     $this->expectException(ValidationException::class);
    //     $this->tempSaleJson['pos_sale_id'] = 5;
    //     $this->tempSaleJson['pos_payment_sale'][0]['amount_payment'] = 2000;
    //     $response = $this->paySale();
    // }

    /*
     * Should be Ok if a payment is generated in normal conditions
     * and DTE Changes from Ticket to Invoice
     *
     * @return void
     *
    public function test_paySale_FromTicketToInvoice()
    {
        // Factura es 262 y boleta es 261.
        PosSalePos::where('id', $this->tempSaleJson['sale_id'])->update(['g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA]);
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

        $this->assertDatabaseHas('pos_sale_pos',[
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

    }*/

    /*
     * Should be Ok if a payment is generated in normal conditions
     * and DTE changes from Invoice to Ticket
     *
     * @return void
     *
    public function test_paySale_FromInvoiceToTicket()
    {
        $this->tempSaleJson['sale_id'] = 10;
        PosSalePos::where('id', $this->tempSaleJson['sale_id'])->update(['g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA]);
        $this->tempSaleJson['pos_sale_type_pos'] = SaleConstant::TICKET;
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

        $this->assertDatabaseHas('pos_sale_pos',[
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

    }*/

    /*
     * Should throw exception if voucher number is not sended
     *
     * @return void
     *
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

    }*/

}
