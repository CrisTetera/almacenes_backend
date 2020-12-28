<?php

namespace Modules\Purchase\Services\PchPurchaseOrder;

use Modules\General\Entities\GCompany;
use Modules\Purchase\Entities\PchPurchaseOrder;
use App\Helpers\Today;


class GeneratePDFPurchaseOrderService
{
    public const COMPANY_ID = 1;

    public function generatePDF($idPurchaseOrder)
    {
        $purchaseOrder = $this->getPurchaseOrder($idPurchaseOrder);
        $company = $this->getCompany();
        $fileName = $this->generateFileName();
        // $today = \Carbon\Carbon::now()->formatLocalized('%A %d de %B de %Y');
        // $today = ucfirst( mb_convert_encoding($today, 'UTF-8', 'ISO-8859-1') );
        $today = Today::now();
        $pdf = \PDF::loadView('purchase::purchase_order.pdf', [
            'fileName' => $fileName,
            'purchaseOrder' => $purchaseOrder,
            'references' => $purchaseOrder->getFormattedReferences(),
            'company' => $company,
            'today' => $today
        ]);
        return $pdf;
    }

    private function getPurchaseOrder($idPurchaseOrder)
    {
        return PchPurchaseOrder::with('pchDetailPurchaseOrders.whProduct')
                                ->with('pchProvider')
                                ->with('pchProviderBranchOffices.gCommune')
                                ->with('pchPaymentCondition')
                                ->with('whWarehouse.gBranchOffice.gCommune')
                                ->where('id', $idPurchaseOrder)
                                ->firstOrFail();
    }

    private function getCompany()
    {
        return GCompany::where('id', self::COMPANY_ID)->first();
    }

    public function generateFileName()
    {
        return 'OC'.date('Y_m_d_H_i_s').'.pdf';
    }

    public function downloadPDF($idPurchaseOrder)
    {
        $pdf = $this->generatePDF($idPurchaseOrder);
        $fileName = $this->generateFileName();
        return $pdf->download($fileName);
    }

    public function streamPDF($idPurchaseOrder)
    {
        $pdf = $this->generatePDF($idPurchaseOrder);
        $fileName = $this->generateFileName();
        return $pdf->stream($fileName);
    }

    public function outputPDF($idPurchaseOrder)
    {
        $pdf = $this->generatePDF($idPurchaseOrder);
        return $pdf->output();
    }

}
