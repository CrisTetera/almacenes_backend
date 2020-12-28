<?php

namespace Modules\Warehouse\Tests\Unit\WhOrderer;

use Tests\TestCase;
use Modules\Warehouse\Entities\WhDetailOrderer;
use Modules\General\Entities\GUser;

class OrdererServiceTest extends TestCase
{
    public $json = [
        'pch_provider_id' => 1,
        'pch_provider_branch_offices_id' => 1,
        'wh_orderer_priority_id' => 1,
        'g_supervisor_user_id' => 2,
        'wh_warehouse_id' => 1,
        'details' => [
            [
                'wh_product_id' => 4,
                'provider_product_code' => 'BALTI',
                'quantity' => 25,
                'brand' => '',
                'description' => ''
            ],
            [
                'wh_product_id' => 8,
                'provider_product_code' => '',
                'quantity' => 16,
                'brand' => 'Kryspo',
                'description' => 'Papitas Kryspo'
            ],
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
    protected function setUp() {
        parent::setUp();
        $this->tempJson = $this->json;

        $user = GUser::find(self::ID_USER);
        $this->actingAs($user, 'api');
    }

    /**
     * Function to call a HTTP POST
     *
     * @return void
     */
    private function storeOrderer() {
        return $this->json('POST', 'api/wh_orderer', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateOrderer($id) {
        return $this->json('PUT', "api/wh_orderer/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteOrderer($id) {
        return $this->json('DELETE', "api/wh_orderer/$id");
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
                     'status' => 'error',
                     'http_status_code' => $code
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
        $response = $this->storeOrderer();
        $response->assertStatus(422);
    }

    /**
     * Test should store orderer
     *
     * @return void
     */
    public function test_ShouldStoreOrderer()
    {
        $response = $this->storeOrderer();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201,
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'orderer_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert wh orderer
        $this->assertDatabaseHas('wh_orderer', [
            'id' => $obj->orderer_id,
            'pch_provider_id' => $this->tempJson['pch_provider_id'],
            'pch_provider_branch_offices_id' => $this->tempJson['pch_provider_branch_offices_id'],
            'wh_orderer_priority_id' => $this->tempJson['wh_orderer_priority_id'],
            'g_supervisor_user_id' => $this->tempJson['g_supervisor_user_id'],
            'flag_delete' => false
        ]);
        // Assert wh detail orderer
        foreach( $this->tempJson['details'] as $data )
        {
            $this->assertDatabaseHas('wh_detail_orderer', [
                'wh_orderer_id' => $obj->orderer_id,
                'wh_product_id' => $data['wh_product_id'],
                'provider_product_code' => $data['provider_product_code'],
                'quantity' => $data['quantity'],
                'brand' => $data['brand'],
                'description' => $data['description'],
                'flag_delete' => false
            ]);
        }

        return $obj->orderer_id;
    }

    /**
     * Test should throw exception if orderer doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfOrdererDoesntExists()
    {
        $response = $this->updateOrderer(-1);
        $this->assertError($response, 500);
    }

    /**
     * Test should throw exception if orderer cant be updated
     * (a purchase order for that orderer already exists)
     *
     * @return void
     */
    public function test_ShouldThrowException_IfOrdererCantBeUpdated()
    {
        $response = $this->updateOrderer(1);
        $this->assertError($response, 500);
    }

    /**
     * Test should store orderer
     *
     * @depends test_ShouldStoreOrderer
     * @return void
     */
    public function test_ShouldUpdateOrderer($id)
    {
        $oldJson = $this->tempJson;
        $this->tempJson = [
            'pch_provider_id' => 1,
            'pch_provider_branch_offices_id' => 2,
            'wh_orderer_priority_id' => 2,
            'g_supervisor_user_id' => 3,
            'wh_warehouse_id' => 1,
            'details' => [
                [
                    'wh_product_id' => 2,
                    'provider_product_code' => 'SOME',
                    'quantity' => 22,
                    'brand' => 'Some Product Brand',
                    'description' => ''
                ],
                [
                    'wh_product_id' => 5,
                    'provider_product_code' => '',
                    'quantity' => 15,
                    'brand' => '',
                    'description' => 'Pack para celebrar'
                ],
            ]
        ];
        $response = $this->updateOrderer($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code'
                 ]);

        // Assert wh orderer
        $this->assertDatabaseHas('wh_orderer', [
            'id' => $id,
            'pch_provider_id' => $this->tempJson['pch_provider_id'],
            'pch_provider_branch_offices_id' => $this->tempJson['pch_provider_branch_offices_id'],
            'wh_orderer_priority_id' => $this->tempJson['wh_orderer_priority_id'],
            'g_supervisor_user_id' => $this->tempJson['g_supervisor_user_id'],
            'flag_delete' => false
        ]);
        // Assert old json deleted
        foreach( $oldJson['details'] as $data )
        {
            $this->assertDatabaseHas('wh_detail_orderer', [
                'wh_orderer_id' => $id,
                'wh_product_id' => $data['wh_product_id'],
                'provider_product_code' => $data['provider_product_code'],
                'quantity' => $data['quantity'],
                'brand' => $data['brand'],
                'description' => $data['description'],
                'flag_delete' => true
            ]);
        }
        // Assert wh detail orderer
        foreach( $this->tempJson['details'] as $data )
        {
            $this->assertDatabaseHas('wh_detail_orderer', [
                'wh_orderer_id' => $id,
                'wh_product_id' => $data['wh_product_id'],
                'provider_product_code' => $data['provider_product_code'],
                'quantity' => $data['quantity'],
                'brand' => $data['brand'],
                'description' => $data['description'],
                'flag_delete' => false
            ]);
        }
    }

    /**
     * Test should throw exception if orderer doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfOrdererDoesntExists_WhenDelete()
    {
        $response = $this->deleteOrderer(-1);
        $this->assertError($response, 500);
    }

    /**
     * Test should throw exception if orderer cant be deleted
     * (a purchase order for that orderer already exists)
     *
     * @return void
     */
    public function test_ShouldThrowException_IfOrdererCantBeDeleted()
    {
        $response = $this->updateOrderer(1);
        $this->assertError($response, 500);
    }

    /**
     * Test should store orderer
     *
     * @depends test_ShouldStoreOrderer
     * @return void
     */
    public function test_ShouldDeleteOrderer($id)
    {
        $response = $this->deleteOrderer($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code'
                 ]);

        // Assert wh orderer
        $this->assertDatabaseHas('wh_orderer', [
            'id' => $id,
            'flag_delete' => true
        ]);
        // Assert details deleted
        $details = WhDetailOrderer::whereWhOrdererId($id)->get();
        $details->each(function($data) {
            $this->assertDatabaseHas('wh_detail_orderer', [
                'id' => $data->id,
                'flag_delete' => true
            ]);
        });
    }

}
