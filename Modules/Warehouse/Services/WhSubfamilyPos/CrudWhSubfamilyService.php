<?php

namespace Modules\Warehouse\Services\WhSubfamilyPos;

use Modules\Warehouse\Http\Requests\WhSubfamilyPos\CreateSubfamilyRequest;
use Modules\Warehouse\Http\Requests\WhSubfamilyPos\EditSubfamilyRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Entities\WhSubfamilyPos;
use Dotenv\Exception\ValidationException;


class CrudWhSubfamilyService
{

    /**
     * Store new Subfamily
     *
     * @param CreateSubfamilyRequest $request
     * @return void
     */
    public function store(CreateSubfamilyRequest $request)
    {
        try {
            DB::beginTransaction();
            $subFamily = new WhSubfamilyPos([
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
     * @param EditSubfamilyRequest $request
     * @return void
     */
    public function update($idWhSubfamily, EditSubfamilyRequest $request)
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
     * @return WhSubfamilyPos
     */
    private function checkSubfamily($idWhSubfamily)
    {
        $subFamily = WhSubfamilyPos::where('id', $idWhSubfamily)->where('flag_delete', false)->first();
        if (!$subFamily) {
            throw new ValidationException('La subfamilia no existe');
        }
        return $subFamily;
    }


}
