<?php

namespace Modules\Warehouse\Tests\Services;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Pos\Services\PosSalePos\GenerateSaleService;
use Modules\Warehouse\Entities\WhProductPos;
use Modules\Warehouse\Services\WhProductPos\ProductInventoryService;
use Modules\Warehouse\Services\WhProductPos\ProductStockService;


/**
 * Test Item Composition of:
 * - Item
 * - Pack
 * - Promo
 * - Packing
 * Test Database Warehouse Item Has:
 * - Warehouse 1 => Baltiloca[id=4]: 1000, Papas Kryspo[id=8]: 1000
 * - Warehouse 5 => Baltiloca[id=4]: 500, Papas Kryspo[id=8]: 1000
 * - Warehouse 10 => Baltiloca[id=4]: 300, Papas Kryspo[id=8]: 300
 * - Warehouse 15 => Baltiloca[id=4]: 200, Papas Kryspo[id=8]: 100
 * - Warehouse 20 => Baltiloca[id=4]: 20, Papas Kryspo[id=8]: 2
 */
class ProductStockServicePosTest extends TestCase
{

    /**
     * CONST PRODUCT ID.
     */
    public $itemProductId = 4;
    public $packProductId = 5;
    public $promoProductId = 6;
    public $packingProductId = 7;

    /**
     * Test should return stocks of item
     *
     * @return void
     */
    public function test_itemStock()
    {
        $product = WhProductPos::find( $this->itemProductId );
        $product->composition = $product->getCompositionAttribute();

        // dump($product);
        $productInventoryService = new ProductInventoryService();
        $productStockService = new ProductStockService($productInventoryService);

        $stocks = $productStockService->getStock($this->itemProductId);

        dump($stocks);
        // $this->assertEquals(count($stocks), 2);


        // $this->assertEquals(count($stocks[1]['wh_warehouses']), 2);
        // $this->assertEquals(count($stocks[0]['wh_warehouses']), 4);

        // foreach($stocks as $i => $stock) {
        //     $this->assertArrayHasKey('wh_warehouses', $stock);
        //     foreach($stock['wh_warehouses'] as $j => $warehouse) {
        //         $this->assertArrayHasKey('wh_warehouse_id', $warehouse);
        //         $this->assertArrayHasKey('wh_warehouse_name', $warehouse);
        //         $this->assertArrayHasKey('wh_items', $warehouse);
        //         $this->assertArrayHasKey('stock', $warehouse);
        //         foreach($warehouse['wh_items'] as $item) {
        //             $this->assertArrayHasKey('wh_item_id', $item);
        //             $this->assertArrayHasKey('wh_item_name', $item);
        //             $this->assertArrayHasKey('wh_item_stock', $item);
        //         }
        //     }
        // }

        // $this->assertEquals($stocks[0]['wh_warehouses'][0]['stock'], 166);
        // $this->assertEquals($stocks[0]['wh_warehouses'][1]['stock'], 83);
        // $this->assertEquals($stocks[0]['wh_warehouses'][2]['stock'], 33);
        // $this->assertEquals($stocks[0]['wh_warehouses'][3]['logical_stock'], 0);

        // $this->assertEquals($stocks[1]['wh_warehouses'][0]['stock'], 50);
        // $this->assertEquals($stocks[1]['wh_warehouses'][1]['stock'], 2);

    }
    /**
     * Test should return stocks of item
     *
     * @return void
     */
    public function test_promoStock()
    {
        // $product = WhProduct::find( $this->itemProductId );
        // $product->composition = $product->getCompositionAttribute();

        $productInventoryService = new ProductInventoryService();
        $productStockService = new ProductStockService($productInventoryService);

        $stocks = $productStockService->getStock($this->promoProductId);

        $this->assertEquals(count($stocks),$stocks);


        $this->assertEquals(count($stocks[1]['wh_warehouse_pos']), 2);
        $this->assertEquals(count($stocks[0]['wh_warehouse_pos']), 4);

        foreach($stocks as $i => $stock) {
            $this->assertArrayHasKey('wh_warehouse_pos', $stock);
            foreach($stock['wh_warehouse_pos'] as $j => $warehouse) {
                $this->assertArrayHasKey('wh_warehouse_id', $warehouse);
                $this->assertArrayHasKey('wh_warehouse_name', $warehouse);
                $this->assertArrayHasKey('wh_items', $warehouse);
                $this->assertArrayHasKey('logical_stock', $warehouse);
                foreach($warehouse['wh_items'] as $item) {
                    $this->assertArrayHasKey('wh_item_id', $item);
                    $this->assertArrayHasKey('wh_item_name', $item);
                    $this->assertArrayHasKey('wh_item_stock', $item);
                }
            }
        }

        $this->assertEquals($stocks[0]['wh_warehouse_pos'][0]['logical_stock'], 166);
        $this->assertEquals($stocks[0]['wh_warehouse_pos'][1]['logical_stock'], 83);
        $this->assertEquals($stocks[0]['wh_warehouse_pos'][2]['logical_stock'], 33);
        $this->assertEquals($stocks[0]['wh_warehouse_pos'][3]['logical_stock'], 0);

        $this->assertEquals($stocks[1]['wh_warehouse_pos'][0]['logical_stock'], 50);
        $this->assertEquals($stocks[1]['wh_warehouse_pos'][1]['logical_stock'], 2);

    }

}
