<?php

namespace Modules\Warehouse\Services\WhSubfamily;

use Modules\Warehouse\Http\Requests\WhSubfamily\CreateWhSubfamilyRequest;
use Modules\Warehouse\Http\Requests\WhSubfamily\EditWhSubfamilyRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Entities\WhSubfamily;
use Dotenv\Exception\ValidationException;


class CrudWhSubfamilyService
{

    /**
     * Store new Subfamily
     *
     * @param CreateWhSubfamilyRequest $request
     * @return void
     */
    public function store(CreateWhSubfamilyRequest $request)
    {
        try {
            DB::beginTransaction();
            $subFamily = new WhSubfamily([
                'wh_family_id' => $request->wh_family_id,
                'subfamily' => $request->subfamily,
                'flag_delete' => false
            ]);
            $subFamily->save();
            DB::commit();
            return CustomResponse::created(['subfamily_id' => $subFamily->id]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar guardar la familia']);
        }
    }

    /**
     * Update new Subfamily
     *
     * @param integer $idWhSubfamily
     * @param EditWhSubfamilyRequest $request
     * @return void
     */
    public function update($idWhSubfamily, EditWhSubfamilyRequest $request)
    {
        try {
            DB::beginTransaction();
            $subFamily = $this->checkSubfamily($idWhSubfamily);
            $subFamily->wh_family_id = $request->wh_family_id;
            $subFamily->subfamily = $request->subfamily;
            $subFamily->save();
            DB::commit();
            return CustomResponse::ok(['subfamily_id' => $subFamily->id]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar actualizar la familia']);
        }
    }

    /**
     * Delete subfamily logically
     *
     * @param integer $idWhSubfamily
     * @return void
     */
    public function delete($idWhSubfamily)
    {
        try {
            DB::beginTransaction();
            $subFamily = $this->checkSubfamily($idWhSubfamily);
            $subFamily->flag_delete = true;
            $subFamily->save();
            DB::commit();
            return CustomResponse::ok(['subfamily_id' => $subFamily->id]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar eliminar la subfamilia']);
        }
    }

    /**
     * Check if subfamily exists in database
     *
     * @param integer $idWhSubfamily
     * @return WhSubfamily
     */
    private function checkSubfamily($idWhSubfamily)
    {
        $subFamily = WhSubfamily::where('id', $idWhSubfamily)->where('flag_delete', false)->first();
        if (!$subFamily) {
            throw new ValidationException('La subfamilia no existe');
        }
        return $subFamily;
    }


}
