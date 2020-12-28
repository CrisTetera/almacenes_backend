<?php

namespace Modules\Warehouse\Tests\Unit\WhTransferBetweenWarehouse;

use Tests\TestCase;
use Modules\Warehouse\Entities\WhTransferBetweenWarehouseState;
use Modules\Warehouse\Entities\WhWarehouseMovement;

class DispatchReceptionTransferServiceTest extends TestCase
{
    public $json = [
        'wh_from_warehouse_id' => 1,
        'g_from_supervisor_id' => 2,
        'wh_to_warehouse_id' => 2,
        'description' => '',
        'details' => [
            ['wh_product_id' => 8, 'quantity' => 5], // Papitas Kryspo
            ['wh_product_id' => 4, 'quantity' => 3], // Baltiloca
            ['wh_product_id' => 6,'quantity' => 4]  // Promo Baltiloca + Papas Kryspo
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
     * Function to call a HTTP POST
     *
     * @return void
     */
    private function dispatchTransfer($id) {
        return $this->json('POST', "api/wh_transfer_between_warehouse/$id/dispatch", $this->tempJson);
    }

    /**
     * Function to call a HTTP POST
     *
     * @return void
     */
    private function receiveTransfer($id) {
        return $this->json('POST', "api/wh_transfer_between_warehouse/$id/receive", $this->tempJson);
    }

    /**
     * Function to assert an error
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
        // Tested on CrudTransferBetweenWarehouseServiceTest
        $response = $this->storeTransfer();
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $obj = json_decode( $response->content() );
        $this->assertTrue(true);
        return $obj->transfer_id;
    }

    // /**
    //  * Test should throw exception if transfer doesn't exists
    //  *
    //  * @return void
    //  */
    // public function test_ShouldThrowException_IfTransferDoesntExists_WhenDispatch()
    // {
    //     $response = $this->dispatchTransfer(-1);
    //     dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
    //     $this->assertError($response);
    // }

    /**
     * Test should throw exception if transfer cant be dispatched
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTransferCantBeModified_WhenDispatch()
    {
        $response = $this->dispatchTransfer(1);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response);
    }

    /**
     * Test should dispatch transfer
     *
     * @depends test_ShouldStoreTransfer
     * @return void
     */
    public function test_ShouldDispatchTransfer($id)
    {
        $response = $this->dispatchTransfer($id);
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
        // Assert wh_transfer_between_warehouse
        $this->assertDatabaseHas('wh_transfer_between_warehouse', [
            'id' => $id,
            'wh_transfer_between_warehouse_state_id' => WhTransferBetweenWarehouseState::DISPATCHED,
            'flag_delete' => false
        ]);
        // Solo se recibe la Promo de Baltilocas + Papas Kryspo (6 balti (ID: 4) + 1 papitas kryspo (ID: 8))
        // Como se transfieren 4, debiese haber un stock movement de 24 balti y 4 papitas kryspo
        $this->assertDatabaseHas('wh_stock_movement', [
            'wh_item_id' => 4,
            'wh_warehouse_id' => 1, // Desde
            'wh_warehouse_movement_id' => WhWarehouseMovement::TRANSFER_BETWEEN_WAREHOUSE,
            'wh_product_id' => 6,
            'quantity' => -24,
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('wh_stock_movement', [
            'wh_item_id' => 8,
            'wh_warehouse_id' => 1, // Desde
            'wh_warehouse_movement_id' => WhWarehouseMovement::TRANSFER_BETWEEN_WAREHOUSE,
            'wh_product_id' => 6,
            'quantity' => -4,
            'flag_delete' => false
        ]);
        // De la bodega debiese reducirse en 27 baltilocas y 9 papitas kryspo
        $this->assertDatabaseHas('wh_warehouse_item', [
            'wh_warehouse_id' => 1, // Desde
            'wh_item_id' => 4,
            'stock' => 973, // 1000 - 27
            'flag_delete' => false
            ]);
        $this->assertDatabaseHas('wh_warehouse_item', [
            'wh_warehouse_id' => 1, // Desde
            'wh_item_id' => 8,
            'stock' => 991, // 1000 - 9
            'flag_delete' => false
        ]);
    }

    /**
     * Test should throw exception if transfer doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTransferDoesntExists_WhenReceive()
    {
        $this->tempJson = [
            'description' => 'Nueva descripción',
            'details' => [
                [ 'wh_product_id' => 8, 'state' => -1], //No Recibido
                [ 'wh_product_id' => 4, 'state' => 0], //Pendiente
                [ 'wh_product_id' => 6, 'state' => 1], //Recibido
            ]
        ];
        $response = $this->receiveTransfer(-1);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response);
    }

    /**
     * Test should throw exception if transfer cant be received
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTransferCantBeModified_WhenReceive()
    {
        $this->tempJson = [
            'description' => 'Nueva descripción',
            'details' => [
                [ 'wh_product_id' => 8, 'state' => -1], //No Recibido
                [ 'wh_product_id' => 4, 'state' => 0], //Pendiente
                [ 'wh_product_id' => 6, 'state' => 1], //Recibido
            ]
        ];
        $response = $this->receiveTransfer(2);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response);
    }

    /**
     * Test should receive transfer
     *
     * @depends test_ShouldStoreTransfer
     * @return void
     */
    public function test_ShouldReceiveTransfer($id)
    {
        $this->tempJson = [
            'description' => 'Nueva descripción',
            'details' => [
                [ 'wh_product_id' => 8, 'state' => -1], //No Recibido
                [ 'wh_product_id' => 4, 'state' => 0], //Pendiente
                [ 'wh_product_id' => 6, 'state' => 1], //Recibido
            ]
        ];
        $response = $this->receiveTransfer($id);
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
        // Assert wh_transfer_between_warehouse
        $this->assertDatabaseHas('wh_transfer_between_warehouse', [
            'id' => $id,
            'wh_transfer_between_warehouse_state_id' => WhTransferBetweenWarehouseState::PARTIAL_RECEPTION,
            'flag_delete' => false
        ]);
        // Solo se recibe la Promo de Baltilocas + Papas Kryspo (6 balti (ID: 4) + 1 papitas kryspo (ID: 8))
        // Como se transfieren 4, debiese haber un stock movement de 24 balti y 4 papitas kryspo
        $this->assertDatabaseHas('wh_stock_movement', [
            'wh_item_id' => 4,
            'wh_warehouse_id' => 2,
            'wh_warehouse_movement_id' => WhWarehouseMovement::TRANSFER_BETWEEN_WAREHOUSE,
            'wh_product_id' => 6,
            'quantity' => 24,
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('wh_stock_movement', [
            'wh_item_id' => 8,
            'wh_warehouse_id' => 2,
            'wh_warehouse_movement_id' => WhWarehouseMovement::TRANSFER_BETWEEN_WAREHOUSE,
            'wh_product_id' => 6,
            'quantity' => 4,
            'flag_delete' => false
        ]);
        // De la bodega debiese sumarse 24 baltilocas y 4 papitas kryspo (Solo eso se acepta)
        $this->assertDatabaseHas('wh_warehouse_item', [
            'wh_warehouse_id' => 2,
            'wh_item_id' => 4,
            'stock' => 24, // no hay baltis en la bodega 2, por lo que se crean 24
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('wh_warehouse_item', [
            'wh_warehouse_id' => 2,
            'wh_item_id' => 8,
            'stock' => 4, // no hay kryspo en la bodega 2, por lo que se crean 4
            'flag_delete' => false
        ]);
    }

}
