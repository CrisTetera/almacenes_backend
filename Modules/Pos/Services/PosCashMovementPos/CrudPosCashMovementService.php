<?php

namespace Modules\Pos\Services\PosCashMovementPos;

use Illuminate\Http\Request;
use App\Http\Response\CustomResponse;
use Modules\Pos\Entities\PosCashDeskMovementPos;
use DB;

class CrudPosCashMovementService
{
    // FIXME: add comments
    public function __construct()
    {
        $this->exceptions = new ExceptionsPosCashMovementService();
    } // end function
    
    // FIXME: add comments
    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            if($this->exceptions->checkIsIngresOrEgressMovement($request->pos_movement_egress_type_id, 
                                                                $request->pos_movement_ingress_type_id))
            {
                $posCashMovement = new PosCashDeskMovementPos();
        
                //dump($request->pos_cash_desk_id);

                $posCashMovement->pos_cash_desk_id = $request->pos_cash_desk_id;
                $posCashMovement->pos_movement_egress_type_id = $request->pos_movement_egress_type_id;
                $posCashMovement->pos_movement_ingress_type_id = $request->pos_movement_ingress_type_id;
                $posCashMovement->g_user_id = $request->g_user_id;
                $posCashMovement->amount = $request->amount;
                $posCashMovement->observation = $request->observation;
                
                $posCashMovement->save();

                DB::commit();

                return CustomResponse::created([
                    'pos_cash_desk_movement_pos' => $posCashMovement,
                ]);
            } // end functon
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    }
} // end class