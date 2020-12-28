<?php

namespace Modules\Pos\Tests\PosInternalConsumption;

use Tests\TestCase;

class GenerateInternalConsumptionTest extends TestCase
{

    // JSON EXAMPLE.
    public $saleJSON = [
        "description" => 'Esto es un consumo interno',
        'requester_employee_id' => 1,
        "seller_user_code" => '874',
        "sucursal_id" => 1,
        "sale_detail" => [
            [
                "product_id" => 9,
                "quantity" => 2,
                'wh_warehouse_id' => 1
            ],
            [
                "product_id" => 10,
                "quantity" => 10,
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
    private function newInternalConsumption() {
        return $this->json('POST', 'api/pos_internal_consumption', $this->tempSaleJson);
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
     * Should store internal consumption in database
     *
     * @return void
     */
    public function test_saveInternalConsumption()
    {
        $response = $this->newInternalConsumption();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'internal_consumption_id',
                     'internal_consumption_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Internal Consumption
        $this->assertDatabaseHas('pos_internal_consumption',[
            'id' => $obj->internal_consumption_id,
            'g_branch_office_id' => $this->tempSaleJson['sucursal_id'],
            'g_seller_user_id' => 2,
            'hr_requester_employee_id' => $this->tempSaleJson['requester_employee_id'],
            'flag_delete' => false
        ]);

        // Assert Detalle
        $this->assertDatabaseHas('pos_detail_internal_consumption', [
            'pos_internal_consumption_id' => $obj->internal_consumption_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][0]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][0]['quantity']
        ]);
        $this->assertDatabaseHas('pos_detail_internal_consumption', [
            'pos_internal_consumption_id' => $obj->internal_consumption_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][1]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][1]['quantity']
        ]);

        // Assert Warehouse Item
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 9,
            'stock' => 998
        ]);
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 10,
            'stock' => 990
        ]);
    }

    /**
     * Should throw an exception if sale has no products
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleHasNoProducts() {
        $this->tempSaleJson['sale_detail'] = [];
        $response = $this->newInternalConsumption();
        $this->assertError($response);
    }

    /**
     * Should throw exception, if branch office doesnt exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfBranchOffice_DoesntExists() {
        $this->tempSaleJson['sucursal_id'] = -1;
        $response = $this->newInternalConsumption();
        $this->assertError($response);
    }

     /**
     * Should throw exception, if requester employee doesnt exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfRequesterEmployee_DoesntExists() {
        $this->tempSaleJson['requester_employee_id'] = -1;
        $response = $this->newInternalConsumption();
        $this->assertError($response);
    }

    /**
     * Should throw exception, if seller user doesnt has permission
     *
     * @return void
     */
    public function test_shouldThrowException_IfSellerUser_DoesntHasPermission() {
        $this->tempSaleJson['seller_user_code'] = '870';
        $response = $this->newInternalConsumption();
        $this->assertError($response);
    }

    /**
     * Should throw exception, if warehouse doesnt exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfWarehouse_DoesntExists() {
        $this->tempSaleJson['sale_detail'][1]['wh_warehouse_id'] = -1;
        $response = $this->newInternalConsumption();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product doesn't exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductDoesntExists() {
        $this->tempSaleJson['sale_detail'][1]['product_id'] = -1;
        $response = $this->newInternalConsumption();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product is not consumable
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductIsNotConsumable() {
        $this->tempSaleJson['sale_detail'][0]['product_id'] = 7;
        $response = $this->newInternalConsumption();
        $this->assertError($response);
    }

    /**
     * Should throw exception if there is no stock for product
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductStock_IsInsuffienct() {
        $this->tempSaleJson['sale_detail'][0]['quantity'] = 5000;
        $response = $this->newInternalConsumption();
        $this->assertError($response);
    }

}
