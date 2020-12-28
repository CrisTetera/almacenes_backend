<?php

namespace Modules\Warehouse\Tests\Unit\WhProduct;

use Tests\TestCase;
use Modules\Sale\Entities\SlListPrice;

class MassiveMarginPriceProductServiceTest extends TestCase
{
    public $json = [
        "g_branch_office_id" => 1,
        "products" => [
            [
                'wh_product_id' => 1,
                'gains_margin' => 10,
                'sale_price' => 300
            ],
            [
                'wh_product_id' => 2,
                'gains_margin' => 15,
                'sale_price' => 350
            ],
            [
                'wh_product_id' => 3,
                'gains_margin' => 20,
                'sale_price' => 400
            ],
            [
                'wh_product_id' => 4,
                'gains_margin' => 25,
                'sale_price' => 450
            ],
            [
                'wh_product_id' => 5,
                'gains_margin' => 30,
                'sale_price' => 500
            ],
            [
                'wh_product_id' => 6,
                'gains_margin' => 35,
                'sale_price' => 550
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
    private function massiveUpdate() {
        return $this->json('PUT', 'api/wh_product/massive_margin', $this->tempJson);
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
        $response = $this->massiveUpdate();
        $this->assertError($response, 422);
    }

    /**
     * Test should store item
     *
     * @return void
     */
    public function test_ShouldMassiveUpdate()
    {
        $response = $this->massiveUpdate();
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code'
                 ]);
        $obj = json_decode( $response->content() );

        // Assert gains margin
        foreach($this->tempJson['products'] as $product)
        {
            $this->assertDatabaseHas('wh_product_g_branch_office', [
                'wh_product_id' => $product['wh_product_id'],
                'g_branch_office_id' => $this->tempJson['g_branch_office_id'],
                'gains_margin' => $product['gains_margin']
            ]);
        }

        // Assert Detail List Price
        $listPrice = SlListPrice::where('g_branch_office_id', $this->tempJson['g_branch_office_id'])->where('is_active', true)->where('flag_delete', false)->first();

        foreach($this->tempJson['products'] as $product)
        {
            $this->assertDatabaseHas('sl_detail_list_price', [
                'sl_list_price_id' => $listPrice->id,
                'wh_product_id' => $product['wh_product_id'],
                'sale_price' => $product['sale_price'],
                'flag_delete' => false
            ]);
        }
    }

}
