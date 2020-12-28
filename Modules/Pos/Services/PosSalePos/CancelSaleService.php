<?php

namespace Modules\Pos\Services\PosSalePos;

use Illuminate\Support\Facades\DB;
use Modules\Pos\Entities\PosSalePos;
use App\Http\Response\CustomResponse;
use Dotenv\Exception\ValidationException;
use Modules\Pos\Entities\PosSaleStockReservationPos;
use Modules\Pos\Services\PosSalePos\Entities\SaleConstant;

class CancelSaleService
{

    /** @var OpenSalesRollbackService $openSalesRollbackService */
    private $openSalesRollbackService;

    function __construct(OpenSalesRollbackService $openSalesRollbackService)
    {
        $this->openSalesRollbackService = $openSalesRollbackService;
    }

    /**
     * Cancels a sale.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function cancelSale($saleId)
    {
        try
        {
            DB::beginTransaction();

            $sale = PosSalePos::findOrFail($saleId);

            $this->checkIfsaleCanBeCancelled($sale);

            $sale->g_state_id = SaleConstant::SALE_STATE_ANULADA;

            $sale->save();

            // Rollback a la reserva ( Volver a añadir lo de la reserva al inventario )
            $posSaleReservations = PosSaleStockReservationPos::where('pos_sale_id', $sale->id)->get();
            foreach($posSaleReservations as $posSaleReservation) {
                $this->openSalesRollbackService->itemStockRollback($posSaleReservation);
            }

            
            DB::commit();

            return CustomResponse::ok([
                'message' => 'Venta anulada con éxito'
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    }

    /**
     * Checks if sale can be canceled,
     * If not, throws Dotenv\Exception\ValidationException
     *
     * @param Modules\Pos\Entities\PosSale $posSale
     * @return void
     */
    public function checkIfsaleCanBeCancelled($posSale) {
        if ($posSale->flag_delete) {
            throw new ValidationException("La venta está eliminada.");
        }
        if ($posSale->g_state_id === SaleConstant::SALE_STATE_ANULADA) {
            throw new ValidationException("La venta ya ha sido anulada.");
        }
        if ($posSale->g_state_id === SaleConstant::SALE_STATE_REALIZADA) {
            throw new ValidationException("La venta ya ha sido pagada.");
        }
    }

}
