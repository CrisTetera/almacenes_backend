<?php

namespace Modules\Pos\Tests\Unit\PosDailyCashPos;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\CustomTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ResumePosDailyCashRequestPosTest extends CustomTestCase
{
    use WithoutMiddleware;
    
    /**
     * Should fail because cash desk doesn't exist
     *
     * @return void
     */
    public function test_error_request_initial_resume_pos_daily_cash_request_fail_pos_cash_desk_param()
    {
        $json = [
            "pos_cash_desk_id" => -1,
        ];

        $response = $this->json('GET', 'api/pos_daily_cash_initial_resume_pos', $json);
        $this->assertErrorValidation($response);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_request_initial_resume_pos_daily_cash_request()
    {
        $json = [
            "pos_cash_desk_id" => 2,
        ];

        $response = $this->json('GET', 'api/pos_daily_cash_initial_resume_pos', $json);


        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
        ]);
    }
    
    /**
     * Should fail because txt parameter instead of int
     *
     * @return void
     */
    public function test_error_request_initial_resume_pos_daily_cash_request_with_string_pos_cash_desk_param()
    {
        $json = [
            "pos_cash_desk_id" => "2",
        ];

        $response = $this->json('GET', 'api/pos_daily_cash_initial_resume_pos', $json);

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
    public function test_error_request_complete_resume_pos_daily_cash_request_fail_pos_cash_desk_param()
    {
        $json = [
            "pos_cash_desk_id" => -1,
            "auth_code_supervisor" => '875',
        ];

        $response = $this->json('GET', 'api/pos_daily_cash_complete_resume_pos', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_error_request_complete_resume_pos_daily_cash_request_fail_auth_code_supervisor_param()
    {
        $json = [
            "pos_cash_desk_id" => 2,
            "auth_code_supervisor" => 870,
        ];
        
        $response = $this->json('GET', 'api/pos_daily_cash_complete_resume_pos', $json);
        $this->assertError($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_request_complete_resume_pos_daily_cash_request()
    {
        $json = [
            "pos_cash_desk_id" => 2,
            "auth_code_supervisor" => '875',
        ];

        $response = $this->json('GET', 'api/pos_daily_cash_complete_resume_pos', $json);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
        ]);
    }

     /**
     * Function to assert and 500 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    protected function assertError($response, $code = 500) {
        $response->assertStatus($code)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    }

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
