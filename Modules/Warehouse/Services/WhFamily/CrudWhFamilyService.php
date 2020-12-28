<?php

namespace Modules\Warehouse\Services\WhFamily;

use Modules\Warehouse\Http\Requests\WhFamily\CreateWhFamilyRequest;
use App\Http\Response\CustomResponse;
use Illuminate\Support\Facades\DB;
use Modules\Warehouse\Entities\WhFamily;
use Modules\Warehouse\Http\Requests\WhFamily\EditWhFamilyRequest;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Entities\WhSubfamily;


class CrudWhFamilyService
{
    /**
     * Store new Family
     *
     * @param CreateWhFamilyRequest $request
     * @return void
     */
    public function store(CreateWhFamilyRequest $request)
    {
        try {
            DB::beginTransaction();
            $family = new WhFamily([
                'family' => $request->family,
                'flag_delete' => false
            ]);
            $family->save();
            DB::commit();
            return CustomResponse::created(['family_id' => $family->id]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar guardar la familia']);
        }
    }

    /**
     * Update new Family
     *
     * @param integer $idWhFamily
     * @param EditWhFamilyRequest $request
     * @return void
     */
    public function update($idWhFamily, EditWhFamilyRequest $request)
    {
        try {
            DB::beginTransaction();
            $family = $this->checkFamily($idWhFamily);
            $family->family = $request->family;
            $family->save();
            DB::commit();
            return CustomResponse::ok(['family_id' => $family->id]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar actualizar la familia']);
        }
    }

    /**
     * Delete family logically
     *
     * @param integer $idWhFamily
     * @return void
     */
    public function delete($idWhFamily)
    {
        try {
            DB::beginTransaction();
            $family = $this->checkFamily($idWhFamily);
            $family->flag_delete = true;
            $family->save();
            // Delete subfamilys.
            WhSubfamily::where('wh_family_id', $family->id)->update(['flag_delete' => true]);
            DB::commit();
            return CustomResponse::ok(['family_id' => $family->id]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar eliminar la familia']);
        }
    }

    /**
     * Check if family exists in database
     *
     * @param integer $idWhFamily
     * @return WhFamily
     */
    private function checkFamily($idWhFamily)
    {
        $family = WhFamily::where('id', $idWhFamily)->where('flag_delete', false)->first();
        if (!$family) {
            throw new ValidationException('La familia no existe');
        }
        return $family;
    }

}
