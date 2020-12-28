<?php

namespace Modules\Pos\Tests\Unit\PosEmployeeSale;

use Tests\TestCase;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Modules\Warehouse\Entities\WhWarehouseItem;


class GenerateEmployeeSaleTest extends TestCase
{
    // JSON EXAMPLE.
    public $saleJSON = [
        "employee_id" => 1,
        "seller_user_code" => '875',
        "supervisor_user_code" => 'U00000008740',
        'sucursal_id' => 1,
        "global_discount" => 10, // En %
        "global_discount_amount" => 0, // En %
        "total" => 252, // Para validar los campos
        "sale_detail" => [
            [
                "product_id" => 1,
                "quantity" => 1,
                "price" => 100,
                "discount" => 10, // En %
                'discount_unit_price' => 0, // En monto
                'wh_warehouse_id' => 1
            ],
            [
                "product_id" => 2,
                "quantity" => 1,
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
    private function newEmployeeSale() {
        return $this->json('POST', 'api/pos_employee_sale', $this->tempSaleJson);
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
     * Should save employee sale
     *
     * @return void
     */
    public function test_saveEmployeeSale()
    {

        $bodItem1 = WhWarehouseItem::where('wh_warehouse_id', 1)->where('wh_item_id', 1)->first();
        $bodItem2 = WhWarehouseItem::where('wh_warehouse_id', 1)->where('wh_item_id', 2)->first();

        $this->tempSaleJson['customer_id'] = null;
        $response = $this->newEmployeeSale();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'employee_sale_id',
                     'employee_sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Sale
        $this->assertDatabaseHas('pos_employee_sale',[
            'id' => $obj->employee_sale_id,
            'ticket_total' => 252,
            'invoice_total' => 252,
            'net_subtotal' => 236,
            'discount_or_charge_percentage' => 10,
            'discount_or_charge_amount' => 0,
            'new_net_subtotal' => 212,
            'iva' => 40,
            'exent_total' => 0,
            'g_branch_office_id' => $this->tempSaleJson['sucursal_id'],
            'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
            'close_sale_datetime' => null,
            'flag_delete' => false
        ]);

        // Assert Detalle
        $this->assertDatabaseHas('pos_detail_employee_sale', [
            'pos_employee_sale_id' => $obj->employee_sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][0]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][0]['quantity'],
            'price' => $this->saleJSON['sale_detail'][0]['price'],
            'net_price' => 84.03,
            'net_subtotal' =>84,
            'discount_or_charge_percentage' => 10,
            'discount_or_charge_value' => 0,
            'new_net_subtotal' => 76,
            'total' => 90
        ]);
        $this->assertDatabaseHas('pos_detail_employee_sale', [
            'pos_employee_sale_id' => $obj->employee_sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][1]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][1]['quantity'],
            'price' => 200,
            'net_price' => 168.07,
            'net_subtotal' =>168,
            'discount_or_charge_percentage' => 0,
            'discount_or_charge_value' => 10,
            'new_net_subtotal' => 160,
            'total' => 190
        ]);

        // Assert Reserva
        $this->assertDatabaseHas('pos_employee_sale_stock_reservation', [
           'pos_employee_sale_id' => $obj->employee_sale_id,
           'wh_warehouse_id' => 1,
           'wh_item_id' => 1,
           'stock' => 1
        ]);
        $this->assertDatabaseHas('pos_employee_sale_stock_reservation', [
            'pos_employee_sale_id' => $obj->employee_sale_id,
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 1
        ]);

        // Assert Warehouse Item
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 1,
            'stock' => (int)$bodItem1->stock - 1
        ]);
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => (int)$bodItem2->stock - 1
        ]);
    }

     /**
     * Should save employee sale with global amount
     *
     * @return void
     */
    public function test_saveEmployeeSale_WithGlobalAmount()
    {

        $bodItem1 = WhWarehouseItem::where('wh_warehouse_id', 1)->where('wh_item_id', 1)->first();
        $bodItem2 = WhWarehouseItem::where('wh_warehouse_id', 1)->where('wh_item_id', 2)->first();

        $this->tempSaleJson['total'] = 180;
        $this->tempSaleJson['global_discount'] = 0;
        $this->tempSaleJson['global_discount_amount'] = 100;
        $this->tempSaleJson['customer_id'] = null;
        $response = $this->newEmployeeSale();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'employee_sale_id',
                     'employee_sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Sale
        $this->assertDatabaseHas('pos_employee_sale',[
            'id' => $obj->employee_sale_id,
            'ticket_total' => 180,
            'invoice_total' => 181,
            'net_subtotal' => 236,
            'discount_or_charge_percentage' => 0,
            'discount_or_charge_amount' => 100,
            'new_net_subtotal' => 152,
            'iva' => 29,
            'exent_total' => 0,
            'g_branch_office_id' => $this->tempSaleJson['sucursal_id'],
            'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
            'close_sale_datetime' => null,
            'flag_delete' => false
        ]);

        // Assert Detalle
        $this->assertDatabaseHas('pos_detail_employee_sale', [
            'pos_employee_sale_id' => $obj->employee_sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][0]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][0]['quantity'],
            'price' => $this->saleJSON['sale_detail'][0]['price'],
            'net_price' => 84.03,
            'net_subtotal' =>84,
            'discount_or_charge_percentage' => 10,
            'discount_or_charge_value' => 0,
            'new_net_subtotal' => 76,
            'total' => 90
        ]);
        $this->assertDatabaseHas('pos_detail_employee_sale', [
            'pos_employee_sale_id' => $obj->employee_sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][1]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][1]['quantity'],
            'price' => 200,
            'net_price' => 168.07,
            'net_subtotal' =>168,
            'discount_or_charge_percentage' => 0,
            'discount_or_charge_value' => 10,
            'new_net_subtotal' => 160,
            'total' => 190
        ]);

        // Assert Reserva
        $this->assertDatabaseHas('pos_employee_sale_stock_reservation', [
           'pos_employee_sale_id' => $obj->employee_sale_id,
           'wh_warehouse_id' => 1,
           'wh_item_id' => 1,
           'stock' => 1
        ]);
        $this->assertDatabaseHas('pos_employee_sale_stock_reservation', [
            'pos_employee_sale_id' => $obj->employee_sale_id,
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 1
        ]);

        // Assert Warehouse Item
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 1,
            'stock' => (int)$bodItem1->stock - 1
        ]);
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => (int)$bodItem2->stock - 1
        ]);
    }

    /**
     * Should throw an exception if global sale data has a bad data
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleDataIsBad() {
        $this->tempSaleJson['total'] = 5000;
        $response = $this->newEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw an exception if sale has no products
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleHasNoProducts() {
        $this->tempSaleJson['sale_detail'] = [];
        $response = $this->newEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw an exception, if employee doesnt exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfEmployee_DoesntExists() {
        $this->tempSaleJson['employee_id'] = -1;
        $response = $this->newEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw an exception, if seller user doesnt exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfSellerUser_DoesntHasPermission() {
        $this->tempSaleJson['seller_user_code'] = 870;
        $response = $this->newEmployeeSale();
        $this->assertError($response);
    }

     /**
     * Should throw an exception, if supervisor user doesnt exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfSupervisorUser_DoesntHasPermission() {
        $this->tempSaleJson['supervisor_user_code'] = 870;
        $response = $this->newEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception, if branch office doesnt exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfBranchOffice_DoesntExists() {
        $this->tempSaleJson['sucursal_id'] = -1;
        $response = $this->newEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product doesn't exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductDoesntExists() {
        $this->tempSaleJson['sale_detail'][1]['product_id'] = -1;
        $response = $this->newEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product has no price
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductHasNoPrice() {
        $this->tempSaleJson['sale_detail'][1]['product_id'] = 11;
        $response = $this->newEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product is not salable
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductIsNotSalable() {
        $this->tempSaleJson['sale_detail'][0]['product_id'] = 3;
        $response = $this->newEmployeeSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product stock is insufficient
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductStockIsInsufficient() {
        $this->tempSaleJson['total'] = 8100090;
        $this->tempSaleJson['sale_detail'][0]['quantity'] = 99999;
        $response = $this->newEmployeeSale();
        $this->assertError($response);
    }
}
