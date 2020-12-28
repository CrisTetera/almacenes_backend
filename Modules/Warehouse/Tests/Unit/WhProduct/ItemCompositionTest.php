<?php

namespace Modules\Warehouse\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Pos\Services\PosSale\GenerateSaleService;
use Modules\Warehouse\Entities\WhProduct;

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
 */
class ItemCompositionTest extends TestCase
{

    /**
     * CONST PRODUCT ID.
     */
    public $itemProductId = 4;
    public $packProductId = 5;
    public $promoProductId = 6;
    public $packingProductId = 7;

    /**
     * Test item composition of a item product
     *
     * @return void
     */
    public function test_item_composition()
    {
        $product = WhProduct::find( $this->itemProductId );
        $product->composition = $product->getCompositionAttribute();

        $this->assertArrayHasKey('type', $product->composition);
        $this->assertArrayHasKey('item_id', $product->composition);
        $this->assertArrayHasKey('item_product_id', $product->composition);
        $this->assertArrayHasKey('quantity', $product->composition);
        $this->assertArrayHasKey('item_name', $product->composition);

        $this->assertEquals($product->composition['type'], 'item');
        $this->assertEquals($product->composition['item_product_id'], $this->itemProductId);
        $this->assertEquals($product->composition['quantity'], 1);
    }

    /**
     * Test item composition of a pack product
     *
     * @return void
     */
    public function test_pack_composition()
    {
        $product = WhProduct::find( $this->packProductId );
        $product->composition = $product->getCompositionAttribute();

        $this->assertArrayHasKey('type', $product->composition);
        $this->assertArrayHasKey('pack_id', $product->composition);
        $this->assertArrayHasKey('pack_product_id', $product->composition);
        $this->assertArrayHasKey('item_id', $product->composition);
        $this->assertArrayHasKey('quantity', $product->composition);
        $this->assertArrayHasKey('item_name', $product->composition);

        $this->assertEquals($product->composition['type'], 'pack');
        $this->assertEquals($product->composition['pack_product_id'], $this->packProductId);
        $this->assertEquals($product->composition['item_id'], $this->itemProductId);
        $this->assertEquals($product->composition['quantity'], 6);
    }

    /**
     * Test item composition of a promo product
     * Promo has a pack of baltilocas and papitas kryspo item
     *
     * @return void
     */
    public function test_promo_composition()
    {
        $product = WhProduct::find( $this->promoProductId );
        $product->composition = $product->getCompositionAttribute();

        $this->assertArrayHasKey('type', $product->composition);
        $this->assertArrayHasKey('promo_id', $product->composition);
        $this->assertArrayHasKey('composition', $product->composition);

        $this->assertEquals($product->composition['type'], 'promo');

        $this->assertEquals($product->composition['composition'][0]['type'], 'pack');
        $this->assertEquals($product->composition['composition'][0]['pack_product_id'], $this->packProductId);
        $this->assertEquals($product->composition['composition'][0]['quantity'], 6);

        $this->assertEquals($product->composition['composition'][1]['type'], 'item');
        $this->assertEquals($product->composition['composition'][1]['item_product_id'], 8);
        $this->assertEquals($product->composition['composition'][1]['quantity'], 1);
    }

    /**
     * Test item composition of a packing product
     * Packing has 20 Promo's of pack of baltilocas and papitas kryspo item
     *
     * @return void
     */
    public function test_packing_composition()
    {
        $product = WhProduct::find( $this->packingProductId );
        $product->composition = $product->getCompositionAttribute();

        $this->assertArrayHasKey('type', $product->composition);
        $this->assertArrayHasKey('packing_id', $product->composition);
        $this->assertArrayHasKey('packing_product_id', $product->composition);
        $this->assertArrayHasKey('quantity', $product->composition);
        $this->assertArrayHasKey('composition', $product->composition);

        $this->assertEquals($product->composition['type'], 'packing');
        $this->assertEquals($product->composition['packing_product_id'], $this->packingProductId);
        $this->assertEquals($product->composition['quantity'], 20);
        $this->assertEquals($product->composition['packing_product_content_id'], $this->promoProductId);

        $this->assertArrayHasKey('composition', $product->composition['composition']);
        $this->assertArrayHasKey('type', $product->composition['composition']);
        $this->assertEquals($product->composition['composition']['type'], 'promo');

        $this->assertEquals($product->composition['composition']['composition'][0]['type'], 'pack');
        $this->assertEquals($product->composition['composition']['composition'][0]['quantity'], 6);
        $this->assertEquals($product->composition['composition']['composition'][0]['pack_product_id'], $this->packProductId);

        $this->assertEquals($product->composition['composition']['composition'][1]['type'], 'item');
        $this->assertEquals($product->composition['composition']['composition'][1]['quantity'], 1);
        $this->assertEquals($product->composition['composition']['composition'][1]['item_product_id'], 8);
    }
    
}
