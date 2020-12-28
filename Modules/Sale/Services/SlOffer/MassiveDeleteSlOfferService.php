<?php

namespace Modules\Sale\Services\SlOffer;

use Illuminate\Http\Request;
use App\Http\Response\CustomResponse;
use Modules\Sale\Entities\SlOffer;

use DB;
class MassiveDeleteSlOfferService
{
    /**
     * Massive delete of SlOffer of sl_offer index array
     * 
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function massiveDeleteSlOffer(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach($request->sl_offers as $slOfferId) {
                SlOffer::where('id', $slOfferId)->update([
                    'flag_delete' => true,
                ]);
            } // end foreach

            DB::commit();

            return CustomResponse::ok();
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e);
        }
    } // end function
    
} // end class