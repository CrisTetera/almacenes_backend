<?php

namespace Modules\Pos\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Pos\Services\PosDailyCash\ResumePosDailyCashService;
use Carbon\Carbon;

class ResumePosDailyCashTest extends TestCase
{
    /**
     * Attributes
     */
    private $resumePosDailyCashService;
    
    protected function setUp()
    {
        /**
         * This disables the exception handling to display the stacktrace on the console
         * the same way as it shown on the browser
         */
        parent::setUp();

        $posCashDeskId = 1;
        $timestampNow = Carbon::now()->toDateTimeString();
        $this->resumePosDailyCashService = new ResumePosDailyCashService($posCashDeskId, $timestampNow);
    }
    
    /**
     * A basic test example.
     * @expectedException \Exception
     * @return void
     */
    public function test_error_get_complete_pos_daily_cash_resume_failed_pos_cash_desk_param()
    {
        $posCashDeskId = "text";
        $timestampNow = Carbon::now()->toDateTimeString();
        $resumePosDailyCashService = new ResumePosDailyCashService($posCashDeskId, $timestampNow);
    }
    
    /**
     * A basic test example.
     * @expectedException \Exception
     * @return void
     */
    public function test_error_get_complete_pos_daily_cash_resume_failed_timestamp_now_param()
    {
        $posCashDeskId = 1;
        $timestampNow = "this is a string";
        $resumePosDailyCashService = new ResumePosDailyCashService($posCashDeskId, $timestampNow);
    }
    
    /**
     * A basic test example.
     * @expectedException \Exception
     * @return void
     */
    public function test_error_get_complete_pos_daily_cash_resume_failed_flag_complete_resume_param()
    {
        $posCashDeskId = 1;
        $timestampNow = Carbon::now()->toDateTimeString();
        $bCompleteResume = "this is a string";
        $resumePosDailyCashService = new ResumePosDailyCashService($posCashDeskId, $timestampNow, $bCompleteResume);
    }
    
    /**
     * A basic test example.
     * @expectedException \Exception
     * @return void
     */
    public function test_error_get_complete_pos_daily_cash_resume_failed_pos_cash_desk_not_opened()
    {
        $posCashDeskId = 2;
        $timestampNow = Carbon::now()->toDateTimeString();
        $bCompleteResume = "this is a string";
        $resumePosDailyCashService = new ResumePosDailyCashService($posCashDeskId, $timestampNow, $bCompleteResume);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_get_complete_pos_daily_cash_resume()
    {
        $response = $this->resumePosDailyCashService->getCompleteResumePosDailyCash();

        $this->assertArrayHasKey('opening_timestamp', $response);
        $this->assertArrayHasKey('opening_user', $response);
        $this->assertArrayHasKey('ingress_total', $response);
        $this->assertArrayHasKey('egress_total', $response);
        $this->assertArrayHasKey('estimated_cash_total', $response);
        $this->assertArrayHasKey('ingress_total_detail', $response);
        $this->assertArrayHasKey('initial_amount_cash', $response['ingress_total_detail']);
        $this->assertArrayHasKey('ingress_cash_movement_total', $response['ingress_total_detail']);
        $this->assertArrayHasKey('customer_sales_total', $response['ingress_total_detail']);
        $this->assertArrayHasKey('employee_sales_total', $response['ingress_total_detail']);
        $this->assertArrayHasKey('customer_sales_total_detail', $response['ingress_total_detail']);
        $this->assertArrayHasKey('customer_sale_with_cash_total', $response['ingress_total_detail']['customer_sales_total_detail']);
        $this->assertArrayHasKey('customer_sale_with_debit_card_total', $response['ingress_total_detail']['customer_sales_total_detail']);
        $this->assertArrayHasKey('customer_sale_with_credit_cash_total', $response['ingress_total_detail']['customer_sales_total_detail']);
        $this->assertArrayHasKey('customer_sale_with_check_total', $response['ingress_total_detail']['customer_sales_total_detail']);
        $this->assertArrayHasKey('customer_sale_with_customer_credit_total', $response['ingress_total_detail']['customer_sales_total_detail']);
        $this->assertArrayHasKey('employee_sales_total_detail', $response['ingress_total_detail']);
        $this->assertArrayHasKey('employee_sale_with_cash_total', $response['ingress_total_detail']['employee_sales_total_detail']);
        $this->assertArrayHasKey('employee_sale_with_debit_card_total', $response['ingress_total_detail']['employee_sales_total_detail']);
        $this->assertArrayHasKey('employee_sale_with_credit_cash_total', $response['ingress_total_detail']['employee_sales_total_detail']);
        $this->assertArrayHasKey('employee_sale_with_check_total', $response['ingress_total_detail']['employee_sales_total_detail']);
        $this->assertArrayHasKey('employee_sale_with_employee_credit_total', $response['ingress_total_detail']['employee_sales_total_detail']);
        $this->assertArrayHasKey('egress_total_detail', $response);
        $this->assertArrayHasKey('egress_cash_movement_total', $response['egress_total_detail']);

        // Check sum totals
        $this->assertEquals($response['ingress_total'], (
            $response['ingress_total_detail']['initial_amount_cash'] + 
            $response['ingress_total_detail']['ingress_cash_movement_total'] + 
            $response['ingress_total_detail']['customer_sales_total'] + 
            $response['ingress_total_detail']['employee_sales_total']
        ));

        // Check sum totals
        $this->assertEquals($response['ingress_total_detail']['customer_sales_total'], (
            $response['ingress_total_detail']['customer_sales_total_detail']['customer_sale_with_cash_total'] + 
            $response['ingress_total_detail']['customer_sales_total_detail']['customer_sale_with_debit_card_total'] + 
            $response['ingress_total_detail']['customer_sales_total_detail']['customer_sale_with_credit_cash_total'] + 
            $response['ingress_total_detail']['customer_sales_total_detail']['customer_sale_with_check_total'] + 
            $response['ingress_total_detail']['customer_sales_total_detail']['customer_sale_with_customer_credit_total'] 
        ));

        // Check sum totals
        $this->assertEquals($response['ingress_total_detail']['employee_sales_total'], (
            $response['ingress_total_detail']['employee_sales_total_detail']['employee_sale_with_cash_total'] + 
            $response['ingress_total_detail']['employee_sales_total_detail']['employee_sale_with_debit_card_total'] + 
            $response['ingress_total_detail']['employee_sales_total_detail']['employee_sale_with_credit_cash_total'] + 
            $response['ingress_total_detail']['employee_sales_total_detail']['employee_sale_with_check_total'] + 
            $response['ingress_total_detail']['employee_sales_total_detail']['employee_sale_with_employee_credit_total'] 
        ));

        // Check sum totals
        $this->assertEquals($response['egress_total'], (
            $response['egress_total_detail']['egress_cash_movement_total'] 

        ));
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_get_initial_pos_daily_cash_resume()
    {
        $response = $this->resumePosDailyCashService->getInitialResumePosDailyCash();

        $this->assertArrayHasKey('opening_timestamp', $response);
        $this->assertArrayHasKey('opening_user', $response);
        $this->assertArrayHasKey('initial_amount_cash', $response);
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
