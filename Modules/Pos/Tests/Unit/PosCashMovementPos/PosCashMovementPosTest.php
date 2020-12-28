<?php

namespace Modules\Pos\Tests\Unit\PosCashMovementPos;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\CustomTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Modules\General\Entities\GUserPos;

class PosCashMovementPosTest extends CustomTestCase
{
    use WithoutMiddleware;

    /** @var GUserPos $user */
    public $user;

    /**
     * Reset tempJson after each test
     *
     * @return void
     */
    protected function setUp() :void
    {
        parent::setUp();
        $this->user = GUserPos::find(self::USER_ID);
        $this->actingAs($this->user, 'api');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_cash_movement_incorrect_pos_cash_desk()
    {
        $saleJSON = [
            "pos_cash_desk_id" => 0,
            "pos_movement_egress_type_id" => null,
            "pos_movement_ingress_type_id" => 1,
            "g_user_id" => 1,
            "amount" => 500,
            'observation' => 'This is a observation',
        ];

        $response = $this->json('POST', 'api/pos_cash_desk_movement_pos', $saleJSON);

        $this->assertErrorValidation($response);

        
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_cash_movement_incorrect_pos_cash_egress_type_id()
    {
        $saleJSON = [
            "pos_cash_desk_id" => 1,
            "pos_movement_egress_type_id" => 0,
            "pos_movement_ingress_type_id" => 1,
            "g_user_id" => 1,
            "amount" => 500,
            'observation' => 'This is a observation',
        ];

        $response = $this->json('POST', 'api/pos_cash_desk_movement_pos', $saleJSON);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_cash_movement_incorrect_pos_cash_ingress_type_id()
    {
        $saleJSON = [
            "pos_cash_desk_id" => 1,
            "pos_movement_egress_type_id" => 1,
            "pos_movement_ingress_type_id" => 0,
            "g_user_id" => 1,
            "amount" => 500,
            'observation' => 'This is a observation',
        ];

        $response = $this->json('POST', 'api/pos_cash_desk_movement_pos', $saleJSON);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_cash_movement_without_pos_cash_ingress_and_egress_type_id()
    {
        $saleJSON = [
            "pos_cash_desk_id" => 1,
            "pos_movement_egress_type_id" => null,
            "pos_movement_ingress_type_id" => null,
            "g_user_id" => 1,
            "amount" => 500,
            'observation' => 'This is a observation',
        ];

        $response = $this->json('POST', 'api/pos_cash_desk_movement_pos', $saleJSON);

        //dump($response);
        $this->assertError($response);
    }

    /**
     * Test POST Cash Movement Endpoint. Only one egress or ingress type is supported.
     *
     * @return void
     */
    public function test_failed_cash_movement_with_pos_cash_ingress_and_egress_type_id()
    {
        $saleJSON = [
            "pos_cash_desk_id" => 1,
            "pos_movement_egress_type_id" => 1,
            "pos_movement_ingress_type_id" => 1,
            "g_user_id" => 1,
            "amount" => 500,
            'observation' => 'This is a observation',
        ];

        $response = $this->json('POST', 'api/pos_cash_desk_movement_pos', $saleJSON);

        $this->assertError($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_cash_movement_incorrect_g_user()
    {
        $saleJSON = [
            "pos_cash_desk_id" => 1,
            "pos_movement_egress_type_id" => 1,
            "pos_movement_ingress_type_id" => 1,
            "g_user_id" => 0,
            "amount" => 500,
            'observation' => 'This is a observation',
        ];

        $response = $this->json('POST', 'api/pos_cash_desk_movement_pos', $saleJSON);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_cash_movement_incorrect_no_numeric_amount()
    {
        $saleJSON = [
            "pos_cash_desk_id" => 1,
            "pos_movement_egress_type_id" => 1,
            "pos_movement_ingress_type_id" => 1,
            "g_user_id" => 1,
            "amount" => 'no numeric',
            'observation' => 'This is a observation',
        ];

        $response = $this->json('POST', 'api/pos_cash_desk_movement_pos', $saleJSON);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_cash_movement_incorrect_lower_than_zero_amount()
    {
        $saleJSON = [
            "pos_cash_desk_id" => 1,
            "pos_movement_egress_type_id" => 1,
            "pos_movement_ingress_type_id" => 1,
            "g_user_id" => 1,
            "amount" => -500,
            'observation' => 'This is a observation',
        ];

        $response = $this->json('POST', 'api/pos_cash_desk_movement_pos', $saleJSON);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_ingress_movement_cash()
    {
        $saleJSON = [
            "pos_cash_desk_id" => 1,
            "pos_movement_egress_type_id" => null,
            "pos_movement_ingress_type_id" => 1,
            "g_user_id" => 1,
            "amount" => 500,
            'observation' => 'This is a observation',
        ];

        $response = $this->json('POST', 'api/pos_cash_desk_movement_pos', $saleJSON);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 201,
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_egress_movement_cash()
    {
        $saleJSON = [
            "pos_cash_desk_id" => 1,
            "pos_movement_egress_type_id" => 1,
            "pos_movement_ingress_type_id" => null,
            "g_user_id" => 1,
            "amount" => 500,
            'observation' => null,
        ];

        $response = $this->json('POST', 'api/pos_cash_desk_movement_pos', $saleJSON);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 201,
        ]);
    }

    /**
     * Function to assert and 500 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    protected function assertError($response)
    {
        $response->assertStatus(500)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    } // end foreach

    /**
     * Function to assert and 422 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    protected function assertErrorValidation($response)
    {
        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    } // end foreach
}
