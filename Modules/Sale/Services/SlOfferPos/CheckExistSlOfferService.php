<?php

namespace Modules\Sale\Services\SlOfferPos;

use App\Http\Response\CustomResponse;
use Modules\Sale\Entities\SlOfferPos;

class CheckExistSlOfferService
{
    /**
     * Check if exist SlOffer for WhProducts Requested (filtered by GBranchOffice
     * 
     * @param \Illuminate\Http\Request
     * @return array)
     */
    public function checkExistSlOffer($request)
    {
        try {
            $arrayIds_WhProduct = $request->wh_products;
            if(is_int($arrayIds_WhProduct)) $arrayIds_WhProduct = [$arrayIds_WhProduct]; // if integer, pass to array

            $arrWhProductNames_WithActiveSlOffer = $this->getWhProductsNames_WithActiveSlOffer($arrayIds_WhProduct); 

            if(count($arrWhProductNames_WithActiveSlOffer) > 0)
                $prepareResponse =  [ 
                    'check_exist_offer' => true, 
                    'list_products_with_sl_offer' => $arrWhProductNames_WithActiveSlOffer,
                ];
            else
                $prepareResponse =  [
                    'check_exist_offer' => false,
                ];

            return CustomResponse::ok([
                'data' => $prepareResponse,
            ]);
        } catch (Exception $e) {
            return CustomResponse::error($e);
        }
    } // end function

    /**
     * Check if whProducts IDs in array have a SlOffer active
     * 
     * @param array arrayIds_WhProduct
     * @return array
     */
    private function getWhProductsNames_WithActiveSlOffer($arrayIds_WhProduct)
    {
        $dToday = date('Y-m-d');
        $arrSlOfferFinded = SlOfferPos::whereIn('sl_offer_pos.id', $arrayIds_WhProduct)
                                   ->selectRaw('sl_offer_pos.*, wh_product_pos.name')
                                   ->join('wh_product_pos', 'sl_offer_pos.wh_product_id', 'wh_product_pos.id')                                   
                                   ->where('sl_offer_pos.init_datetime', '<=', $dToday)
                                   ->where('sl_offer_pos.finish_datetime', '>=', $dToday)
                                   ->where('sl_offer_pos.flag_delete', 0)
                                   ->get();

        return $arrSlOfferFinded->pluck('name', 'id');
    } // end function

} // end class