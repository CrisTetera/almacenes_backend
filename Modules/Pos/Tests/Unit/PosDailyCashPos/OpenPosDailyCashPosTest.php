<?php

namespace Modules\Pos\Tests\Unit\PosDailyCashPos;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\CustomTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class OpenPosDailyCashPosTest extends CustomTestCase
{
    use WithoutMiddleware;
    
    /**
     * Should failed beacuse cash desk doesn't exist
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

        $response = $this->json('POST', 'api/pos_daily_cash_pos', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * Should failed beacuse cashier data doesn't exist
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

        $response = $this->json('POST', 'api/pos_daily_cash_pos', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * Should failed beacuse initial amount isn't numeric
     *
     * @return void
     */
    public function test_failed_open_daily_cash_with_incorrect_no_numeric_amount_data()
    {
        $json = [
            "pos_cash_desk_id" => 2,
            "g_cashier_user_id" => 1,
            "initial_amount_cash" => 'no numeric',
            "observation" => "this is a opening observation",
        ];

        $response = $this->json('POST', 'api/pos_daily_cash_pos', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * Should failed beacuse initial amount is negative
     *
     * @return void
     */
    public function test_failed_open_daily_cash_with_incorrect_lower_than_zero_amount_data()
    {
        $json = [
            "pos_cash_desk_id" => 2,
            "g_cashier_user_id" => 1,
            "initial_amount_cash" => -500,
            "observation" => "this is a opening observation",
        ];

        $response = $this->json('POST', 'api/pos_daily_cash_pos', $json);

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
            "observation" => "This is an observation",
        ];

        $response = $this->json('POST', 'api/pos_daily_cash_pos', $json);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 201,
        ]);
    }

    /**
     * Should failed beacuse cash desk has already an open daily cash
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

        $response = $this->json('POST', 'api/pos_daily_cash_pos', $json);

        $this->assertError($response);
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
