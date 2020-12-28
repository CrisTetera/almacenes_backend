<?php

namespace Modules\Warehouse\Tests\Unit\WhWarehouse;

use Tests\TestCase;
use function GuzzleHttp\json_decode;

class WarehouseServiceTest extends TestCase
{
    public $json = [
        'g_branch_office_id' => 1,
        'wh_warehouse_type_id' => 1,
        'name' => 'WASTED BOD',
        'description' => '',
        'address' => 'En tu corazón',
        'is_waste_warehouse' => true
    ];

    public $tempJson;

    /**
     * Reset tempJson after each test
     *
     * @return void
     */
    protected function setUp() {
        parent::setUp();
        $this->tempJson = $this->json;
    }

    /**
     * Function to call a HTTP POST
     *
     * @return void
     */
    private function storeWarehouse() {
        return $this->json('POST', 'api/wh_warehouse', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateWarehouse($id) {
        return $this->json('PUT', "api/wh_warehouse/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteWarehouse($id) {
        return $this->json('DELETE', "api/wh_warehouse/$id");
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
                     'status' => 'error',
                     'http_status_code' => $code
                 ]);
    }

    /**
     * Test should throw exception if there is no params sended
     *
     * @return void
     */
    public function test_ShouldThrowException_IfThereIsNoParamsSended()
    {
        $this->tempJson = [];
        $response = $this->storeWarehouse();
        $response->assertStatus(422);
    }

    /**
     * Test should store warehouse
     *
     * @return void
     */
    public function test_ShouldStoreWarehouse()
    {
        $response = $this->storeWarehouse();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201,
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'warehouse_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert wh warehouse
        $this->assertDatabaseHas('wh_warehouse', [
            'id' => $obj->warehouse_id,
            'g_branch_office_id' => $this->tempJson['g_branch_office_id'],
            'wh_warehouse_type_id' => $this->tempJson['wh_warehouse_type_id'],
            'name' => $this->tempJson['name'],
            'description' => $this->tempJson['description'],
            'address' => $this->tempJson['address'],
            'is_waste_warehouse' => $this->tempJson['is_waste_warehouse'],
            'flag_delete' => false
        ]);
        return $obj->warehouse_id;
    }

    /**
     * Test should throw exception if warehouse doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfWarehouseDoesntExists()
    {
        $response = $this->updateWarehouse(-1);
        $this->assertError($response, 500);
    }

    /**
     * Test should update warehouse type
     *
     * @depends test_ShouldStoreWarehouse
     * @return void
     */
    public function test_ShouldUpdateWarehouse($id)
    {
        $this->tempJson = [
            'g_branch_office_id' => 1,
            'wh_warehouse_type_id' => 2,
            'name' => 'BODEGA MÁGICA',
            'description' => 'BOD DESC',
            'address' => '',
            'is_waste_warehouse' => false
        ];
        $response = $this->updateWarehouse($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code'
                 ]);

        // Assert wh warehouse
        $this->assertDatabaseHas('wh_warehouse', [
            'id' => $id,
            'g_branch_office_id' => $this->tempJson['g_branch_office_id'],
            'wh_warehouse_type_id' => $this->tempJson['wh_warehouse_type_id'],
            'name' => $this->tempJson['name'],
            'description' => $this->tempJson['description'],
            'address' => $this->tempJson['address'],
            'is_waste_warehouse' => $this->tempJson['is_waste_warehouse'],
            'flag_delete' => false
        ]);
    }

    /**
     * Test should throw exception if warehouse type doesn't exists when delete
     *
     * @return void
     */
    public function test_ShouldThrowException_IfWarehouseDoesntExists_WhenDelete()
    {
        $response = $this->deleteWarehouse(-1);
        $this->assertError($response, 500);
    }

    /**
     * Test should delete warehouse
     *
     * @depends test_ShouldStoreWarehouse
     * @return void
     */
    public function test_ShouldDeleteWarehouse($id)
    {
        $response = $this->deleteWarehouse($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code'
                 ]);

        // Assert wh orderer
        $this->assertDatabaseHas('wh_warehouse', [
            'id' => $id,
            'flag_delete' => true
        ]);
    }
}
