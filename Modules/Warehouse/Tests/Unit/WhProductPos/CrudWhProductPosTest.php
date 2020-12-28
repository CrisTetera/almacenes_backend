<?php

namespace Modules\Warehouse\Tests\Unit\WhProductPos;

use Tests\TestCase;
use Modules\Warehouse\Entities\WhItemPos;
use Modules\Sale\Entities\SlPriceListPos;
use Modules\Warehouse\Entities\WhProductPos;
use Modules\General\Entities\GUserPos;
use App\Helpers\CustomTestCase;

class CrudWhProductPosTest extends CustomTestCase
{

    public $json = [
        // Product Data
        'name' => 'Product prueba',
        'description' => 'Alias Prueba',
        'wh_subfamily_id' => 1,
        'is_tax_free' => true,
        'have_decimal_quantity' => false,
        'upc' => '98711114',
        'cost_price' => 600,
        'gains_margin' => 20,
        // Extra Product Data
        'tags' => [1, 2, 3],
        'sale_price' => 800,
        'stock' => 100
    ];

    public $tempJson;

    /**
     * Constant ID User to login
     */
    private const ID_USER = 1;    

    /**
     * Reset tempJson after each test
     *
     * @return void
     */
    protected function setUp() : void {
        parent::setUp();
        $this->tempJson = $this->json;

        $user = GUserPos::find(self::ID_USER);
        $this->actingAs($user, 'api');
    }

