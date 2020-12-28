<?php

namespace Modules\Warehouse\Tests\Services;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Pos\Services\PosSale\GenerateSaleService;
use Modules\Warehouse\Entities\WhProduct;
use Modules\Warehouse\Services\WhProduct\ProductInventoryService;

/**
 * Test Item Composition of:
 * - Item
 * - Pack
 * - Promo
 * - Packing
 * Test Database has:
 * - Item => Baltiloca, Product Id: 4
 * - Pack => Pack Baltiloca, Product Id: 5
 * - Promo => Promo Baltiloca + Papas Kryspo, Product Id: 6 (Contains Products Id: 5 and 8)
 * - Packing => Packing de Baltilocas + Papas Kryspo, Product Id: 7 (quantity: 20)
 * - Promo => Hyper Promo Baltiloca + Papas Kryspo, Product Id: 400 (Contains Products Id: 5 and 8)
 */
class ProductInventoryServiceTest extends TestCase
{

    /**
     * CONST PRODUCT ID.
     */
    public $itemProductId = 4;
    public $packProductId = 5;
    public $promoProductId = 6;
    public $packingProductId = 7;
    public $hyperPromoProductId = 400;

    /**
     * Test should return grouped item of products [4, 5, 6 and 7]
     *
     * Results should be:
     * [
     *      { item_id: 4, item_quantity: 133, item_name: 'Baltiloca' },
     *      { item_id: 8, item_quantity: 21, item_name: 'Papitas Kryspo' }
     * ]
     *
     * @return void
     */
    public function test_groupItem()
    {
        $productInventoryService = new ProductInventoryService();
        $products = [
            ['id' => 4, 'quantity' => 2],
            ['id' => 5, 'quantity' => 3],
            ['id' => 6, 'quantity' => 4],
            ['id' => 7, 'quantity' => 5],
        ];
        $groupedItems = $productInventoryService->getGroupedItems($products);
        $this->assertEquals(count($groupedItems), 2);

        $this->assertEquals($groupedItems[0]['item_id'], 4);
        $this->assertEquals($groupedItems[0]['item_name'], 'Baltiloca');
        $this->assertEquals($groupedItems[0]['item_quantity'], 344);

        $this->assertEquals($groupedItems[1]['item_id'], 8);
        $this->assertEquals($groupedItems[1]['item_name'], 'Papitas Kryspo');
        $this->assertEquals($groupedItems[1]['item_quantity'], 54);
    }

    /**
     * Test should return grouped item for hyper promo (ID: 400)
     *
     * Results should be:
     * [
     *      { item_id: 4, item_quantity: 30, item_name: 'Baltiloca' },
     *      { item_id: 8, item_quantity: 8, item_name: 'Papitas Kryspo' }
     * ]
     *
     * @return void
     */
    public function test_groupItemHyperPromo()
    {
        $productInventoryService = new ProductInventoryService();
        $products = [
            ['id' => $this->hyperPromoProductId, 'quantity' => 1],
        ];
        $groupedItems = $productInventoryService->getGroupedItems($products);

        $this->assertEquals(count($groupedItems), 2);

        $this->assertEquals($groupedItems[0]['item_id'], 4);
        $this->assertEquals($groupedItems[0]['item_name'], 'Baltiloca');
        $this->assertEquals($groupedItems[0]['item_quantity'], 30);

        $this->assertEquals($groupedItems[1]['item_id'], 8);
        $this->assertEquals($groupedItems[1]['item_name'], 'Papitas Kryspo');
        $this->assertEquals($groupedItems[1]['item_quantity'], 8);
    }

}
