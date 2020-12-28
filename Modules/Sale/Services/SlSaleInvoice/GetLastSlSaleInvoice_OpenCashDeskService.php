<?php

namespace Modules\Sale\Services\SlSaleInvoice;

use DB;

use Modules\Pos\Entities\PosSale;
use Modules\Sale\Entities\SlSaleInvoice;
use Modules\Sale\Entities\SlDetailSaleInvoice;
use Modules\Pos\Entities\PosCashDesk;
use Modules\Pos\Entities\PosDailyCash;
use App\Http\Response\CustomResponse;
use Illuminate\Http\Request;

class GetLastSlSaleInvoice_OpenCashDeskService
{
    // Constant
    // PosSale
    private const G_STATE_SALE_DONE = 19;
    public const PAYMENT_TYPE_CUSTOMER_CREDIT = 5; // Crédito Cliente (Cuando paga factura a 30,60 o 90 días)
    // PosDailyCash
    private const G_STATE_OPEN_DAILY_CASH = 20;

    /**
     * Generates a new customer.
     *
     * @param \CreateSlCuIlluminate\Http\Request $request
     * @return array
     */
    public function getLastSaleInvoiceOpenCashDesk(Request $request) {
        DB::beginTransaction();
        try
        {
            $posCashDesk = PosCashDesk::find($request->cash_desk_id);
            $posDailyCashOpen = $this->getPosCashDeskOpen($posCashDesk);
            $listSlSaleInvoices = $this->getListSaleInvoice($posDailyCashOpen);

            DB::commit();

            return CustomResponse::ok(
                array('data' => $listSlSaleInvoices)
            );
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    } // end function

    /**
     * Get Open PosDailyCash id PosCashDesk
     * 
     * @param \Modules\Pos\Entities\PosCashDesk
     * @throws \Exception if not exist open PosDailyCash for PosCashDesk
     * @return  \Modules\Pos\Entities\PosDailyCash
     */
    private function getPosCashDeskOpen($posCashDesk)
    {
        $posDailyCashOpen = PosDailyCash::where('pos_cash_desk_id', $posCashDesk->id)
                                        ->where('flag_open_daily_cash', true)
                                        ->where('closure_timestamp', null)
                                        ->where('g_state_id', self::G_STATE_OPEN_DAILY_CASH)
                                        ->where('flag_delete', false)
                                        ->first();
        if(! isset($posDailyCashOpen))
            throw new \Exception("La caja seleccionada no está abierta");
        
        return $posDailyCashOpen;
    } // end function

    /**
     * Get List SlSaleInvoice of Open PosDailyCash
     * 
     * @param \Modules\Pos\Entities\PosDailyCash;
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getListSaleInvoice(PosDailyCash $posDailyCashOpen)
    {
        return SlSaleInvoice::join('pos_sale', 'sl_sale_invoice.id', 'pos_sale.sl_sale_invoice_id')
                            ->join('sl_customer', 'sl_sale_invoice.sl_customer_id', 'sl_customer.id')
                            ->join('g_state', 'sl_sale_invoice.g_state_id', 'g_state.id')
                            ->selectRaw("
                                sl_sale_invoice.number, 
                                sl_customer.rut, 
                                sl_customer.business_name,
                                NULLIF(sl_sale_invoice.total, '0')::int AS total,
                                g_state.state AS state
                            ")
                            //Filter pos_sale 
                            ->where('pos_sale.created_at', '>=', $posDailyCashOpen->opening_timestamp)
                            ->where('pos_sale.g_state_id', self::G_STATE_SALE_DONE)
                            ->where('pos_sale.flag_delete', false)
                            //Filter sl_sale_invoice
                            ->where('sl_sale_invoice.flag_delete', false)
                            ->get();
    } // end function

} // end class
