<?php

namespace Modules\Sale\Services\SlCreditNote;

use Modules\Sale\Entities\SlDetailSaleCreditNote;
use Modules\Sale\Entities\SlSaleCreditNote;
use App\Http\Response\CustomResponse;
use Modules\Sale\Entities\SlSaleTicket;
use Illuminate\Support\Facades\DB;
use Modules\Pos\Services\DTE\Entities\DTE\DTE;
use Modules\Sale\Entities\SlServiceOrder;
use Modules\Pos\Entities\PosSale;


class CrudSlSaleCreditNoteService
{
    // CONST
    private const THIS_COMPANY_ID = 1;
    private const CODE_NOTA_CREDITO = 61;

    // Variables
    /** @var SlServiceOrder $serviceOrder */
    private $serviceOrder;
    /** @var PosSale $sale */
    private $sale;
    private $creditNote;
    private $paths;

    // FIXME: add comments. "?" is nullable type data
    public function __construct(SlServiceOrder $serviceOrder, PosSale $sale, ?DTE $creditNote, ?array $paths )
    {
        $this->serviceOrder = $serviceOrder;
        $this->sale = $sale;
        $this->creditNote = $creditNote;
        $this->paths = $paths;
    } // end function

    /**
     * Store credit note.
     *
     * @return Response
     */
    public function store() {
        try {
            DB::beginTransaction();
            $slSaleCreditNote = $this->saveSaleCreditNote();
            $this->saveDetailSaleCreditNote($slSaleCreditNote);
            DB::commit();

            return ['dte' => SlSaleCreditNote::with(['slDetailSaleCreditNotes', 'slCustomer', 'gCompany'])->find($slSaleCreditNote->id)];
        }
        catch(\Exception $e) {
            DB::rollback();
            throw $e;
            // return CustomResponse::error($e);
        }
    }


    /**
     * Generates a new sale credit note
     *
     * @return void
     */
    private function saveSaleCreditNote()
    {
        $slSaleCreditNote = new SlSaleCreditNote();
        $slSaleCreditNote->number = isset($this->creditNote) && $this->creditNote->getFolio() != null ? 
                                    $this->creditNote->getFolio() : 
                                    "S/N";
        $slSaleCreditNote->dte_type_credit_note = self::CODE_NOTA_CREDITO;
        $slSaleCreditNote->emission_date = date('Y-m-d');

        // Totales.
        $slSaleCreditNote->net_total = $this->sale->net_subtotal;
        $slSaleCreditNote->iva = $this->sale->iva;
        $slSaleCreditNote->total = $this->serviceOrder->sl_sale_ticket_id ? $this->sale->ticket_total : $this->sale->invoice_total;

        if($this->sale->discount_or_charge_percentage != 0)
        {
            $slSaleCreditNote->global_discount_type = (
                $this->sale->discount_or_charge_percentage > 0 ?
                'Descuento':
                'Recargo' //recharge is a negative discount
            );
            $slSaleCreditNote->global_discount_apply_to = 'Montos Netos';
            $slSaleCreditNote->global_discount_percentage = $this->sale->discount_or_charge_percentage;
            $slSaleCreditNote->global_discount_amount = $this->sale->getGlobalDiscountValue_WithPercentageDiscount(); //FIXME: add total boleta without discount
        } // end function

        $slSaleCreditNote->document_token = isset($this->creditNote) && $this->creditNote->getToken() !== null ? 
                                            $this->creditNote->getToken() : 
                                            null;

        if(isset($this->paths)) {
            $slSaleCreditNote->pdf_path = substr(
                $this->paths['pdf_path'],
                strrpos($this->paths['pdf_path'], 'DTE')
            );
            $slSaleCreditNote->signature_path = substr(
                $this->paths['signature_path'],
                strrpos($this->paths['signature_path'], 'DTE')
            );
            $slSaleCreditNote->xml_path = substr(
                $this->paths['xml_path'],
                strrpos($this->paths['xml_path'], 'DTE')
            );
        } // end if
        
        $slSaleCreditNote->sl_customer_id = $this->sale->sl_customer_id;
        $slSaleCreditNote->g_company_id = self::THIS_COMPANY_ID;
        $slSaleCreditNote->sl_service_order_id = $this->serviceOrder->id;
        $slSaleCreditNote->was_replaced = false;
        $slSaleCreditNote->flag_pending_send_dte = isset($this->creditNote) && $this->creditNote->getFolio() === null ? 
                                                    true : 
                                                    false ;
        $slSaleCreditNote->flag_delete = false;

        $slSaleCreditNote->save();
        return $slSaleCreditNote;
    } // end function

    // FIXME: add comments
    private function saveDetailSaleCreditNote(SlSaleCreditNote $slSaleCreditNote)
    {
        $arrDetailSaleCreditNote = [];
        foreach($this->sale->posDetailSales()->orderBy('line_number', 'ASC')->get() as $posDetailSale)
        {
            array_push(
                $arrDetailSaleCreditNote,
                new SlDetailSaleCreditNote([
                    'sl_sale_credit_note_id' => $slSaleCreditNote->id,
                    'line_number' => $posDetailSale->line_number,
                    'wh_product_id' => $posDetailSale->wh_product_id,
                    'quantity' => $posDetailSale->quantity,
                    'net_price' => isset($this->sale->slSaleInvoice) ? $posDetailSale->net_price : null,
                    'price' => isset($this->sale->slSaleTicket) ? $posDetailSale->price : null,
                    'discount_or_charge_percentage' => $posDetailSale->discountOrChargePercentage(),
                    'discount_or_charge_value' => $posDetailSale->discountOrChargeValue(),
                    'subtotal' => $posDetailSale->total,
                ])
            );
        } // end foreach

        return $slSaleCreditNote->slDetailSaleCreditNotes()->saveMany($arrDetailSaleCreditNote);

    } // end function
}
