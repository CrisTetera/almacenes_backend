<?php

namespace Modules\Sale\Services\SlSaleInvoice;

use DB;

use Modules\Pos\Entities\PosSale;
use Modules\Pos\Services\DTE\Entities\DTE\Factura;
use Modules\Pos\Services\PosSale\UpdatePosSaleService;
use Modules\Sale\Entities\SlSaleInvoice;
use Modules\Sale\Entities\SlDetailSaleInvoice;
use App\Http\Response\CustomResponse;

class CrudSlSaleInvoiceService
{
    // CONST
    private const THIS_COMPANY_ID = 1;
    private const SL_SALE_INVOICE_NOT_PAYED = 21;
    private const SL_SALE_INVOICE_PAYED = 22;

    // Variables
    private $posSale;
    private $factura;
    private $paths;
    private $updatePosSaleService;

    // FIXME: add comments
    public function __construct(PosSale $posSale, Factura $factura, array $paths)
    {
        $this->posSale = $posSale;
        $this->factura = $factura;
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
            $slSaleInvoice = $this->saveSaleInvoice();
            $this->saveDetailSaleInvoice($slSaleInvoice);
            $this->updatePosSaleService->updtePosSale_AddInvoiceReference($this->posSale, $slSaleInvoice);

            DB::commit();

            return CustomResponse::created([
                'dte' => SlSaleInvoice::with(['slDetailSaleInvoices', 'slCustomer', 'gCompany'])->find($slSaleInvoice->id),
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    }

    // FIXME: add comments
    private function saveSaleInvoice()
    {
        $slSaleInvoice = new SlSaleInvoice();

        $slSaleInvoice->number = $this->factura->getFolio();
        $slSaleInvoice->dte_type_invoice = $this->factura->getOEncabezado()->getTipoDte();
        $slSaleInvoice->emission_date = date('Y-m-d');
        $slSaleInvoice->net_total = $this->posSale->new_net_subtotal;
        $slSaleInvoice->iva = $this->posSale->iva;
        $slSaleInvoice->total = $this->posSale->invoice_total;

        if($this->posSale->discount_or_charge_percentage != 0)
        {
            $slSaleInvoice->global_discount_type = (
                $this->posSale->discount_or_charge_percentage > 0 ?
                'Descuento':
                'Recargo' //recharge is a negative discount
            );
            $slSaleInvoice->global_discount_apply_to = 'Montos Netos';
            $slSaleInvoice->global_discount_percentage = $this->posSale->discount_or_charge_percentage;
            $slSaleInvoice->global_discount_amount = $this->posSale->getGlobalDiscountValue_WithPercentageDiscount(); //FIXME: add total factura without discount
        } // end function

        $slSaleInvoice->document_token = $this->factura->getToken();

        $slSaleInvoice->pdf_path = substr(
            $this->paths['pdf_path'],
            strrpos($this->paths['pdf_path'], 'DTE')
        );
        $slSaleInvoice->signature_path = substr(
            $this->paths['signature_path'],
            strrpos($this->paths['signature_path'], 'DTE')
        );
        $slSaleInvoice->xml_path = substr(
            $this->paths['xml_path'],
            strrpos($this->paths['xml_path'], 'DTE')
        );

        $slSaleInvoice->sl_customer_id = $this->posSale->sl_customer_id;
        $slSaleInvoice->sl_customer_branch_offices_id = $this->posSale->sl_customer_branch_offices_id;
        $slSaleInvoice->g_company_id = self::THIS_COMPANY_ID;
        $slSaleInvoice->g_state_id = $this->posSale->isTypeInvoicePaymentCredit() ? 
                                     self::SL_SALE_INVOICE_PAYED : 
                                     self::SL_SALE_INVOICE_NOT_PAYED;
        $slSaleInvoice->flag_pending_send_dte = $this->factura->getFolio() === null ? true : false ;

        $slSaleInvoice->save();

        return $slSaleInvoice;
    } // end function

    // FIXME: add comments
    private function saveDetailSaleInvoice(SlSaleInvoice $slSaleInvoice)
    {
        $arrDetailSaleInvoice = [];
        foreach($this->posSale->posDetailSales()->orderBy('line_number', 'ASC')->get() as $posDetailSale)
        {
            array_push(
                $arrDetailSaleInvoice,
                new SlDetailSaleInvoice([
                    'sl_sale_invoice_id' => $slSaleInvoice->id,
                    'line_number' => $posDetailSale->line_number,
                    'wh_product_id' => $posDetailSale->wh_product_id,
                    'quantity' => $posDetailSale->quantity,
                    'net_price' => $posDetailSale->net_price,
                    'discount_or_charge_percentage' => $posDetailSale->discountOrChargePercentage(),
                    'discount_or_charge_value' => $posDetailSale->discountOrChargeValue(),
                    'subtotal' => $posDetailSale->new_net_subtotal,
                ])
            );
        } // end foreach

        return $slSaleInvoice->slDetailSaleInvoices()->saveMany($arrDetailSaleInvoice);

    } // end function

}