    /**
     * Function to call a HTTP POST
     *
     * @return void
     */
    private function storeProduct() {
        return $this->json('POST', 'api/wh_product_pos', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateProduct($id) {
        return $this->json('PUT', "api/wh_product_pos/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteProduct($id) {
        return $this->json('DELETE', "api/wh_product_pos/$id");
    }

    /** 
     * Test should throw exception if no data is sended
     *
     * @return void
     */
    public function test_ShouldThrowException_IfNoParamIssended()
    {
        $this->tempJson = [];
        $response = $this->storeProduct();
        $this->assertError($response, 422);
    }

    /** 
     * Test should store item
     *
     * @return void
     */
    public function test_ShouldStoreProduct()
    {
        WhProductPos::where('upc','98711114')->update(
            [
                'flag_delete'=> true
            ]
        );
        $response = $this->storeProduct();
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        // $this->dump($response);
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'wh_product_id',
                     'wh_item_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Wh Product
        $this->assertDatabaseHas('wh_product_pos', [
            'id' => $obj->wh_product_id,
            'wh_subfamily_id' => $this->tempJson['wh_subfamily_id'],
            'name' => $this->tempJson['name'],
            'description' => $this->tempJson['description'],
            'path_logo' => '',
            'upc' => $this->tempJson['upc'],
            'cost_price' => $this->tempJson['cost_price'],
            'gains_margin' => $this->tempJson['gains_margin'],
            'is_tax_free' => $this->tempJson['is_tax_free'],
            'flag_delete' => false,
        ]);
        // Assert Wh Item
        $this->assertDatabaseHas('wh_item_pos', [
            'id' => $obj->wh_item_id,
            'wh_product_id' => $obj->wh_product_id,
            'have_decimal_quantity' => $this->tempJson['have_decimal_quantity'],
            'flag_delete' => false,
        ]);
        // Assert Wh Item stock
        $this->assertDatabaseHas('wh_item_stock_pos', [
            'wh_item_id' => $obj->wh_item_id,
            'wh_warehouse_id'=> 1,
            'stock' => $this->tempJson['stock'],
            'flag_delete' => false,
        ]);
        // Assert Wh Tags
        foreach( $this->tempJson['tags'] as $tag )
        {
            $this->assertDatabaseHas('wh_tag_wh_product_pos', [
                'wh_product_id' => $obj->wh_product_id,
                'wh_tag_id' => $tag
            ]);
        }
        // Assert product sale price in price list    
        $listPrice = SlPriceListPos::where('wh_product_id', $obj->wh_product_id)->where('flag_delete', 0)->first();
        $this->assertDatabaseHas('sl_price_list_pos', [
            'wh_product_id' => $obj->wh_product_id,
            'sale_price' => $this->tempJson['sale_price'],
            'flag_delete' => false
        ]);
        
        return $obj->wh_product_id;
    }


    /** 
     * Test should throw exception if tag doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTagDoesntExists()
    {
        $this->tempJson['tags'] = [1, 2, -1];
        $response = $this->storeProduct();
        $this->assertError($response, 422);
    }

    /**
     * Test should throw exception if product doesnt exists in database when updating
     *
     * @depends test_ShouldStoreProduct
     * @return void
     */
    public function test_ShouldThrowException_IfProductDoesntExists_WhenUpdate($id)
    {
        $response = $this->updateProduct(-1);
        $this->assertError($response);
    }

    /** 
     * Test should throw exception if product to update is not an item
     *
     * @depends test_ShouldStoreProduct
     * @return void
     */
    public function test_ShouldThrowException_IfProductIsNotAItem_WhenUpdate($id)
    {
        $response = $this->updateProduct(5); // 5: Pack de Baltilocas
        $this->assertError($response);
    }

    /** 
     * Test should update product
     *
     * @depends test_ShouldStoreProduct
     * @return void
     */
    public function test_ShouldUpdateProduct($id)
    {
        $this->tempJson['name'] = 'Meruem';
        $this->tempJson['tags'] = [5, 6, 7];
        $this->tempJson['upc'] = '23456789';
        $this->tempJson['cost_price'] = 700;
        $this->tempJson['sale_price'] = 1100;
        $this->tempJson['gains_margin'] = 25;
            
        $response = $this->updateProduct($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'wh_product_id',
                     'wh_item_id'
                 ]);
        $obj = json_decode( $response->content() );
        // Assert Wh Product
        $this->assertDatabaseHas('wh_product_pos', [
            'id' => $obj->wh_product_id,
            'wh_item_id' => $obj->wh_item_id,
            'wh_pack_id' => null,
            'wh_promo_id' => null,
            'wh_subfamily_id' => $this->tempJson['wh_subfamily_id'],
            'name' => $this->tempJson['name'],
            'description' => $this->tempJson['description'],
            'path_logo' => '',
            'is_tax_free' => $this->tempJson['is_tax_free'],
            'upc' => $this->tempJson['upc'],
            'cost_price' => $this->tempJson['cost_price'],
            'gains_margin' => $this->tempJson['gains_margin'],
            'flag_delete' => false,
        ]);
        // Assert Wh Item
        $this->assertDatabaseHas('wh_item_pos', [
            'id' => $obj->wh_item_id,
            'wh_product_id' => $obj->wh_product_id,
            'have_decimal_quantity' => $this->tempJson['have_decimal_quantity'],
            'flag_delete' => false,
        ]);
        // Assert Wh Tags
        foreach( $this->tempJson['tags'] as $tag )
        {
            $this->assertDatabaseHas('wh_tag_wh_product_pos', [
                'wh_product_id' => $obj->wh_product_id,
                'wh_tag_id' => $tag
            ]);
        }
        $this->assertDatabaseHas('sl_price_list_pos', [
            'wh_product_id' => $obj->wh_product_id,
            'sale_price' => $this->tempJson['sale_price'],
            'flag_delete' => false
        ]);
        

    }

    /** 
     * Test should throw exception if product doesn´t exists in database when deleting
     *
     * @depends test_ShouldStoreProduct
     * @return void
     */
    public function test_ShouldThrowException_IfProductDoesntExists_WhenDelete($id)
    {
        $response = $this->deleteProduct(-1);
        $this->assertError($response);
    }

    /**
     * Test should delete logically product
     *
     * @depends test_ShouldStoreProduct
     * @return void
     */
    public function test_ShouldDeleteProduct($id)
    {
        $response = $this->deleteProduct($id);
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
        // Assert Wh Product
        $this->assertDatabaseHas('wh_product_pos', [
            'id' => $id,
            'flag_delete' => true
        ]);
        $item = WhItemPos::where('wh_product_id', $id)->first();
        // Assert Wh Item
        $this->assertDatabaseHas('wh_item_pos', [
            'id' => $item->id,
            'flag_delete' => true
        ]);
        // Asser Sl Detail List Price
        $slDetailListPriceIds = SlPriceListPos::where('wh_product_id', $id)->get()->pluck('id');
        foreach($slDetailListPriceIds as $slDetailListPriceId)
        {
            $this->assertDatabaseHas('sl_price_list_pos', [
                'id' => $slDetailListPriceId,
                'flag_delete' => true
            ]);
        }
    }
}
