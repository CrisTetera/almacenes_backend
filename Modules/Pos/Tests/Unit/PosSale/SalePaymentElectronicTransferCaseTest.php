<?php

namespace Modules\Pos\Tests\Unit\PosSale;

use Tests\TestCase;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;

class SalePaymentElectronicTransferCaseTest extends TestCase
{

    private $okSale = 18;
    private $customerId = 1;

    private $saleJSON = [
        "pos_sale_type" => 2, // 1: Boleta, 2: Factura
        "customer_id" => 1, // Si es factura es obligatorio

        "sale_id" => 18,
        "cashier_user_id" => 1,
        "cash_desk_id" => 1,
        // Si el total es $2.000 y el cliente paga con $3.000, se sigue
        // enviando $2.000 (El vuelto se trabaja en el frontend)
        // En este caso, para id: 1, la venta es de $262 (Factura)
        "sale_payment" => [
            [
                "id_sale_payment_id" => 6, // Electronic Transfer
                "amount_payment" => 262,
                'transfer_number' => 121212
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
     * Test should be ok
     *
     * @return void
     */
    public function test_ShouldBeOK()
    {
        $response = $this->paySale();
        dump( $response->content() );
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
            'sl_customer_id' => $this->customerId,
            'pos_sale_type_id' => SaleConstant::INVOICE,
            'pos_cash_desk_id' => $this->tempSaleJson['cash_desk_id']
        ]);
        // Assert payment table
        $this->assertDatabaseHas('pos_sale_pos_payment_type', [
            'pos_sale_payment_type_id' => $this->tempSaleJson['sale_payment'][0]['id_sale_payment_id'],
            'pos_sale_id' => $this->tempSaleJson['sale_id'],
            'amount' => $this->tempSaleJson['sale_payment'][0]['amount_payment']
        ]);
        // Assert payment table
        $this->assertDatabaseHas('pos_payment_electronic_transfer', [
            'pos_sale_payment_type_id' => $this->tempSaleJson['sale_payment'][0]['id_sale_payment_id'],
            'pos_sale_id' => $this->tempSaleJson['sale_id'],
            'transfer_number' => $this->tempSaleJson['sale_payment'][0]['transfer_number']
        ]);
    }


}
