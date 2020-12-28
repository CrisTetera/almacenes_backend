<?php

namespace Modules\Sale\Services\SlSaleInvoicePos;

use DB;

use Modules\Pos\Entities\PosSalePos;
use Modules\Sale\Entities\SlInvoicePos;
use Modules\Pos\Entities\PosCashDeskPos;
use Modules\Pos\Entities\PosDailyCashPos;
use App\Http\Response\CustomResponse;
use Illuminate\Http\Request;

class GetLastSlSaleInvoice_OpenCashDeskService
{
    // Constant
    // PosSale
    private const G_STATE_SALE_DONE = 11;
    public const PAYMENT_TYPE_CUSTOMER_CREDIT = 5; // Crédito Cliente (Cuando paga factura a 30,60 o 90 días)
    // PosDailyCash
    private const G_STATE_OPEN_DAILY_CASH = 12;

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
            $posCashDesk = PosCashDeskPos::find($request->cash_desk_id);
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
     * @param \Modules\Pos\Entities\PosCashDeskPos
     * @throws \Exception if not exist open PosDailyCash for PosCashDesk
     * @return  \Modules\Pos\Entities\PosDailyCashPos
     */
    private function getPosCashDeskOpen($posCashDesk)
    {
        $posDailyCashOpen = PosDailyCashPos::where('pos_cash_desk_id', $posCashDesk->id)
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
     * @param \Modules\Pos\Entities\PosDailyCashPos;
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getListSaleInvoice(PosDailyCashPos $posDailyCashOpen)
    {
        return SlInvoicePos::join('pos_sale_pos', 'sl_invoice_pos.id', 'pos_sale_pos.sl_invoice_id')
                            ->join('sl_customer_pos', 'sl_invoice_pos.sl_customer_id', 'sl_customer_pos.id')
                            ->join('g_state_pos', 'sl_invoice_pos.g_state_id', 'g_state_pos.id')
                            ->selectRaw("
                                sl_invoice_pos.invoice_number, 
                                sl_customer_pos.rut, 
                                sl_customer_pos.business_name,
                                NULLIF(sl_invoice_pos.total, '0')::int AS total,
                                g_state_pos.state AS state
                            ")
                            //Filter pos_sale 
                            ->where('pos_sale_pos.created_at', '>=', $posDailyCashOpen->opening_timestamp)
                            ->where('pos_sale_pos.g_state_id', self::G_STATE_SALE_DONE)
                            ->where('pos_sale_pos.flag_delete', false)
                            //Filter sl_sale_invoice
                            ->where('sl_invoice_pos.flag_delete', false)
                            ->get();
    } // end function

} // end class
