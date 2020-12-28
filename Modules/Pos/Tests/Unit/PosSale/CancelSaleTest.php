<?php

namespace Modules\Pos\Tests\Unit\PosSale;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Pos\Entities\PosSale;
use Modules\Pos\Entities\PosSaleStockReservation;
use Modules\Warehouse\Entities\WhWarehouseItem;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;

/**
 * This test check if a sale can be cancelled
 *
 * In "PosSaleTableSeeder" exists three use case:
 * sale:
 *  id: 6 => OK
 *  id: 7 => state: Anulada, so you can't cancel it
 *  id: 8 => state: Realizada, so you can't cancel it
 *  id: 9 => flag_delete: true, so you can't cancel it
 */
class CancelSaleTest extends TestCase
{
    public $cancelableSaleId = 6;
    public $cancelledSaleId = 7;
    public $finishedSaleId = 8;
    public $deletedSaleId = 9;

    // JSON EXAMPLE.
    public $saleId = 0;

    /**
     * Function to call a HTTP POST Request to cancel a sale
     *
     * @return void
     */
    private function cancelSale() {
        return $this->deleteJson('api/pos_sale/'.$this->saleId);
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
     * Should be Ok if sale can be cancelled
     *
     * @return void
     */
    public function test_cancelTest()
    {
        // Retrieve old stock data
        $reservations = PosSaleStockReservation::where('pos_sale_id', $this->cancelableSaleId)->get();
        $warehouseItems = [];
        foreach( $reservations as $res ) {
            array_push( $warehouseItems, WhWarehouseItem::where('wh_warehouse_id', $res['wh_warehouse_id'])->where('wh_item_id', $res['wh_item_id'])->first() );
        }

        // Make Request
        $this->saleId = $this->cancelableSaleId;
        $response = $this->cancelSale();
        $response->assertStatus(200);

        // Assert sale is cancelled
        $this->assertDatabaseHas('pos_sale',[
            'id' => $this->cancelableSaleId,
            'g_state_id' => SaleConstant::SALE_STATE_ANULADA
        ]);


        // Assert item stock is reestablished
        foreach($reservations as $i => $res) {
            $this->assertDatabaseHas('wh_warehouse_item', [
                'wh_warehouse_id' => $res['wh_warehouse_id'],
                'wh_item_id' => $res['wh_item_id'],
                'stock' => ((int) $warehouseItems[$i]['stock']) + (int) $res['stock']
            ]);
        }
    }

    /**
     * Should throw exception if sale doesn't exists
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleDoesntExists() {
        $this->saleId = -1;
        $response = $this->cancelSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if sale is already cancelled
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleIsAlreadyCancelled() {
        $this->saleId = $this->cancelledSaleId;
        $response = $this->cancelSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if sale is already paid
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleIsAlreadyPaid() {
        $this->saleId = $this->finishedSaleId;
        $response = $this->cancelSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if sale is deleted
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleIsDeleted() {
        $this->saleId = $this->deletedSaleId;
        $response = $this->cancelSale();
        $this->assertError($response);
    }

}
