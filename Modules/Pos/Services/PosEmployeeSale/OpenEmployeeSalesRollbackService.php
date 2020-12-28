<?php

namespace Modules\Pos\Services\PosEmployeeSale;

use App\Http\Response\CustomResponse;
use Modules\Pos\Entities\PosEmployeeSale;
use Modules\Warehouse\Entities\WhWarehouseItem;
use Carbon\Carbon;
use DB;

class OpenEmployeeSalesRollbackService
{
    // Constant
    private const G_STATE_OPEN_POS_EMPLOYEE_SALE = 17; 
    private const G_STATE_CANCEL_POS_EMPLOYEE_SALE = 18;
    private const BACK_MINUTES_QUANTITY = 15; 

    /**
     * FIXME: Add commemts
     */
    public function openEmployeeSalesRollback()
    {
        DB::beginTransaction();
        try
        {
            $dtLastXminutes = $this->getDateTimeLastXminutes();
            $arrOpenPosEmployeeSales = PosEmployeeSale::where('created_at', '<=', $dtLastXminutes)
                                      ->where('g_state_id', self::G_STATE_OPEN_POS_EMPLOYEE_SALE)
                                      ->where('flag_delete', false)
                                      ->with('PosEmployeeSaleStockReservations')
                                      ->get();

            $iQuantityRowsAffected = $this->openEmployeeSalesToCancelState($dtLastXminutes);
            $this->stockOpenEmployeeSalesRollback($arrOpenPosEmployeeSales);

            DB::commit();
  
            return CustomResponse::ok([
                'message' => "Se han anulado $iQuantityRowsAffected Ticket de venta empleado."
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
    private function openEmployeeSalesToCancelState($dtLastXminutes)
    {
        $iQuantityRowsAffected = DB::table('pos_employee_sale')->where('created_at', '<=', $dtLastXminutes)
                                                        ->where('g_state_id', self::G_STATE_OPEN_POS_EMPLOYEE_SALE)
                                                        ->where('flag_delete', false)
                                                        ->update([
                                                            'g_state_id' => self::G_STATE_CANCEL_POS_EMPLOYEE_SALE,
                                                        ]);
        return $iQuantityRowsAffected;
    } // end function 

    // FIXME: add comments
    private function stockOpenEmployeeSalesRollback($arrOpenPosEmployeeSales)
    {        
        foreach($arrOpenPosEmployeeSales as $openPosEmployeeSale)
        {
            foreach($openPosEmployeeSale->posEmployeeSaleStockReservations as $posEmployeeSaleReservation);
            {
                $this->itemStockRollback($posEmployeeSaleReservation);
            }
        } // end foreach
    } // end function

    // FIXME: add comments
    public function itemStockRollback($posEmployeeSaleReservation)
    {
        WhWarehouseItem::where('wh_warehouse_id', $posEmployeeSaleReservation->wh_warehouse_id)
                       ->where('wh_item_id', $posEmployeeSaleReservation->wh_item_id)
                       ->where('flag_delete', false)
                       ->increment('stock', intval($posEmployeeSaleReservation->stock));
    } // end function

} // end class