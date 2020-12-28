<?php

namespace Modules\Pos\Services\PosSalePos;

use Modules\Pos\Entities\PosSalePos;
use Modules\Sale\Entities\SlTicketPos;
use Modules\Sale\Entities\SlInvoicePos;


class UpdatePosSaleService
{
    /**
     * FIXME: add comments
     */
    public function updtePosSale_AddTicketReference($posSale, SlTicketPos $slSaleTicket)
    {
        $posSale->sl_ticket_id = $slSaleTicket->id;
        $posSale->save();
    }

    /**
     * FIXME: add comments
     */
    public function updtePosSale_AddInvoiceReference($posSale, SlInvoicePos $slSaleInvoice)
    {
        $posSale->sl_invoice_id = $slSaleInvoice->id;
        $posSale->save();
    }
} // end class

?>
