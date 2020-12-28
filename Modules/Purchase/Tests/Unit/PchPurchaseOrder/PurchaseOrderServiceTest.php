<?php

namespace Modules\Purchase\Tests\Unit\PchPurchaseOrder;

use Tests\TestCase;
use Modules\Purchase\Entities\PchPurchaseOrderState;
use Modules\Purchase\Entities\PchPaymentCondition;
use Modules\Purchase\Entities\PchDetailPurchaseOrder;

class PurchaseOrderServiceTest extends TestCase
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
    private function storePurchaseOrder() {
        return $this->json('POST', 'api/pch_purchase_order', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updatePurchaseOrder($id) {
        return $this->json('PUT', "api/pch_purchase_order/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteOrderer($id) {
        return $this->json('DELETE', "api/pch_purchase_order/$id");
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
        $response = $this->storePurchaseOrder();
        $response->assertStatus(422);
    }

    /**
     * Test should store orderer
     *
     * @return void
     */
    public function test_ShouldStorePurchaseOrder()
    {
        $response = $this->storePurchaseOrder();
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

        // Assert pch purchase order
        $this->assertDatabaseHas('pch_purchase_order', [
            'id' => $obj->purchase_order_id,
            'pch_provider_id' => $this->tempJson['pch_provider_id'],
            'pch_provider_branch_offices_id' => $this->tempJson['pch_provider_branch_offices_id'],
            'pch_payment_condition_id' => $this->tempJson['pch_payment_condition_id'],
            'pch_purchase_order_state_id' => PchPurchaseOrderState::CREATED,
            'wh_warehouse_id' => $this->tempJson['wh_warehouse_id'],
            'g_originator_user_id' => $this->tempJson['g_originator_user_id'],
            'g_authorizer_user_id' => null,
            'email_sended' => false,
            'observation' => $this->tempJson['observation'],
            'net_subtotal' => 5604,
            'iva' => 1065,
            'total' => 6669,
            'flag_delete' => false
        ]);
        // Assert pch detail purchase order
        foreach( $this->tempJson['details'] as $data )
        {
            $this->assertDatabaseHas('pch_detail_purchase_order', [
                'pch_purchase_order_id' => $obj->purchase_order_id,
                'provider_product_code' => $data['provider_product_code'],
                'wh_product_id' => $data['wh_product_id'],
                'quantity' => $data['quantity'],
                'net_price' => $data['net_price'],
                'net_total' => (int) round($data['quantity'] * $data['net_price']),
                'flag_delete' => false
            ]);
        }
        // Assert orderers
        foreach( $this->tempJson['orderers'] as $ordererId )
        {
            $this->assertDatabaseHas('pch_purchase_order_wh_orderer', [
                'pch_purchase_order_id' => $obj->purchase_order_id,
                'wh_orderer_id' => $ordererId,
            ]);
        }

        return $obj->purchase_order_id;
    }

    /**
     * Test should throw exception if purchase order doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfPurchaseOrderDoesntExists()
    {
        $response = $this->updatePurchaseOrder(-1);
        $this->assertError($response, 500);
    }

    /**
     * Test should throw exception if purchase order cant be updated
     * (a purchase order for that orderer already exists)
     *
     * @return void
     */
    public function test_ShouldThrowException_IfPurchaseOrderCantBeUpdated()
    {
        $response = $this->updatePurchaseOrder(2); // Está autorizada
        $this->assertError($response, 500);
    }

    /**
     * Test should update purchase order
     *
     * @depends test_ShouldStorePurchaseOrder
     * @return void
     */
    public function test_ShouldUpdatePurchaseOrder($id)
    {
        $this->tempJson = [
            'pch_provider_id' => 1,
            'pch_provider_branch_offices_id' => 1,
            'pch_payment_condition_id' => PchPaymentCondition::ANTICIPATED,
            'wh_warehouse_id' => 1,
            'g_originator_user_id' => 2,
            'observation' => 'Lorea el Ipsum',
            'details' => [
                [
                    'provider_product_code' => 'KRYSPO',
                    'wh_product_id' => 8,
                    'quantity' => 4,
                    'net_price' => 500.20
                ],
                [
                    'provider_product_code' => 'PACKBALTI6',
                    'wh_product_id' => 5,
                    'quantity' => 5,
                    'net_price' => 720.50
                ]
            ],
            'orderers' => [2, 3]
        ];
        $response = $this->updatePurchaseOrder($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code'
                 ]);

        // Assert pch purchase order
        $this->assertDatabaseHas('pch_purchase_order', [
            'id' => $id,
            'pch_provider_id' => $this->tempJson['pch_provider_id'],
            'pch_provider_branch_offices_id' => $this->tempJson['pch_provider_branch_offices_id'],
            'pch_payment_condition_id' => $this->tempJson['pch_payment_condition_id'],
            'pch_purchase_order_state_id' => PchPurchaseOrderState::CREATED,
            'wh_warehouse_id' => $this->tempJson['wh_warehouse_id'],
            'g_originator_user_id' => $this->tempJson['g_originator_user_id'],
            'g_authorizer_user_id' => null,
            'email_sended' => false,
            'observation' => $this->tempJson['observation'],
            'net_subtotal' => 5604,
            'iva' => 1065,
            'total' => 6669,
            'flag_delete' => false
        ]);
        // Assert pch detail purchase order
        foreach( $this->tempJson['details'] as $data )
        {
            $this->assertDatabaseHas('pch_detail_purchase_order', [
                'pch_purchase_order_id' => $id,
                'provider_product_code' => $data['provider_product_code'],
                'wh_product_id' => $data['wh_product_id'],
                'quantity' => $data['quantity'],
                'net_price' => $data['net_price'],
                'net_total' => (int) round($data['quantity'] * $data['net_price']),
                'flag_delete' => false
            ]);
        }
        // Assert orderers
        foreach( $this->tempJson['orderers'] as $ordererId )
        {
            $this->assertDatabaseHas('pch_purchase_order_wh_orderer', [
                'pch_purchase_order_id' => $id,
                'wh_orderer_id' => $ordererId,
            ]);
        }
    }

    /**
     * Test should throw exception if purchase order doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfPurchaseOrderDoesntExists_WhenDelete()
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
        $response = $this->updatePurchaseOrder(2); // Ya está autorizada
        $this->assertError($response, 500);
    }

    /**
     * Test should delete purchase order
     *
     * @depends test_ShouldStorePurchaseOrder
     * @return void
     */
    public function test_ShouldDeletePurchaseOrder($id)
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

        // Assert pch purchase order
        $this->assertDatabaseHas('pch_purchase_order', [
            'id' => $id,
            'flag_delete' => true
        ]);
        // Assert details deleted
        $details = PchDetailPurchaseOrder::wherePchPurchaseOrderId($id)->get();
        $details->each(function($data) {
            $this->assertDatabaseHas('pch_detail_purchase_order', [
                'id' => $data->id,
                'flag_delete' => true
            ]);
        });
    }


}
