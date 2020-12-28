<?php

namespace Modules\Sale\Tests\Unit\SlWholesaleDiscount;

use Tests\TestCase;

class CrudSlWholesaleDiscountTest extends TestCase
{

    public $json = [
        'wh_product_id' => 1,
        'g_branch_office_id' => 1,
        'discount_schema' => [
            [
                'quantity_discount' => 10,
                'percentage_discount' => 5,
                'unit_price_discount' => 0
            ],
            [
                'quantity_discount' => 40,
                'percentage_discount' => 20,
                'unit_price_discount' => 1 // Aquí debiese insertarse como 0
            ],
            [
                'quantity_discount' => 50,
                'percentage_discount' => 0,
                'unit_price_discount' => 100
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
    private function storeWholesaleDiscounts() {
        return $this->json('POST', 'api/sl_wholesale_discount', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateWholesaleDiscount($id) {
        return $this->json('PUT', "api/sl_wholesale_discount/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteWholesaleDiscount($id) {
        return $this->json('DELETE', "api/sl_wholesale_discount/$id");
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
     * Test should throw exception if there is no params sended
     *
     * @return void
     */
    public function test_ShouldThrowException_IfThereIsNoParamsSended()
    {
        $this->tempJson = [];
        $response = $this->storeWholesaleDiscounts();
        $response->assertStatus(422);
    }

    /**
     * Test should store wholesale discount
     *
     * @return void
     */
    public function test_ShouldStoreWholesaleDiscounts()
    {
        $response = $this->storeWholesaleDiscounts();

        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201,
                     'data' => [
                        [
                            'quantity_discount' => 10,
                            'percentage_discount' => 5,
                            'unit_price_discount' => 0
                        ],
                        [
                            'quantity_discount' => 40,
                            'percentage_discount' => 20,
                            'unit_price_discount' => 0 // Aquí debiese insertarse como 0
                        ],
                        [
                            'quantity_discount' => 50,
                            'percentage_discount' => 0,
                            'unit_price_discount' => 100
                        ]
                     ]
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'data',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert sl wholesale discount
        foreach( $obj->data as $data )
        {
            $this->assertDatabaseHas('sl_wholesale_discount', [
                'id' => $data->id,
                'wh_product_id' => $data->wh_product_id,
                'g_branch_office_id' => $data->g_branch_office_id,
                'quantity_discount' => $data->quantity_discount,
                'percentage_discount' => $data->percentage_discount,
                'unit_price_discount' => $data->percentage_discount == 0 ? $data->unit_price_discount : 0,
                'flag_delete' => false
            ]);
        }

        // Return first id
        return $obj->data[0]->id;
    }

    /**
     * Test should throw exception if wholesale discount doesnt exists in database when updating
     *
     * @return void
     */
    public function test_ShouldThrowException_IfWholesaleDiscountDoesntExists_WhenUpdate()
    {
        $response = $this->updateWholesaleDiscount(-1);
        $this->assertError($response);
    }

    /**
     * Test should update wholesale discount
     *
     * @return void
     */
    public function test_ShouldUpdateWholesaleDiscount()
    {
        $this->tempJson = [
            'g_branch_office_id' => 1,
            'discount_schema' => [
                [
                    'quantity_discount' => 40,
                    'percentage_discount' => 15,
                    'unit_price_discount' => 0
                ],
                [
                    'quantity_discount' => 60,
                    'percentage_discount' => 35,
                    'unit_price_discount' => 1 // Aquí debiese insertarse como 0
                ],
                [
                    'quantity_discount' => 80,
                    'percentage_discount' => 0,
                    'unit_price_discount' => 500
                ]
            ]
        ];
        $response = $this->updateWholesaleDiscount(1); // 1: Id del producto
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

        // Assert sl wholesale discount
        foreach( $obj->data as $data )
        {
            $this->assertDatabaseHas('sl_wholesale_discount', [
                'id' => $data->id,
                'wh_product_id' => 1,
                'g_branch_office_id' => $data->g_branch_office_id,
                'quantity_discount' => $data->quantity_discount,
                'percentage_discount' => $data->percentage_discount,
                'unit_price_discount' => $data->percentage_discount == 0 ? $data->unit_price_discount : 0,
                'flag_delete' => false
            ]);
        }
    }

    /**
     * Test should throw exception if product doesn´t exists in database when deleting
     *
     * @depends test_ShouldStoreWholesaleDiscounts
     * @return void
     */
    public function test_ShouldThrowException_IfWholesaleDiscountDoesntExists_WhenDelete($id)
    {
        $response = $this->deleteWholesaleDiscount(-1);
        $this->assertError($response);
    }

    /**
     * Test should delete logically wholesale discount
     *
     * @return void
     */
    public function test_ShouldDeleteWholesaleDiscount()
    {
        $idWholesaleDiscount = 1;
        $response = $this->deleteWholesaleDiscount($idWholesaleDiscount);
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

        // Assert sl wholesale discount
        $this->assertDatabaseHas('sl_wholesale_discount', [
            'id' => $idWholesaleDiscount,
            'flag_delete' => true
        ]);
    }

}
