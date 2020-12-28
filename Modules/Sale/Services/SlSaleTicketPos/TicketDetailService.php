<?php

namespace Modules\Sale\Services\SlSaleTicketPos;

use DB;

use Modules\Pos\Entities\PosSalePos;
use Modules\Sale\Entities\SlTicketPos;
use Modules\Pos\Entities\PosDetailPos;
use App\Http\Response\CustomResponse;

class TicketDetailService
{
    // Variables
    private $slTicket;

    /**
     * Constructor
     *
     * @param SlTicketPos $slTicket
     */
    public function __construct(SlTicketPos $slTicket)
    {
        $this->slTicket = $slTicket; 
    } // end function

     /**
     * Get Stocks from simple product
     *
     * @param integer $posSaleId
     * @return int
     */
    public function getDetail() 
    {   
        $arrDetailSaleTicket = [];

        $posSale = PosSalePos::where('sl_ticket_id',$this->slTicket->id)->first();
        foreach($posSale->posDetailPos()->orderBy('line_number', 'ASC')->get() as $posDetailSale)
        {
            array_push(
                $arrDetailSaleTicket,
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
        return $arrDetailSaleTicket;
    }  

}
