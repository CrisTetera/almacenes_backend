<?php

namespace Modules\Pos\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Pos\Entities\PosSale;
use Modules\Pos\Services\PosSale\DtePosSaleService;
use Modules\Pos\Services\PosSale\DteGenerateCreditNoteService;

class DTECancelSaleTest extends TestCase
{
    /**
     * Attributes
     */
    private $dtePosSaleService;
    
    /**
     * Constant
     */
    private const ID_POS_SALE_NORMAL_TICKET = 103;
    private const ID_POS_SALE_NORMAL_INVOICE = 104;
    private const ID_POS_SALE_ALL_DISCOUNT_TICKET = 0;
    private const ID_POS_SALE_ALL_DISCOUNT_INVOICE = 0;

    protected function setUp()
    {
        /**
         * This disables the exception handling to display the stacktrace on the console
         * the same way as it shown on the browser
         */
        parent::setUp();

        $this->dtePosSaleService = new DtePosSaleService();
        $this->dteGenerateCreditNoteService = new DteGenerateCreditNoteService();
        // $this->withoutExceptionHandling();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_dte_pos_sale_service_new_ticket()
    {
        $posSaleTicket = PosSale::find(self::ID_POS_SALE_NORMAL_TICKET);
        
        // Create ticket to cancel
        $this->dtePosSaleService->generateAndSaveDTE($posSaleTicket);

        $response = $this->dteGenerateCreditNoteService->generateCreditNote_OfSale($posSaleTicket);

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('dte', $response);
        $this->assertEquals($response['status'], 'success');
        $this->assertEquals($response['message'], 'El DTE fue creado exitosamente');
    }


    /**
     * A basic test example.
     * @return void
     */
    public function test_error_dte_pos_sale_service_new_invoice_not_accepted_by_sii()
    {
        $posSaleTicket = PosSale::find(self::ID_POS_SALE_NORMAL_INVOICE);
        
        // Create ticket to cancel
        $this->dtePosSaleService->generateAndSaveDTE($posSaleTicket);
        
        // SII delay to confirm DTE
        $response = $this->dteGenerateCreditNoteService->generateCreditNote_OfSale($posSaleTicket);
        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('error_code', $response);
        $this->assertArrayHasKey('error', $response);
        $this->assertEquals($response['status'], 'error');
        $this->assertEquals($response['message'], 'Ha ocurrido en el servidor');
    }
}
