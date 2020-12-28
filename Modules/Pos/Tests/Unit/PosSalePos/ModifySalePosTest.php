<?php

namespace Modules\Pos\Tests\Unit\PosSalePos;

use Tests\TestCase;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;

class ModifySalePosTest extends TestCase
{

    public $saleJSON = [
        // Venta a modificar
        "sale_to_modify_id" => 19,
        // Se reciben los code del vendedor y del supervisor en caso de
        "seller_user_code" => 874,
        "supervisor_user_code" => null,
        // Solo si ya está, si no se envía null
        "customer_id" => 1,
        // Si no está se envía:
        'customer' => null,
        'sucursal_id' => 1,
        "pos_sale_type" => 1, //Ej: Boleta
        "global_discount" => 10, // En %
        "global_discount_amount" => 0, // En monto
        "total" => 513, // Para validar los campos
        "sale_detail" => [
            [
                "product_id" => 1,
                "quantity" => 2,
                "price" => 100,
                "discount" => 10, // En %
                'discount_unit_price' => 0, // En monto
                'wh_warehouse_id' => 1
            ],
            [
                "product_id" => 2,
                "quantity" => 2,
                "price" => 200,
                "discount" => 0,
                'discount_unit_price' => 10, // En monto
                'wh_warehouse_id' => 1
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
     * Function to call a HTTP POST Request to generate a new sale
     *
     * @return void
     */
    private function modifySale() {
        return $this->json('POST', 'api/pos_sale/modify', $this->tempSaleJson);
    }

    /**
     * Function to assert and 500 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    private function assertError($response) {
        $response->assertStatus(500)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    }

    /**
     * Test should throw exception if sale doesnt exists in database
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIf_SaleDoesntExists()
    {
        $this->tempSaleJson['sale_to_modify_id'] = -1;
        $response = $this->modifySale();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if sale is canceled
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIf_SaleIsCanceled()
    {
        $this->tempSaleJson['sale_to_modify_id'] = 7;
        $response = $this->modifySale();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if sale is accomplished
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIf_SaleIsAccomplished()
    {
        $this->tempSaleJson['sale_to_modify_id'] = 8;
        $response = $this->modifySale();
        $this->assertError($response);
    }

    /**
     * Test should throw exception is sale is deleted
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIf_SaleIsDeleted()
    {
        $this->tempSaleJson['sale_to_modify_id'] = 9;
        $response = $this->modifySale();
        $this->assertError($response);
    }

    /**
     * Test should throw exception in sale total is bad (instead of $513 is $9.999)
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIf_SaleTotalIsBad()
    {
        $this->tempSaleJson['total'] = 9999;
        $response = $this->modifySale();
        $this->assertError($response);
    }

    // TODO:: Add modify test.
    public function test_shouldBeOk()
    {
        $response = $this->modifySale();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Sale
        $this->assertDatabaseHas('pos_sale',[
            'id' => $obj->sale_id,
            'ticket_total' => 513,
            'invoice_total' => 513,
            'net_subtotal' => 479,
            'discount_or_charge_percentage' => 10,
            'new_net_subtotal' => 431,
            'iva' => 82,
            'exent_total' => 0,
            'pos_sale_type_id' => $this->tempSaleJson['pos_sale_type'],
            'sl_customer_id' => $this->tempSaleJson['customer_id'],
            'g_branch_office_id' => $this->tempSaleJson['sucursal_id'],
            'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
            'flag_delete' => false
        ]);

        // Assert Detalle
        $this->assertDatabaseHas('pos_detail_sale', [
            'pos_sale_id' => $obj->sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][0]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][0]['quantity'],
            'price' => $this->saleJSON['sale_detail'][0]['price'],
            'net_price' => 84.03,
            'net_subtotal' =>168,
            'discount_or_charge_percentage' => 10,
            'discount_or_charge_value' => 0,
            'new_net_subtotal' => 151,
            'total' => 180
        ]);
        $this->assertDatabaseHas('pos_detail_sale', [
            'pos_sale_id' => $obj->sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][1]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][1]['quantity'],
            'price' => 200,
            'net_price' => 168.07,
            'net_subtotal' =>336,
            'discount_or_charge_percentage' => 0,
            'discount_or_charge_value' => 10,
            'new_net_subtotal' => 328,
            'total' => 390
        ]);

        // Assert Reserva
        $this->assertDatabaseHas('pos_sale_stock_reservation', [
           'pos_sale_id' => $obj->sale_id,
           'wh_warehouse_id' => 1,
           'wh_item_id' => 1,
           'stock' => 2
        ]);
        $this->assertDatabaseHas('pos_sale_stock_reservation', [
            'pos_sale_id' => $obj->sale_id,
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 2
        ]);

        // Assert Warehouse Item (canceled items are 1, and reserved are 2. So, minus 1 stock)
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 1,
            'stock' => 999
        ]);
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 999
        ]);

    }

}
