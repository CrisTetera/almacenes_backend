<?php

namespace Modules\Warehouse\Tests\Unit\WhPromoPos;

use Tests\TestCase;
use Modules\General\Entities\GBranchOffice;
use Modules\Sale\Entities\SlPriceListPos;
use Modules\Warehouse\Entities\WhPromoPos;
use Modules\Sale\Entities\SlDetailListPrice;
use Modules\General\Entities\GUserPos;
use Modules\Warehouse\Entities\WhProductPos;

class CrudWhPromoPosTest extends TestCase
{

    public $json = [
        // Product Data
        'name' => 'Promo prueba',
        'description' => 'Alias Prueba',
        'wh_subfamily_id' => 1,
        'is_tax_free' => false,
        'comp' => 2,
        // 'have_decimal_quantity' => false,
        // Extra Product Data
        'tags' => [1, 2, 3],
        'cost_price' => 600,
        'gains_margin' => 20,
        'sale_price' => 1000,
        'upc' => '12345678',
        // Promo Data
        'products' => [
            [ 'wh_product_id' => 4, 'quantity' => 10 ],
            [ 'wh_product_id' => 8, 'quantity' => 2 ],
            [ 'wh_product_id' => 2, 'quantity' => 1 ],
            [ 'wh_product_id' => 1, 'quantity' => 5 ],
            [ 'wh_product_id' => 5, 'quantity' => 3 ],
        ]
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
    private function storePromo() {
        return $this->json('POST', 'api/wh_promo_pos', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updatePromo($id) {
        return $this->json('PUT', "api/wh_promo_pos/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deletePromo($id) {
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
        $response = $this->storePromo();
        $this->assertError($response, 422);
    }

    /**
     * Test should store item
     *
     * @return void
     */
    public function test_ShouldStorePromo()
    {   WhProductPos::where('upc','12345678')->update(
            [   
                'flag_delete'=> true
            ]
        );
        $response = $this->storePromo();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'wh_product_id',
                     'wh_promo_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Wh Product
        $this->assertDatabaseHas('wh_product_pos', [
            'id' => $obj->wh_product_id,
            'wh_item_id' => null,
            'wh_pack_id' => null,
            'wh_promo_id' => $obj->wh_promo_id,
            'wh_subfamily_id' => $this->tempJson['wh_subfamily_id'],
            'upc' => $this->tempJson['upc'],
            'name' => $this->tempJson['name'],
            'description' => $this->tempJson['description'],
            'path_logo' => '',
            'cost_price' => $this->tempJson['cost_price'],
            'gains_margin' => $this->tempJson['gains_margin'],
            'is_tax_free' => $this->tempJson['is_tax_free'],
            'flag_delete' => false,
        ]);
        // Assert Wh Promo
        $this->assertDatabaseHas('wh_promo_pos', [
            'id' => $obj->wh_promo_id,
            'wh_product_id' => $obj->wh_product_id,
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
        // Assert product data per branch office
        // foreach($this->tempJson['branch_office_data'] as $data)
        // {
        //     $this->assertDatabaseHas('wh_product_g_branch_office', [
        //         'wh_product_id' => $obj->wh_product_id,
        //         'g_branch_office_id' => $data['g_branch_office_id'],
        //         'cost_price' => $data['cost_price'],
        //         'gains_margin' => $data['gains_margin'],
        //         'minimum_stock' => $data['minimum_stock'],
        //         'maximum_stock' => $data['maximum_stock'],
        //         'critical_stock' => $data['critical_stock']
        //     ]);
        //     $listPrice = SlListPrice::where('g_branch_office_id',$data['g_branch_office_id'])->where('is_active',1)->where('flag_delete', 0)->first();
        //     $this->assertDatabaseHas('sl_detail_list_price', [
        //         'sl_list_price_id' => $listPrice->id,
        //         'wh_product_id' => $obj->product_id,
        //         'sale_price' => $data['sale_price'],
        //         'flag_delete' => false
        //     ]);
        // }
        $listPrice = SlPriceListPos::where('wh_product_id', $obj->wh_product_id)->where('flag_delete', 0)->first();
        $this->assertDatabaseHas('sl_price_list_pos', [
            'wh_product_id' => $obj->wh_product_id,
            'sale_price' => $this->tempJson['sale_price'],
            'flag_delete' => false
        ]);
        // Assert Wh Promo Wh Product Promo
        foreach($this->tempJson['products'] as $product) {
            $this->assertDatabaseHas('wh_products_on_promo_pos', [
                'wh_product_id' => $product['wh_product_id'],
                'wh_promo_id' => $obj->wh_promo_id,
                'quantity' => $product['quantity']
            ]);
        }

        return $obj->wh_product_id;
    }

    /**
     * Test should throw exception if product doesn't exist
     *
     * @return void
     */
    public function test_ShouldThrowException_IfProductDoesntExists()
    {
        $this->tempJson['products'][1]['wh_product_id'] = 9999999;
        $response = $this->storePromo();
        $this->assertError($response, 500);
    }

    /**
     * Test should throw exception if product is not item or pack
     *
     * @return void
     */
    public function test_ShouldThrowException_IfProductIsNotItemOrPack()
    {
        $this->tempJson['products'][1]['wh_product_id'] = 7; // 7: Packing
        $response = $this->storePromo();
        $this->assertError($response, 500);
    }

    /**
     * Test should throw exception if product doesnt exists in database when updating
     *
     * @depends test_ShouldStorePromo
     * @return void
     */
    public function test_ShouldThrowException_IfProductDoesntExists_WhenUpdate($id)
    {
        $response = $this->updatePromo(-1);
        $this->assertError($response);
    }

    /**
     * Test should throw exception if product to update is not a promo
     *
     * @depends test_ShouldStorePromo
     * @return void
     */
    public function test_ShouldThrowException_IfProductIsNotAPromo_WhenUpdate($id)
    {
        $response = $this->updatePromo(1); // 1: es un ítem, Bebida
        $this->assertError($response);
    }

    /**
     * Test should update product
     *
     * @depends test_ShouldStorePromo
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
        $this->tempJson['products'] = [
            [ 'wh_product_id' => 2, 'quantity' => 8 ]
        ];
        $response = $this->updatePromo($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'wh_product_id',
                     'wh_promo_id',
                 ]);
        $obj = json_decode( $response->content() );
        // Assert Wh Product
        $this->assertDatabaseHas('wh_product_pos', [
            'id' => $obj->wh_product_id,
            'wh_item_id' => null,
            'wh_pack_id' => null,
            'wh_promo_id' => $obj->wh_promo_id,
            'wh_subfamily_id' => $this->tempJson['wh_subfamily_id'],
            'upc' => $this->tempJson['upc'],
            'name' => $this->tempJson['name'],
            'description' => $this->tempJson['description'],
            'path_logo' => '',
            'cost_price' => $this->tempJson['cost_price'],
            'gains_margin' => $this->tempJson['gains_margin'],
            'is_tax_free' => $this->tempJson['is_tax_free'],
            'flag_delete' => false,
        ]);
        // Assert Wh Promo
        $this->assertDatabaseHas('wh_promo_pos', [
            'id' => $obj->wh_promo_id,
            'wh_product_id' => $obj->wh_product_id,
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
        // Assert Wh Promo Wh Product Promo
        foreach($this->tempJson['products'] as $product) {
            $this->assertDatabaseHas('wh_products_on_promo_pos', [
                'wh_product_id' => $product['wh_product_id'],
                'wh_promo_id' => $obj->wh_promo_id,
                'quantity' => $product['quantity']
            ]);
        }

    }

    /**
     * Test should delete logically promo
     *
     * @depends test_ShouldStorePromo
     * @return void
     */
    public function test_ShouldDeletePromo($id)
    {
        $response = $this->deletePromo($id);
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
        $promo = WhPromoPos::where('wh_product_id', $id)->first();
        // Assert Wh Promo
        $this->assertDatabaseHas('wh_promo_pos', [
            'id' => $promo->id,
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
