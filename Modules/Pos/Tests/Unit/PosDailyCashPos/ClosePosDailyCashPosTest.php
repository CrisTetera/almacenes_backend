<?php

namespace Modules\Pos\Tests\Unit\PosDailyCashPos;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ClosePosDailyCashPosTest extends TestCase
{
    use WithoutMiddleware;
    
    /**
     * Should failed beacuse cash desk doesn't exist
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

        $response = $this->json('PATCH', 'api/pos_daily_cash_close_pos', $json);

        $this->assertErrorValidation($response);
    }
    
    /**
     * Should failed beacuse cashier doesn't exist
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

        $response = $this->json('PATCH', 'api/pos_daily_cash_close_pos', $json);

        $this->assertErrorValidation($response);
    }
    
    /**
     * Should failed beacuse auth code must be text 
     *
     * @return void
     */
    public function test_success_close_daily_cash_fail_auth_code_supervisor_param()
    {
        $json = [
            "pos_cash_desk_id" => 1,
            "g_cashier_closure_user_id" => 1,
            "auth_code_supervisor" => 870,
            "real_cash_total" => 100,
            "closure_observation" => "this is a observation",
        ];

        $response = $this->json('PATCH', 'api/pos_daily_cash_close_pos', $json);

        $this->assertErrorValidation($response);
    }
    
    /**
     * Should failed beacuse cash total debe ser mayor a 0
     *
     * @return void
     */
    public function test_success_close_daily_cash_fail_real_cash_total_param()
    {
        $json = [
            "pos_cash_desk_id" => 1,
            "g_cashier_closure_user_id" => -1,
            "auth_code_supervisor" => '875',
            "real_cash_total" => 0,
            "closure_observation" => "this is a observation",
        ];

        $response = $this->json('PATCH', 'api/pos_daily_cash_close_pos', $json);

        $this->assertErrorValidation($response);
       
    }

    /**
     * Daily cash closure should succced
     *
     * @return void
     */
    public function test_success_close_daily_cash()
    {
        $json = [
            "pos_cash_desk_id" => 2,
            "g_cashier_closure_user_id" => 1,
            "auth_code_supervisor" => '875',
            "real_cash_total" => 100,
            "closure_observation" => "this is a observation",
        ];

        $response = $this->json('PATCH', 'api/pos_daily_cash_close_pos', $json);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
        ]);
    }

    /**
     * Should failed beacuse cash desk is already closed
     *
     * @return void
     */
    public function test_fail_close_daily_cash_not_open_daily_cash()
    {
        $json = [
            "pos_cash_desk_id" => 1,
            "g_cashier_closure_user_id" => 1,
            "auth_code_supervisor" => '875',
            "real_cash_total" => 100,
            "closure_observation" => null,
        ];

        $response = $this->json('PATCH', 'api/pos_daily_cash_close_pos', $json);

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
