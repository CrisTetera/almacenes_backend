<?php

namespace Modules\Warehouse\Tests\Unit\WhPackPos;

use Tests\TestCase;
use Modules\Sale\Entities\SlPriceListPos;
use Modules\Warehouse\Entities\WhPackPos;
use Modules\General\Entities\GUserPos;
use Modules\Warehouse\Entities\WhProductPos;

class CrudWhPackPosTest extends TestCase
{
    public $json = [
        // Product Data
        'name' => 'Pack prueba',
        'description' => 'Descripcion de Prueba',
        'wh_subfamily_id' => 1,
        'is_tax_free' => false,
        // Extra Product Data
        'tags' => [1, 2, 3],
        'cost_price' => 600,
        'sale_price' => 1000,
        'gains_margin' => 20,
            
        'upc' => '12345678',
        // Pack Data
        'wh_item_id' => 1,
        'item_quantity' => 3
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
    private function storePack() {
        return $this->json('POST', 'api/wh_pack_pos', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updatePack($id) {
        return $this->json('PUT', "api/wh_pack_pos/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deletePack($id) {
        return $this->json('DELETE', "api/wh_product_pos/$id");
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
     * Test should throw exception if no data is sended
     *
     * @return void
     */
    public function test_ShouldThrowException_IfNoParamIssended()
    {
        $this->tempJson = [];
        $response = $this->storePack();
        $this->assertError($response, 422);
    }

    /**
     * Test should store pack
     *
     * @return void
     */
    public function test_ShouldStorePack()
    {
        WhProductPos::where('upc','12345678')->update(
            [   
                'flag_delete'=> true
            ]
        );
        $response = $this->storePack();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'wh_product_id',
                     'wh_pack_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Wh Product
        $this->assertDatabaseHas('wh_product_pos', [
            'id' => $obj->wh_product_id,
            'wh_item_id' => null,
            'wh_pack_id' => $obj->wh_pack_id,
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
        // Assert Wh Pack
        $this->assertDatabaseHas('wh_pack_pos', [
            'id' => $obj->wh_pack_id,
            'wh_product_id' => $obj->wh_product_id,
            'wh_item_id' => $this->tempJson['wh_item_id'],
            'item_quantity' => $this->tempJson['item_quantity'],
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
        $listPrice = SlPriceListPos::where('wh_product_id', $obj->wh_product_id)->where('flag_delete', 0)->first();
        $this->assertDatabaseHas('sl_price_list_pos', [
            'wh_product_id' => $obj->wh_product_id,
            'sale_price' => $this->tempJson['sale_price'],
            'flag_delete' => false
        ]);
        return $obj->wh_product_id;
    }

    /**
     * Test should throw exception if product doesnt exists in database when updating
     *
     * @depends test_ShouldStorePack
     * @return void
     */
    public function test_ShouldThrowException_IfProductDoesntExists_WhenUpdate($id)
    {
        $response = $this->updatePack(999999);
        $this->assertError($response);
    }

    /**
     * Test should throw exception if product to update is not a pack
     *
     * @depends test_ShouldStorePack
     * @return void
     */
    public function test_ShouldThrowException_IfProductIsNotAPack_WhenUpdate($id)
    {
        $response = $this->updatePack(1); // 1: es un ítem, Bebida
        $this->assertError($response);
    }

    /**
     * Test should update product
     *
     * @depends test_ShouldStorePack
     * @return void
     */
    public function test_ShouldUpdateProduct($id)
    {
        $this->tempJson['name'] = 'Meruem';
        $this->tempJson['tags'] = [5, 6, 7];
        $this->tempJson['cost_price'] = 700;
        $this->tempJson['sale_price'] = 1100;
        $this->tempJson['gains_margin'] = 25;
               
        $this->tempJson['upc'] = '23456789';

        $response = $this->updatePack($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'wh_product_id',
                     'wh_pack_id'
                 ]);
        $obj = json_decode( $response->content() );
        // Assert Wh Product
        $this->assertDatabaseHas('wh_product_pos', [
            'id' => $obj->wh_product_id,
            'wh_item_id' => null,
            'wh_pack_id' => $obj->wh_pack_id,
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
        // Assert Wh Pack
        $this->assertDatabaseHas('wh_pack_pos', [
            'id' => $obj->wh_pack_id,
            'wh_product_id' => $obj->wh_product_id,
            'wh_item_id' => $this->tempJson['wh_item_id'],
            'item_quantity' => $this->tempJson['item_quantity'],
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
        // Assert product price list
        $listPrice = SlPriceListPos::where('wh_product_id', $obj->wh_product_id)->where('flag_delete', 0)->first();
        $this->assertDatabaseHas('sl_price_list_pos', [
            'wh_product_id' => $obj->wh_product_id,
            'sale_price' => $this->tempJson['sale_price'],
            'flag_delete' => false
        ]);

    }

    /**
     * Test should delete logically pack
     *
     * @depends test_ShouldStorePack
     * @return void
     */
    public function test_ShouldDeletePack($id)
    {
        $response = $this->deletePack($id);
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
        $pack = WhPackPos::where('wh_product_id', $id)->first();
        // Assert Wh Pack
        $this->assertDatabaseHas('wh_pack_pos', [
            'id' => $pack->id,
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
