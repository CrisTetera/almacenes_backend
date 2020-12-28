<?php

namespace Modules\Pos\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OpenPosDailyCashTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_open_daily_cash_with_incorrect_cash_data()
    {
        $json = [
            "pos_cash_desk_id" => 0,
            "g_cashier_user_id" => 1,
            "initial_amount_cash" => 500,
            "observation" => "this is a opening observation",
        ];

        $response = $this->json('POST', 'api/pos_daily_cash', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_open_daily_cash_with_incorrect_cashier_user_data()
    {
        $json = [
            "pos_cash_desk_id" => 2,
            "g_cashier_user_id" => 0,
            "initial_amount_cash" => 500,
            "observation" => "this is a opening observation",
        ];

        $response = $this->json('POST', 'api/pos_daily_cash', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_open_daily_cash_with_incorrect_no_numeric_amount_data()
    {
        $json = [
            "pos_cash_desk_id" => 2,
            "g_cashier_user_id" => 0,
            "initial_amount_cash" => 'no numeric',
            "observation" => "this is a opening observation",
        ];

        $response = $this->json('POST', 'api/pos_daily_cash', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_open_daily_cash_with_incorrect_lower_than_zero_amount_data()
    {
        $json = [
            "pos_cash_desk_id" => 2,
            "g_cashier_user_id" => 0,
            "initial_amount_cash" => -500,
            "observation" => "this is a opening observation",
        ];

        $response = $this->json('POST', 'api/pos_daily_cash', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_open_daily_cash()
    {
        $json = [
            "pos_cash_desk_id" => 2,
            "g_cashier_user_id" => 1,
            "initial_amount_cash" => 500,
            "observation" => "This is a observation",
        ];

        $response = $this->json('POST', 'api/pos_daily_cash', $json);

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
    public function test_failed_open_daily_cash_for_already_open_daily_cash()
    {
        $json = [
            "pos_cash_desk_id" => 2,
            "g_cashier_user_id" => 1,
            "initial_amount_cash" => 500,
            "observation" => "this is a opening observation",
        ];

        $response = $this->json('POST', 'api/pos_daily_cash', $json);

        $this->assertError($response);
    }

    /**
     * Function to assert and 500 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    private function assertError($response)
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
    private function assertErrorValidation($response)
    {
        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    } // end foreach
}
