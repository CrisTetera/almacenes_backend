<?php

namespace Modules\Pos\Services\PosSalePos;

use App\Http\Response\CustomResponse;
use Modules\Pos\Entities\PosSalePos;
use Modules\Warehouse\Entities\WhItemStockPos;
use Carbon\Carbon;
use DB;

class OpenSalesRollbackService
{   
    // Constant
    private const G_STATE_OPEN_POS_SALE = 9; 
    private const G_STATE_CANCEL_POS_SALE = 10;
    private const BACK_MINUTES_QUANTITY = 15; 

    /**
     * FIXME: Add commemts
     */
    public function openSalesRollback()
    {
        DB::beginTransaction();
        try
        {
            $dtLastXminutes = $this->getDateTimeLastXminutes();
            $arrOpenPosSales = PosSalePos::where('created_at', '<=', $dtLastXminutes)
                                      ->where('g_state_id', self::G_STATE_OPEN_POS_SALE)
                                      ->where('flag_delete', false)
                                      ->with('PosSaleStockReservations')
                                      ->get();

            $iQuantityRowsAffected = $this->openSalesToCancelState($dtLastXminutes);
            $this->stockOpenSalesRollback($arrOpenPosSales);

            DB::commit();
  
            return CustomResponse::ok([
                'message' => "Se han anulado $iQuantityRowsAffected Ticket de venta.",
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    } // end function

    /**
     * FIXME: add comments
     */
    private function getDateTimeLastXminutes()
    {
        $datetimeLastXminutes = Carbon::now()->subMinutes(self::BACK_MINUTES_QUANTITY);   
        return $datetimeLastXminutes->format('Y-m-d H:i:s');
    } // end function


    // FIXME: add comments
    private function openSalesToCancelState($dtLastXminutes)
    {
        $iQuantityRowsAffected = DB::table('pos_sale_pos')->where('created_at', '<=', $dtLastXminutes)
                                                        ->where('g_state_id', self::G_STATE_OPEN_POS_SALE)
                                                        ->where('flag_delete', false)
                                                        ->update([
                                                            'g_state_id' => self::G_STATE_CANCEL_POS_SALE,
                                                        ]);
        return $iQuantityRowsAffected;
    } // end function 

    // FIXME: add comments
    private function stockOpenSalesRollback($arrOpenPosSales)
    {        
        foreach($arrOpenPosSales as $openPosSale)
        {
            foreach($openPosSale->posSaleStockReservations as $posSaleReservation);
            {
                $this->itemStockRollback($posSaleReservation);
            }
        } // end foreach
    } // end function

    // FIXME: add comments
    public function itemStockRollback($posSaleReservation)
    {
        WhItemStockPos::where('wh_warehouse_id', $posSaleReservation->wh_warehouse_id)
                       ->where('wh_item_id', $posSaleReservation->wh_item_id)
                       ->where('flag_delete', false)
                       ->increment('stock', intval($posSaleReservation->stock));
    } // end function

} // end class