<?php

namespace Modules\Warehouse\Tests\Unit\WhTransferBetweenWarehouse;

use Tests\TestCase;
use Modules\Warehouse\Entities\WhTransferBetweenWarehouseState;
use Modules\Warehouse\Entities\WhDetailTransferBetweenWarehouse;

class CrudTransferBetweenWarehouseServiceTest extends TestCase
{
    public $json = [
        'wh_from_warehouse_id' => 1,
        'g_from_supervisor_id' => 2,
        'wh_to_warehouse_id' => 2,
        'description' => '',

        'details' => [
            [
                'wh_product_id' => 8,
                'quantity' => 5
            ],
            [
                'wh_product_id' => 6,
                'quantity' => 4
            ]
        ]
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
    private function storeTransfer() {
        return $this->json('POST', 'api/wh_transfer_between_warehouse', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateTransfer($id) {
        return $this->json('PUT', "api/wh_transfer_between_warehouse/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteTransfer($id) {
        return $this->json('DELETE', "api/wh_transfer_between_warehouse/$id");
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
     * Test should store transfer
     *
     * @return void
     */
    public function test_ShouldStoreTransfer()
    {
        $response = $this->storeTransfer();
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'transfer_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert wh_transfer_between_warehouse
        $this->assertDatabaseHas('wh_transfer_between_warehouse', [
            'id' => $obj->transfer_id,
            'wh_from_warehouse_id' => $this->tempJson['wh_from_warehouse_id'],
            'wh_to_warehouse_id' => $this->tempJson['wh_to_warehouse_id'],
            'g_from_supervisor_id' => $this->tempJson['g_from_supervisor_id'],
            'description' => $this->tempJson['description'],
            'wh_transfer_between_warehouse_state_id' => WhTransferBetweenWarehouseState::CREATED,
            'dispatch_date' => null,
            'reception_date' => null,
            'flag_delete' => false
        ]);

        foreach($this->tempJson['details'] as $detail)
        {
            $this->assertDatabaseHas('wh_detail_transfer_between_warehouse', [
                'wh_transfer_between_warehouse_id' => $obj->transfer_id,
                'wh_product_id' => $detail['wh_product_id'],
                'quantity' => $detail['quantity'],
                'flag_delete' => false
            ]);
        }

        return $obj->transfer_id;
    }

    /**
     * Test should throw exception if transfer doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTransferDoesntExists_WhenUpdate()
    {
        $response = $this->updateTransfer(-1);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response);
    }

    /**
     * Test should throw exception if transfer cant be modified
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTransferCantBeModified_WhenUpdate()
    {
        $response = $this->updateTransfer(1);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response);
    }

    /**
     * Test should update transfer
     *
     * @depends test_ShouldStoreTransfer
     * @return void
     */
    public function test_ShouldUpdateTransfer($id)
    {
        $response = $this->updateTransfer($id);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert wh_transfer_between_warehouse
        $this->assertDatabaseHas('wh_transfer_between_warehouse', [
            'id' => $id,
            'wh_from_warehouse_id' => $this->tempJson['wh_from_warehouse_id'],
            'wh_to_warehouse_id' => $this->tempJson['wh_to_warehouse_id'],
            'g_from_supervisor_id' => $this->tempJson['g_from_supervisor_id'],
            'description' => $this->tempJson['description'],
            'wh_transfer_between_warehouse_state_id' => WhTransferBetweenWarehouseState::CREATED,
            'dispatch_date' => null,
            'reception_date' => null,
            'flag_delete' => false
        ]);

        foreach($this->tempJson['details'] as $detail)
        {
            $this->assertDatabaseHas('wh_detail_transfer_between_warehouse', [
                'wh_transfer_between_warehouse_id' => $id,
                'wh_product_id' => $detail['wh_product_id'],
                'quantity' => $detail['quantity'],
                'flag_delete' => false
            ]);
        }
    }

    /**
     * Test should throw exception if transfer doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTransferDoesntExists_WhenDelete()
    {
        $response = $this->deleteTransfer(-1);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response);
    }

    /**
     * Test should throw exception if transfer cant be modified
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTransferCantBeModified_WhenDelete()
    {
        $response = $this->deleteTransfer(1);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response);
    }

    /**
     * Test should update transfer
     *
     * @depends test_ShouldStoreTransfer
     * @return void
     */
    public function test_ShouldDeleteTransfer($id)
    {
        $response = $this->deleteTransfer($id);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert wh_transfer_between_warehouse
        $this->assertDatabaseHas('wh_transfer_between_warehouse', [
            'id' => $id,
            'flag_delete' => true
        ]);

        $details = WhDetailTransferBetweenWarehouse::where('wh_transfer_between_warehouse_id', $id)->get()->toArray();
        foreach($details as $detail)
        {
            $this->assertDatabaseHas('wh_detail_transfer_between_warehouse', [
                'id' => $detail['id'],
                'flag_delete' => true
            ]);
        }
    }

}
