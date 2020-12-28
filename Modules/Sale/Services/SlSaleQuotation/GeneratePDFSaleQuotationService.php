<?php

namespace Modules\Sale\Services\SlSaleQuotation;

use Modules\General\Entities\GCompany;
use Modules\Sale\Entities\SlSaleQuotation;
use App\Helpers\Today;


class GeneratePDFSaleQuotationService
{

    public const COMPANY_ID = 1;

    public function generatePDF($idSlSaleQuotation)
    {
        $saleQuotation = $this->getSaleQuotation($idSlSaleQuotation);
        $company = $this->getCompany();
        $fileName = $this->generateFileName();
        // $today = \Carbon\Carbon::now()->formatLocalized('%A %d de %B de %Y');
        // $today = ucfirst( mb_convert_encoding($today, 'UTF-8', 'ISO-8859-1') );
        $today = Today::now();
        $pdf = \PDF::loadView('sale::sale_quotation.pdf', [
            'fileName' => $fileName,
            'saleQuotation' => $saleQuotation,
            'company' => $company,
            'today' => $today
        ]);
        return $pdf;
    }

    private function getSaleQuotation($idSlSaleQuotation)
    {
        return SlSaleQuotation::with('slDetailSaleQuotations.whProduct')
                                ->with('posSaleType')
                                ->with('slCustomer')
                                ->with('gBranchOffice')
                                ->with('slCustomerBranchOffices.gCommune')
                                ->where('id', $idSlSaleQuotation)
                                ->firstOrFail();
    }

    private function getCompany()
    {
        return GCompany::where('id', self::COMPANY_ID)->first();
    }

    public function generateFileName()
    {
        return 'Cotización_'.date('Y_m_d_H_i_s').'.pdf';
    }

    public function downloadPDF($idSlSaleQuotation)
    {
        $pdf = $this->generatePDF($idSlSaleQuotation);
        $fileName = $this->generateFileName();
        return $pdf->download($fileName);
    }

    public function streamPDF($idSlSaleQuotation)
    {
        $pdf = $this->generatePDF($idSlSaleQuotation);
        $fileName = $this->generateFileName();
        return $pdf->stream($fileName);
    }

    public function outputPDF($idSlSaleQuotation)
    {
        $pdf = $this->generatePDF($idSlSaleQuotation);
        return $pdf->output();
    }

}
