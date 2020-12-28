<?php

namespace Modules\Warehouse\Tests\Unit\WhWarehouseType;

use Tests\TestCase;

class WarehouseTypeServiceTest extends TestCase
{
    public $json = [
        'type' => 'Bodega Mágica'
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
    private function storeWarehouseType() {
        return $this->json('POST', 'api/wh_warehouse_type', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateWarehouseType($id) {
        return $this->json('PUT', "api/wh_warehouse_type/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteWarehouseType($id) {
        return $this->json('DELETE', "api/wh_warehouse_type/$id");
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
        $response = $this->storeWarehouseType();
        $response->assertStatus(422);
    }

    /**
     * Test should store warehouse type
     *
     * @return void
     */
    public function test_ShouldStoreWarehouseType()
    {
        $response = $this->storeWarehouseType();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201,
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'warehouse_type_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert wh warehouse type
        $this->assertDatabaseHas('wh_warehouse_type', [
            'id' => $obj->warehouse_type_id,
            'type' => $this->tempJson['type'],
            'flag_delete' => false
        ]);
        return $obj->warehouse_type_id;
    }

    /**
     * Test should throw exception if warehouse type doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfWarehouseTypeDoesntExists()
    {
        $response = $this->updateWarehouseType(-1);
        $this->assertError($response, 500);
    }

    /**
     * Test should update warehouse type
     *
     * @depends test_ShouldStoreWarehouseType
     * @return void
     */
    public function test_ShouldUpdateWarehouseType($id)
    {
        $this->tempJson = [
            'type' => 'Bodega Ultra Mágica'
        ];
        $response = $this->updateWarehouseType($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code'
                 ]);

        // Assert wh warehouse type
        $this->assertDatabaseHas('wh_warehouse_type', [
            'id' => $id,
            'type' => $this->tempJson['type'],
            'flag_delete' => false
        ]);
    }

    /**
     * Test should throw exception if warehouse type doesn't exists when delete
     *
     * @return void
     */
    public function test_ShouldThrowException_IfWarehouseTypeDoesntExists_WhenDelete()
    {
        $response = $this->deleteWarehouseType(-1);
        $this->assertError($response, 500);
    }

    /**
     * Test should delete warehouse type
     *
     * @depends test_ShouldStoreWarehouseType
     * @return void
     */
    public function test_ShouldDeleteWarehouseType($id)
    {
        $response = $this->deleteWarehouseType($id);
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
        $this->assertDatabaseHas('wh_warehouse_type', [
            'id' => $id,
            'flag_delete' => true
        ]);
    }
}
