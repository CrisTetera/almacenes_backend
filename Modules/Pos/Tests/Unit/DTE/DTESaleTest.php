<?php

namespace Modules\Pos\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Pos\Entities\PosSalePos;
use Modules\Pos\Services\PosSalePos\DtePosSaleService;
use App\Helpers\CustomTestCase;

class DTESaleTest extends CustomTestCase
{
    /**
     * Attributes
     */
    private $dtePosSaleService;

    /**
     * Constant
     */
    private const ID_POS_SALE_NORMAL_TICKET = 36;
    private const ID_POS_SALE_NORMAL_INVOICE = 141;
    private const ID_POS_SALE_ALL_DISCOUNT_TICKET = 0;
    private const ID_POS_SALE_ALL_DISCOUNT_INVOICE = 0;
    
    protected function setUp() : void
    {
        /**
         * This disables the exception handling to display the stacktrace on the console
         * the same way as it shown on the browser
         */
        parent::setUp();

        $this->dtePosSaleService = new DtePosSaleService();
        // $this->withoutExceptionHandling();
    }

    /** 
     * A basic test example.
     *
     * @return void
     **/
    public function test_success_generate_dte_of_pos_sale_service_with_ticket()
    {
        $posSaleTicket = PosSalePos::find(self::ID_POS_SALE_NORMAL_TICKET); //ticket PosSale
        $response = $this->dtePosSaleService->generateAndSaveDTE($posSaleTicket);
        // dump($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('dte', $response);
        $this->assertEquals($response['status'], 'success');
        $this->assertEquals($response['message'], 'El DTE fue creado y registrado exitosamente');

    }


    // /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
    // public function test_success_generate_dte_of_pos_sale_service_with_invoice()
    // {
    //     $posSaleInvoice = PosSalePos::find(self::ID_POS_SALE_NORMAL_INVOICE); // invoice PosSale
    //     $response = $this->dtePosSaleService->generateAndSaveDTE($posSaleInvoice);
    //     dump($response);
    //     $this->assertArrayHasKey('status', $response);
    //     $this->assertArrayHasKey('message', $response);
    //     $this->assertArrayHasKey('dte', $response);
    //     $this->assertEquals($response['status'], 'success');
    //     $this->assertEquals($response['message'], 'El DTE fue creado y registrado exitosamente');


    //     $this->assertTrue(true);
    // }
}
