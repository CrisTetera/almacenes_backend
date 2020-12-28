<?php

namespace Modules\Sale\Services\SlSaleTicket;

use DB;

use Modules\Pos\Entities\PosSale;
use Modules\Pos\Services\DTE\Entities\DTE\Boleta;
use Modules\Pos\Services\PosSale\UpdatePosSaleService;
use Modules\Sale\Entities\SlSaleTicket;
use Modules\Sale\Entities\SlDetailSaleTicket;
use App\Http\Response\CustomResponse;

class CrudSlSaleTicketService
{
    // CONST
    private const THIS_COMPANY_ID = 1;

    // Variables
    private $posSale;
    private $boleta;
    private $paths;
    private $updatePosSaleService;

    // FIXME: add comments
    public function __construct($posSale, Boleta $boleta, array $paths)
    {
        $this->posSale = $posSale;
        $this->boleta = $boleta;
        $this->paths = $paths;
        $this->updatePosSaleService = new UpdatePosSaleService();
    } // end function

    /**
     * Generates a new customer.
     *
     * @param CreateSlCustomerRequest $createSlCustomerRequest
     * @return Response
     */
    public function store() {
        DB::beginTransaction();
        try
        {
            $slSaleTicket = $this->saveSaleTicket();
            $this->saveDetailSaleTicket($slSaleTicket);
            $this->updatePosSaleService->updtePosSale_AddTicketReference($this->posSale, $slSaleTicket);

            DB::commit();

            return CustomResponse::created([
                'dte' => SlSaleTicket::with(['slDetailSaleTickets', 'slCustomer', 'gCompany'])->find($slSaleTicket->id),
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    }

    // FIXME: add comments
    private function saveSaleTicket()
    {
        $slSaleTicket = new SlSaleTicket();

        $slSaleTicket->number = $this->boleta->getFolio();
        $slSaleTicket->dte_type_ticket = $this->boleta->getOEncabezado()->getTipoDte();
        $slSaleTicket->emission_date = date('Y-m-d');
        $slSaleTicket->total = $this->posSale->ticket_total;

        if($this->posSale->discount_or_charge_percentage != 0)
        {
            $slSaleTicket->global_discount_type = (
                $this->posSale->discount_or_charge_percentage > 0 ?
                'Descuento':
                'Recargo' //recharge is a negative discount
            );
            $slSaleTicket->global_discount_apply_to = 'Montos Netos';
            $slSaleTicket->global_discount_percentage = $this->posSale->discount_or_charge_percentage;
            $slSaleTicket->global_discount_amount = $this->posSale->getGlobalDiscountValue_WithPercentageDiscount(); //FIXME: add total boleta without discount
        } // end function

        $slSaleTicket->document_token = $this->boleta->getToken();

        $slSaleTicket->pdf_path = substr(
            $this->paths['pdf_path'],
            strrpos($this->paths['pdf_path'], 'DTE')
        );
        $slSaleTicket->signature_path = substr(
            $this->paths['signature_path'],
            strrpos($this->paths['signature_path'], 'DTE')
        );
        $slSaleTicket->xml_path = substr(
            $this->paths['xml_path'],
            strrpos($this->paths['xml_path'], 'DTE')
        );

        $slSaleTicket->sl_customer_id = $this->posSale->sl_customer_id;
        $slSaleTicket->g_company_id = self::THIS_COMPANY_ID;
        $slSaleTicket->flag_pending_send_dte = $this->boleta->getFolio() === null ? true : false ;

        $slSaleTicket->save();

        return $slSaleTicket;
    } // end function

    // FIXME: add comments
    private function saveDetailSaleTicket(SlSaleTicket $slSaleTicket)
    {
        $arrDetailSaleTicket = [];
        foreach($this->posSale->posDetailSales()->orderBy('line_number', 'ASC')->get() as $posDetailSale)
        {
            array_push(
                $arrDetailSaleTicket,
                new SlDetailSaleTicket([
                    'sl_sale_ticket_id' => $slSaleTicket->id,
                    'line_number' => $posDetailSale->line_number,
                    'wh_product_id' => $posDetailSale->wh_product_id,
                    'quantity' => $posDetailSale->quantity,
                    'price' => $posDetailSale->price,
                    'discount_or_charge_percentage' => $posDetailSale->discountOrChargePercentage(),
                    'discount_or_charge_value' => $posDetailSale->discountOrChargeValue(),
                    'subtotal' => $posDetailSale->total,
                ])
            );
        } // end foreach

        return $slSaleTicket->slDetailSaleTickets()->saveMany($arrDetailSaleTicket);

    } // end function

}
