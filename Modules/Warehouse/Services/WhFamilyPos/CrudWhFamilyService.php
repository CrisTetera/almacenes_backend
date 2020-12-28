<?php

namespace Modules\Warehouse\Services\WhFamilyPos;

use Modules\Warehouse\Http\Requests\WhFamilyPos\CreateFamilyRequest;
use App\Http\Response\CustomResponse;
use Illuminate\Support\Facades\DB;
use Modules\Warehouse\Entities\WhFamilyPos;
use Modules\Warehouse\Http\Requests\WhFamilyPos\EditFamilyRequest;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Entities\WhSubfamilyPos;


class CrudWhFamilyService
{
    /**
     * Store new Family
     *
     * @param CreateFamilyRequest $request
     * @return void
     */
    public function store(CreateFamilyRequest $request)
    {
        try {
            DB::beginTransaction();
            $family = new WhFamilyPos([
                'family' => $request->family,
                'flag_delete' => false
            ]);
            dump($family);
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
     * @param EditFamilyRequest $request
     * @return void
     */
    public function update($idWhFamily, EditFamilyRequest $request)
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
            WhSubfamilyPos::where('wh_family_id', $family->id)->update(['flag_delete' => true]);
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
     * @return WhFamilyPos
     */
    private function checkFamily($idWhFamily)
    {
        $family = WhFamilyPos::where('id', $idWhFamily)->where('flag_delete', false)->first();
        if (!$family) {
            throw new ValidationException('La familia no existe');
        }
        return $family;
    }

}