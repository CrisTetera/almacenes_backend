<?php

namespace Modules\Pos\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClosePosDailyCashTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_close_daily_cash_fail_pos_cash_desk_param()
    {
        $json = [
            "pos_cash_desk_id" => -1,
            "g_cashier_closure_user_id" => 1,
            "auth_code_supervisor" => 875,
            "real_cash_total" => 100,
            "closure_observation" => "this is a observation",
        ];

        $response = $this->json('PATCH', 'api/pos_daily_cash_close', $json);

        $this->assertErrorValidation($response);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_close_daily_cash_fail_g_cashier_closure_user_param()
    {
        $json = [
            "pos_cash_desk_id" => 1,
            "g_cashier_closure_user_id" => -1,
            "auth_code_supervisor" => 875,
            "real_cash_total" => 100,
            "closure_observation" => "this is a observation",
        ];

        $response = $this->json('PATCH', 'api/pos_daily_cash_close', $json);

        $this->assertErrorValidation($response);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_close_daily_cash_fail_auth_code_supervisor_param()
    {
        $json = [
            "pos_cash_desk_id" => 1,
            "g_cashier_closure_user_id" => -1,
            "auth_code_supervisor" => 870,
            "real_cash_total" => 100,
            "closure_observation" => "this is a observation",
        ];

        $response = $this->json('PATCH', 'api/pos_daily_cash_close', $json);

        $this->assertErrorValidation($response);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_close_daily_cash_fail_real_cash_total_param()
    {
        $json = [
            "pos_cash_desk_id" => 1,
            "g_cashier_closure_user_id" => -1,
            "auth_code_supervisor" => 875,
            "real_cash_total" => 0,
            "closure_observation" => "this is a observation",
        ];

        $response = $this->json('PATCH', 'api/pos_daily_cash_close', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_close_daily_cash()
    {
        $json = [
            "pos_cash_desk_id" => 1,
            "g_cashier_closure_user_id" => 1,
            "auth_code_supervisor" => 875,
            "real_cash_total" => 100,
            "closure_observation" => "this is a observation",
        ];

        $response = $this->json('PATCH', 'api/pos_daily_cash_close', $json);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_fail_close_daily_cash_not_open_daily_cash()
    {
        $json = [
            "pos_cash_desk_id" => 1,
            "g_cashier_closure_user_id" => 1,
            "auth_code_supervisor" => 875,
            "real_cash_total" => 100,
            "closure_observation" => null,
        ];

        $response = $this->json('PATCH', 'api/pos_daily_cash_close', $json);

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
