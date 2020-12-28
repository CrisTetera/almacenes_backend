<?php

namespace Modules\Sale\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Sale\Services\SlSaleQuotation\SendEmailToSlCustomerWithPDF_SaleQuotationService;
use Modules\Sale\Entities\SlSaleQuotation;

class SendEmaiToSlCustomerWithPdf_SaleQuotationServiceTest extends TestCase
{
    /**
     * Constant with SlCustomer ID for test
     */
    private const SL_SALE_QUOTATION_ID = 2;
    /**
     * Setup send email service to customer object
     * @var SendEmailToSlCustomerWithPDF_SaleQuotationService
     */
    private $sendEmailToSlCustomerWithPDF_SaleQuotationService;

    /**
     * Sale Quotation to send for email to Customer
     * @var SlSaleQuotation
     */
    private $slSaleQuotation;

    /**
     * SetInit SendEmailToSlCustomerWithPDF_SaleQuotationService and SlSaleQuotation object
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->sendEmailToSlCustomerWithPDF_SaleQuotationService = new SendEmailToSlCustomerWithPDF_SaleQuotationService();
        $this->slSaleQuotation = SlSaleQuotation::find(self::SL_SALE_QUOTATION_ID); // Quotation of customer with yopmail email
    }

    /**
     * Test success of send email with quotation.
     *
     * @return void
     */
    public function testSuccess_sendEmailQuotation()
    {
        $response = $this->sendEmailToSlCustomerWithPDF_SaleQuotationService
                         ->sendEmailToSlCustomerWithPDF_SaleQuotation($this->slSaleQuotation);

        $this->assertArrayHasKey('status_sended_email', $response);
        $this->assertEquals($response['status_sended_email'], 'success');
    }
}
