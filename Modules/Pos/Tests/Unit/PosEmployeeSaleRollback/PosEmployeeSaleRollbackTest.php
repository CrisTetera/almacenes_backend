<?php

namespace Modules\Pos\Tests\Unit\PosEmployeeSaleRollback;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Pos\Entities\PosSale;
use Modules\Pos\Services\PosSaleRollback\RollbakPosSaleTest;

/**
 * This test check succed/error of Rollback open Sales by command
 */
class PosEmployeeSaleRollbackTest extends TestCase
{
    /**
     * Function to call a HTTP POST Request to cancel a sale
     *
     * @return void
     */
    public function test_rollback_pos_employee_sale_success_with_updated_sales() {
        // Call artisan command
        \Artisan::call("open_employee_sales:rollback");
        $response = getArtisanCommandResponse();

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals($response['status'], 'success');
    }

    /**
     * Function to call a HTTP POST Request to cancel a sale
     *
     * @return void
     */
    public function test_rollback_pos_employee_sale_success_without_updated_sales() {
        // Call artisan command
        \Artisan::call("open_employee_sales:rollback");
        $response = getArtisanCommandResponse();

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals($response['status'], 'success');
    }

    /**
     * Function to call a HTTP POST Request to cancel a sale
     * FIXME: write error artisan command rollback
     * @return void
     */
    // public function test_rollback_pos_sale_error_update_sales() {
    //     // Call artisan command
    //     \Artisan::call("open_sales:rollback");
    //     $response = getArtisanCommandResponse();

    //     $this->assertArrayHasKey('status', $response);
    //     $this->assertArrayHasKey('message', $response);
    //     $this->assertArrayHasKey('error', $response);
    //     $this->assertArrayHasKey('file', $response);
    //     $this->assertArrayHasKey('line', $response);
    //     $this->assertEquals($response['status'], 'error');
    // }

} // end class
