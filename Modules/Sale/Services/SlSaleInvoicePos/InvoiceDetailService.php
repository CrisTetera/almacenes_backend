<?php

namespace Modules\Sale\Services\SlSaleInvoicePos;

use DB;

use Modules\Pos\Entities\PosSalePos;
use Modules\Sale\Entities\SlInvoicePos;
use Modules\Pos\Entities\PosDetailPos;
use App\Http\Response\CustomResponse;

class InvoiceDetailService
{
    // Variables
    private $slInvoice;

    /**
     * Constructor
     *
     * @param SlInvoicePos $slInvoice
     */
    public function __construct(SlInvoicePos $slInvoice)
    {
        $this->slInvoice = $slInvoice; 
    } // end function

     /**
     * Get Stocks from simple product
     *
     * @param integer $posSaleId
     * @return int
     */
    public function getDetail() 
    {   
        $arrDetailSaleInvoice = [];

        $posSale = PosSalePos::where('sl_invoice_id',$this->slInvoice->id)->first();
        foreach($posSale->posDetailPos()->orderBy('line_number', 'ASC')->get() as $posDetailSale)
        {
            array_push(
                $arrDetailSaleInvoice,
                [
                    'line_number' => $posDetailSale->line_number,
                    'wh_product_id' => $posDetailSale->wh_product_id,
                    'quantity' => $posDetailSale->quantity,
                    'net_price' => $posDetailSale->net_price,
                    'discount_percentage' => $posDetailSale->discountPercentage(),
                    'discount_amount' => $posDetailSale->discountAmount(),
                    'subtotal' => $posDetailSale->new_net_subtotal,
                ]
            );
        }
        return $arrDetailSaleInvoice;
    }  

}
