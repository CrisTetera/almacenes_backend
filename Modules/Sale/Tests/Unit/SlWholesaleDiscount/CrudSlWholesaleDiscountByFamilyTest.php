<?php

namespace Modules\Sale\Tests\Unit\SlWholesaleDiscount;

use Tests\TestCase;

class CrudSlWholesaleDiscountByFamilyTest extends TestCase
{

    public $json = [
        'wh_family_id' => 3,
        'g_branch_office_id' => 1,
        'discount_schema' => [
            [
                'quantity_discount' => 10,
                'percentage_discount' => 5,
            ],
            [
                'quantity_discount' => 40,
                'percentage_discount' => 20,
            ],
            [
                'quantity_discount' => 50,
                'percentage_discount' => 70,
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
        return $this->json('POST', 'api/sl_wholesale_discount_family', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateWholesaleDiscount($id) {
        return $this->json('PUT', "api/sl_wholesale_discount_family/$id", $this->tempJson);
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
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert sl wholesale discount family
        foreach( $this->tempJson['discount_schema'] as $data )
        {
            $this->assertDatabaseHas('sl_wholesale_discount_family', [
                'wh_family_id' => $this->tempJson['wh_family_id'],
                'g_branch_office_id' => $this->tempJson['g_branch_office_id'],
                'quantity_discount' => $data['quantity_discount'],
                'percentage_discount' => $data['percentage_discount'],
                'flag_delete' => false
            ]);
        }
    }

    /**
     * Test should throw exception if wholesale discount doesnt exists in database when updating
     *
     * @return void
     */
    public function test_ShouldThrowException_IfFamilyDoesntExists_WhenUpdate()
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
        $oldJson = $this->tempJson;
        $this->tempJson = [
            'g_branch_office_id' => 1,
            'discount_schema' => [
                [
                    'quantity_discount' => 40,
                    'percentage_discount' => 15,
                ],
                [
                    'quantity_discount' => 60,
                    'percentage_discount' => 35,
                ],
                [
                    'quantity_discount' => 80,
                    'percentage_discount' => 40,
                ]
            ]
        ];
        $response = $this->updateWholesaleDiscount(3); // Id de la familia
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

        // Assert sl wholesale discount family deleted
        foreach( $oldJson['discount_schema'] as $data )
        {
            $this->assertDatabaseHas('sl_wholesale_discount_family', [
                'wh_family_id' => $oldJson['wh_family_id'],
                'g_branch_office_id' => $oldJson['g_branch_office_id'],
                'quantity_discount' => $data['quantity_discount'],
                'percentage_discount' => $data['percentage_discount'],
                'flag_delete' => true
            ]);
        }
        // Assert sl wholesale discount family
        foreach( $this->tempJson['discount_schema'] as $data )
        {
            $this->assertDatabaseHas('sl_wholesale_discount_family', [
                'wh_family_id' => 3,
                'g_branch_office_id' => $this->tempJson['g_branch_office_id'],
                'quantity_discount' => $data['quantity_discount'],
                'percentage_discount' => $data['percentage_discount'],
                'flag_delete' => false
            ]);
        }
    }

}
