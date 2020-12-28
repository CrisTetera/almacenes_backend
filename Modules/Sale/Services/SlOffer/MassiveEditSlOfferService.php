<?php

namespace Modules\Sale\Services\SlOffer;

use Illuminate\Http\Request;
use App\Http\Response\CustomResponse;
use Modules\Sale\Entities\SlOffer;

use DB;

class MassiveEditSlOfferService
{
    /**
     * Massive edit of SlOffer array
     * 
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function massiveEditSlOffer(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach($request->sl_offers as $slOffer) {                
                SlOffer::where('id', $slOffer['id'])->update(
                    array_merge(
                        array(
                            'offer_price' => $slOffer['offer_price'],
                            'init_datetime' => $slOffer['init_datetime'],
                            'finish_datetime' => $slOffer['finish_datetime'],
                        ), 
                        ( // Name is optional parameter
                            isset($request->name) ? 
                            array('name' => $request->name) :
                            array()
                        )
                    )
                );
            } // end foreach

            DB::commit();

            return CustomResponse::ok();
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e);
        }
    } // end function

} // end class