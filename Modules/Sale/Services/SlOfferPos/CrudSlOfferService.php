<?php

namespace Modules\Sale\Services\SlOfferPos;

use Modules\Sale\Http\Requests\SlOfferPos\CreateOfferRequest;
use Illuminate\Support\Facades\DB;
use Modules\Sale\Http\Requests\SlOfferPos\EditOfferRequest;
use App\Http\Response\CustomResponse;
use Modules\Sale\Entities\SlOfferPos;
use Dotenv\Exception\ValidationException;


class CrudSlOfferService
{

    /**
     * Store a sl offer of a single product
     *
     * @param CreateOfferRequest $request
     * @return void
     */
    public function store(CreateOfferRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->checkDatetimes(date('Y-m-d'), $request->init_datetime);
            $this->checkDatetimes($request->init_datetime, $request->finish_datetime);
            $quantitySlOfferDeleted = $this->deleteSlOfferActive_FromWhProduct(
                $request->wh_product_id
            );
            $slOffer = new SlOfferPos([
                'wh_product_id' => $request->wh_product_id,
                'name' => $request->name,
                'offer_price' => $request->offer_price,
                'init_datetime' => $request->init_datetime,
                'finish_datetime' => $request->finish_datetime,
                'flag_delete' => false
            ]);
            $slOffer->save();
            DB::commit();
            return CustomResponse::created([
                'offer_id' => $slOffer->id,
                'quantity_sl_offer_deleted' => $quantitySlOfferDeleted,
            ]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar guardar la oferta']);
        }
    }

    /**
     * Update a single wholesale sl offer
     *
     * @param integer $idSlOffer
     * @param EditOfferRequest $request
     * @return void
     */
    public function update($idSlOffer, EditOfferRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->checkDatetimes($request->init_datetime, $request->finish_datetime);
            $slOffer = $this->checkSlOffer($idSlOffer);
            $slOffer->wh_product_id = $request->wh_product_id;
            $slOffer->name = $request->name;
            $slOffer->offer_price = $request->offer_price;
            $slOffer->init_datetime = $request->init_datetime;
            $slOffer->finish_datetime = $request->finish_datetime;
            $slOffer->save();
            DB::commit();
            return CustomResponse::ok(['offer_id' => $slOffer->id]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar actualizar la oferta']);
        }
    }

    /**
     * Delete wholesale discount logically
     *
     * @param integer $idSlOffer
     * @return void
     */
    public function delete($idSlOffer)
    {
        try {
            DB::beginTransaction();
            $slOffer = $this->checkSlOffer($idSlOffer);
            $slOffer->flag_delete = true;
            $slOffer->save();
            DB::commit();
            return CustomResponse::ok(['offer_id' => $slOffer->id]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar eliminar la oferta']);
        }
    }

    /**
     * Delete (soft delete) active offer of wh_product in specific g_branch_office
     * 
     * @param int $whProductId
     * @param int $gBranchOfficeId
     * @return int
     */
    private function deleteSlOfferActive_FromWhProduct($whProductId)
    {
        return SlOfferPos::where('wh_product_id', $whProductId)
                      ->where('flag_delete', false)
                      ->update(['flag_delete' => true]);
    } // emd function

    /**
     * Check if sl offer exists in database
     *
     * @param integer $idSlOffer
     * @return SlOfferPos
     */
    private function checkSlOffer($idSlOffer)
    {
        $slOffer = SlOfferPos::where('id', $idSlOffer)->where('flag_delete', false)->first();
        if (!$slOffer) {
            throw new ValidationException('La oferta no existe');
        }
        return $slOffer;
    }

    /**
     * Check datetimes.
     *
     * finishDatetime must be after initDatetime
     *
     * @param string $initDatetime
     * @param string $finishDatetime
     * @return void
     */
    public function checkDatetimes($initDatetime, $finishDatetime)
    {
        if (strtotime($initDatetime) > strtotime($finishDatetime))
        {
            throw new ValidationException("La fecha '$finishDatetime' debe ser igual o posterior a la fecha '$initDatetime'");
        }
    }

}
