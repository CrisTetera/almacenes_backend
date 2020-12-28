<?php

namespace Modules\Warehouse\Tests\Unit\WhPack;

use Tests\TestCase;
use Modules\Sale\Entities\SlListPrice;
use Modules\Warehouse\Entities\WhPack;
use Modules\Sale\Entities\SlDetailListPrice;

class CrudWhPackTest extends TestCase
{
    public $json = [
        // Product Data
        'name' => 'Pack prueba',
        'alias_name' => 'Alias Prueba',
        'description' => '',
        'internal_code' => 'pack1',
        'wh_subfamily_id' => 1,
        'warranty_days' => 0,
        'is_repackaged' => false,
        'is_tax_free' => false,
        'is_salable'=> true,
        'is_consumable' => false,
        'is_seasonal' => false,
        // Extra Product Data
        'tags' => [1, 2, 3],
        'branch_office_data' => [
            [
                'g_branch_office_id' => 1,
                'cost_price' => 600,
                'sale_price' => 1000,
                'gains_margin' => 20,
                'minimum_stock' => 10,
                'maximum_stock' => 30,
                'critical_stock' => 20,
            ],
            [
                'g_branch_office_id' => 2,
                'cost_price' => 800,
                'sale_price' => 1200,
                'gains_margin' => 30,
                'minimum_stock' => 20,
                'maximum_stock' => 40,
                'critical_stock' => 50,
            ]
        ],
        'upc_codes' => ['12345678', '98765432'],
        // Pack Data
        'wh_item_id' => 1,
        'item_quantity' => 3
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
    private function storePack() {
        return $this->json('POST', 'api/wh_pack', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updatePack($id) {
        return $this->json('PUT', "api/wh_pack/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deletePack($id) {
        return $this->json('DELETE', "api/wh_product/$id");
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
        $response = $this->storePack();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'product_id',
                     'pack_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Wh Product
        $this->assertDatabaseHas('wh_product', [
            'id' => $obj->product_id,
            'wh_item_id' => null,
            'wh_pack_id' => $obj->pack_id,
            'wh_packing_id' => null,
            'wh_promo_id' => null,
            'wh_subfamily_id' => $this->tempJson['wh_subfamily_id'],
            'internal_code' => $this->tempJson['internal_code'],
            'name' => $this->tempJson['name'],
            'alias_name' => $this->tempJson['alias_name'],
            'description' => $this->tempJson['description'],
            'path_logo' => '',
            'warranty_days' => $this->tempJson['warranty_days'],
            'is_repackaged' => $this->tempJson['is_repackaged'],
            'is_tax_free' => $this->tempJson['is_tax_free'],
            'is_salable' => $this->tempJson['is_salable'],
            'is_consumable' => $this->tempJson['is_consumable'],
            'is_seasonal' => $this->tempJson['is_seasonal'],
            'flag_delete' => false,
        ]);
        // Assert Wh Pack
        $this->assertDatabaseHas('wh_pack', [
            'id' => $obj->pack_id,
            'wh_product_id' => $obj->product_id,
            'wh_item_id' => $this->tempJson['wh_item_id'],
            'item_quantity' => $this->tempJson['item_quantity'],
            'flag_delete' => false,
        ]);
        // Assert Wh Tags
        foreach( $this->tempJson['tags'] as $tag )
        {
            $this->assertDatabaseHas('wh_tag_wh_product', [
                'wh_product_id' => $obj->product_id,
                'wh_tag_id' => $tag
            ]);
        }
        // Assert Upc Codes
        foreach($this->tempJson['upc_codes'] as $upc)
        {
            $this->assertDatabaseHas('wh_product_upc_code', [
                'wh_product_id' => $obj->product_id,
                'upc_code' => $upc
            ]);
        }
        // Assert product data per branch office
        foreach($this->tempJson['branch_office_data'] as $data)
        {
            $this->assertDatabaseHas('wh_product_g_branch_office', [
                'wh_product_id' => $obj->product_id,
                'g_branch_office_id' => $data['g_branch_office_id'],
                'cost_price' => $data['cost_price'],
                'gains_margin' => $data['gains_margin'],
                'minimum_stock' => $data['minimum_stock'],
                'maximum_stock' => $data['maximum_stock'],
                'critical_stock' => $data['critical_stock']
            ]);
            $listPrice = SlListPrice::where('g_branch_office_id',$data['g_branch_office_id'])->where('is_active',1)->where('flag_delete', 0)->first();
            $this->assertDatabaseHas('sl_detail_list_price', [
                'sl_list_price_id' => $listPrice->id,
                'wh_product_id' => $obj->product_id,
                'sale_price' => $data['sale_price'],
                'flag_delete' => false
            ]);
        }

        return $obj->product_id;
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
        $this->tempJson['branch_office_data'] = [
            [
                'g_branch_office_id' => 1,
                'cost_price' => 700,
                'sale_price' => 1100,
                'gains_margin' => 25,
                'minimum_stock' => 15,
                'maximum_stock' => 35,
                'critical_stock' => 25,
            ],
            [
                'g_branch_office_id' => 2,
                'cost_price' => 900,
                'sale_price' => 1300,
                'gains_margin' => 35,
                'minimum_stock' => 25,
                'maximum_stock' => 45,
                'critical_stock' => 55,
            ]
        ];
        $this->tempJson['upc_codes'] = ['23456789', '98765432'];
        $response = $this->updatePack($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'product_id',
                     'pack_id'
                 ]);
        $obj = json_decode( $response->content() );
        // Assert Wh Product
        $this->assertDatabaseHas('wh_product', [
            'id' => $obj->product_id,
            'wh_item_id' => null,
            'wh_pack_id' => $obj->pack_id,
            'wh_packing_id' => null,
            'wh_promo_id' => null,
            'wh_subfamily_id' => $this->tempJson['wh_subfamily_id'],
            'internal_code' => $this->tempJson['internal_code'],
            'name' => $this->tempJson['name'],
            'alias_name' => $this->tempJson['alias_name'],
            'description' => $this->tempJson['description'],
            'path_logo' => '',
            'warranty_days' => $this->tempJson['warranty_days'],
            'is_repackaged' => $this->tempJson['is_repackaged'],
            'is_tax_free' => $this->tempJson['is_tax_free'],
            'is_salable' => $this->tempJson['is_salable'],
            'is_consumable' => $this->tempJson['is_consumable'],
            'is_seasonal' => $this->tempJson['is_seasonal'],
            'flag_delete' => false,
        ]);
        // Assert Wh Pack
        $this->assertDatabaseHas('wh_pack', [
            'id' => $obj->pack_id,
            'wh_product_id' => $obj->product_id,
            'wh_item_id' => $this->tempJson['wh_item_id'],
            'item_quantity' => $this->tempJson['item_quantity'],
            'flag_delete' => false,
        ]);
        // Assert Wh Tags
        foreach( $this->tempJson['tags'] as $tag )
        {
            $this->assertDatabaseHas('wh_tag_wh_product', [
                'wh_product_id' => $obj->product_id,
                'wh_tag_id' => $tag
            ]);
        }
         // Assert Upc Codes
         foreach($this->tempJson['upc_codes'] as $upc)
         {
             $this->assertDatabaseHas('wh_product_upc_code', [
                 'wh_product_id' => $obj->product_id,
                 'upc_code' => $upc
             ]);
         }
         // Assert product data per branch office
         foreach($this->tempJson['branch_office_data'] as $data)
         {
             $this->assertDatabaseHas('wh_product_g_branch_office', [
                 'wh_product_id' => $obj->product_id,
                 'g_branch_office_id' => $data['g_branch_office_id'],
                 'cost_price' => $data['cost_price'],
                 'gains_margin' => $data['gains_margin'],
                 'minimum_stock' => $data['minimum_stock'],
                 'maximum_stock' => $data['maximum_stock'],
                 'critical_stock' => $data['critical_stock']
             ]);
             $listPrice = SlListPrice::where('g_branch_office_id',$data['g_branch_office_id'])->where('is_active',1)->where('flag_delete', 0)->first();
             $this->assertDatabaseHas('sl_detail_list_price', [
                 'sl_list_price_id' => $listPrice->id,
                 'wh_product_id' => $obj->product_id,
                 'sale_price' => $data['sale_price'],
                 'flag_delete' => false
             ]);
         }

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
        $this->assertDatabaseHas('wh_product', [
            'id' => $id,
            'flag_delete' => true
        ]);
        $pack = WhPack::where('wh_product_id', $id)->first();
        // Assert Wh Pack
        $this->assertDatabaseHas('wh_pack', [
            'id' => $pack->id,
            'flag_delete' => true
        ]);
        // Asser Sl Detail List Price
        $slDetailListPriceIds = SlDetailListPrice::where('wh_product_id', $id)->get()->pluck('id');
        foreach($slDetailListPriceIds as $slDetailListPriceId)
        {
            $this->assertDatabaseHas('sl_detail_list_price', [
                'id' => $slDetailListPriceId,
                'flag_delete' => true
            ]);
        }
    }

}
