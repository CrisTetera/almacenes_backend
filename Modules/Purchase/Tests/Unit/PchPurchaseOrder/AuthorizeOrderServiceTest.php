<?php

namespace Modules\Purchase\Tests\Unit\PchPurchaseOrder;

use Tests\TestCase;
use Modules\Purchase\Entities\PchPaymentCondition;

class AuthorizeOrderServiceTest extends TestCase
{
    public $json = [
        'pch_provider_id' => 1,
        'pch_provider_branch_offices_id' => 2,
        'pch_payment_condition_id' => PchPaymentCondition::DAYS_30,
        'wh_warehouse_id' => 1,
        'g_originator_user_id' => 1,
        'observation' => '',
        'details' => [
            [
                'provider_product_code' => 'KRYSPO',
                'wh_product_id' => 8,
                'quantity' => 4,
                'net_price' => 500.20
            ],
            [
                'provider_product_code' => 'PACKBALTI',
                'wh_product_id' => 5,
                'quantity' => 5,
                'net_price' => 720.50
            ]
        ],
        'orderers' => [1, 2]
    ];

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
    private function storePurchaseOrder() {
        return $this->json('POST', 'api/pch_purchase_order', $this->tempJson);
    }

    /**
     * Function to call a HTTP POST
     *
     * @return void
     */
    private function authorizePurchaseOrder($id) {
        return $this->json('POST', "api/pch_purchase_order/$id/authorize", $this->tempJson);
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
     * Test should store orderer
     *
     * @return void
     */
    public function test_ShouldStorePurchaseOrder()
    {
        $response = $this->storePurchaseOrder();
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201,
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'purchase_order_id',
                 ]);
        $obj = json_decode( $response->content() );

        return $obj->purchase_order_id;
    }

    /**
     * Test should authorize orderer
     *
     * @depends test_ShouldStorePurchaseOrder
     * @return void
     */
    public function test_ShouldAuthorizePurchaseOrder($id)
    {
        $response = $this->authorizePurchaseOrder($id);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200,
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code'
                 ]);
    }

    /**
     * Test should throw exception if purchase order can't be authorized
     *
     * @depends test_ShouldStorePurchaseOrder
     * @return void
     */
    public function test_ShouldThrowException_IfPurchaseOrder_CantBeAuthorized($id)
    {
        $response = $this->authorizePurchaseOrder($id);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response);
    }

    /**
     * Test should throw exception if purchase order doesnt exists
     *
     * @depends test_ShouldStorePurchaseOrder
     * @return void
     */
    public function test_ShouldThrowException_IfPurchaseOrder_DoesntExists($id)
    {
        $response = $this->authorizePurchaseOrder(-1);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response);
    }


}
