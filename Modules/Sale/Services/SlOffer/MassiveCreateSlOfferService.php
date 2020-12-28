<?php

namespace Modules\Sale\Services\SlOffer;

use Illuminate\Http\Request;
use App\Http\Response\CustomResponse;
use Modules\Sale\Entities\SlOffer;

use DB;
class MassiveCreateSlOfferService
{
    /**
     * Massive create of SlOffer of WhProduct array (filter by GBranchOffice)
     * 
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function massiveCreateSlOffer(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $arrSlOfferActive_FromProducts = $this->getSlOfferActive_FromProducts($request->wh_products, $request->g_branch_office_id);
            $quantitySlOfferDeleted = $this->deleteSlOfferActive_FromProducts($arrSlOfferActive_FromProducts, $request->g_branch_office_id);
            $this->insertMassiveSlOffer_FromMassiveProductsRequest($request);

            DB::commit();

            return CustomResponse::created([
                'data' => array('quantitySlOfferDeleted' => $quantitySlOfferDeleted),
            ]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e);
        }

    } // end function

    /**
     * Get offer existing from wh_products array
     * 
     * @param array $arrProducts
     * @param int $gBranchOfficeId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getSlOfferActive_FromProducts($arrProducts, $gBranchOfficeId)
    {
        $whProductsIds = $this->getWhProductsIds_FromArrayMassiveProducts($arrProducts);
        foreach($arrProducts as $product) {
            $arrSlOfferActive_FromProducts = SlOffer::whereIn('wh_product_id', $whProductsIds)
                                                    ->where('g_branch_office_id', $gBranchOfficeId)
                                                    ->where('flag_delete', 0)
                                                    ->get();
        } // end foreach
        
        return $arrSlOfferActive_FromProducts;
    } // end function

    /**
     * Delete (soft delete) active offer from array of offers for specific GBranchOffice Id
     * 
     * @param Illuminate\Database\Eloquent\Collection $arrSlOfferActive_FromProducts
     * @param int $gBranchOfficeId
     * @return int
     */
    private function deleteSlOfferActive_FromProducts($arrSlOfferActive_FromProducts, $gBranchOfficeId)
    {
        return SlOffer::whereIn('id', $arrSlOfferActive_FromProducts->pluck('id'))
                      ->where('g_branch_office_id', $gBranchOfficeId)
                      ->update(['flag_delete' => true]);
    } // emd function

    /**
     * Get array of WhProducts Ids from massive Products array
     * 
     * @param array $arrProducts
     * @return array
     */
    private function getWhProductsIds_FromArrayMassiveProducts($arrProducts)
    {
        $arrProductsIds = [];
        foreach($arrProducts as $product) array_push($arrProductsIds, $product['id']);

        return $arrProductsIds;
    } // end function

    /**
     * Insert Massive SlOffer from Massive product requested by frontend
     * 
     * @param @param \Illuminate\Http\Request $request
     * @return int
     */
    private function insertMassiveSlOffer_FromMassiveProductsRequest($request)
    {
        $arrInsertArray = [];
        $gBranchOfficeId = $request->g_branch_office_id;
        $name = $request->name;
        $initDatetime = $request->init_datetime;
        $finishDatetime = $request->finish_datetime;
        $createdAt = date('Y-m-d');

        foreach($request->wh_products as $product) 
            $arrInsertArray[] = $this->setInsertArrayProduct($product, $gBranchOfficeId, $name, $initDatetime, $finishDatetime, $createdAt);

        return SlOffer::insert($arrInsertArray);
    } // end function


    /**
     * Set array of inset SlOffer of 1 WhProduct
     * 
     * @param array $product 
     * @param int $gBranchOffice 
     * @param date $initDatetime 
     * @param date $finishDatetime 
     * @return array 
     */
    private function setInsertArrayProduct($product, $gBranchOfficeId, $name, $initDatetime, $finishDatetime, $createdAt)
    {
        return [
            'wh_product_id' => $product['id'],
            'g_branch_office_id' => $gBranchOfficeId,
            'name' => $name,
            'offer_price' => $product['offer_price'],
            'init_datetime' => $initDatetime,
            'finish_datetime' => $finishDatetime,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    } // end function

} // end class