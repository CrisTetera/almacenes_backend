<?php

namespace Modules\Pos\Services\PosSale;

use Modules\Pos\Entities\PosSale;
use Modules\Sale\Entities\SlSaleTicket;
use Modules\Sale\Entities\SlSaleInvoice;


class UpdatePosSaleService
{
    /**
     * FIXME: add comments
     */
    public function updtePosSale_AddTicketReference($posSale, SlSaleTicket $slSaleTicket)
    {
        $posSale->sl_sale_ticket_id = $slSaleTicket->id;
        $posSale->save();
    }

    /**
     * FIXME: add comments
     */
    public function updtePosSale_AddInvoiceReference($posSale, SlSaleInvoice $slSaleInvoice)
    {
        $posSale->sl_sale_invoice_id = $slSaleInvoice->id;
        $posSale->save();
    }
} // end class

?>
