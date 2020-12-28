<?php
namespace Modules\Sale\Services\SlSaleQuotation;

use Exception;
use Modules\Sale\Entities\SlSaleQuotation;
use Modules\Sale\Services\SlSaleQuotation\GeneratePDFSaleQuotationService;

class SendEmailToSlCustomerWithPDF_SaleQuotationService {
    /**
     * Send Email to SlCustomer Object
     * @var \Modules\Sale\Services\SlSaleQuotation\GeneratePDFSaleQuotationService
     */
    private $generatePDFSaleQuotationService;


    /**
     * Construct with init GeneratePDFSaleQuotationService Object
     * @param \Modules\Sale\Services\SlSaleQuotation\GeneratePDFSaleQuotationService
     * @return void
     */
    public function __construct()
    {
        $this->generatePDFSaleQuotationService = new GeneratePDFSaleQuotationService();
    }

    /**
     * Send email to SlCustomer with PDF of SlSaleQuotation ( through notification od SlCustomer)
     * 
     * @param \Modules\Sale\Entities\SlSaleQuotation $slSaleQuotation
     * @return array with status data
     */
    public function sendEmailToSlCustomerWithPDF_SaleQuotation(SlSaleQuotation $slSaleQuotation) : array {
        try {
            $pdf = $this->generatePDFSaleQuotationService->outputPDF($slSaleQuotation->id);
            $slCustomer = $slSaleQuotation->slCustomer;
            $slCustomer->sendEmailPdf_SlSaleQuotation($pdf, $slSaleQuotation);
            
            return [
                'status_sended_email' => 'success' 
            ];
        }
        catch (Exception $exception) {
            return [
                'status_sended_email' => 'error',
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ];
        } // try - catch
    } // end method

} // end class