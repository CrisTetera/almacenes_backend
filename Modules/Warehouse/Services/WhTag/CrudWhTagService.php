<?php

namespace Modules\Warehouse\Services\WhTag;

use Modules\Warehouse\Entities\WhTag;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Http\Requests\WhTag\EditWhTagRequest;
use Modules\Warehouse\Http\Requests\WhTag\CreateWhTagRequest;


class CrudWhTagService
{

        /**
     * Store new tag
     *
     * @param CreateWhTagRequest $request
     * @return void
     */
    public function store(CreateWhTagRequest $request)
    {
        try {
            DB::beginTransaction();
            $tag = new WhTag([
                'tag' => $request->tag,
                'description' => $request->description ? $request->description : ''
            ]);
            $tag->save();
            DB::commit();
            return CustomResponse::created(['tag_id' => $tag->id]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar guardar el tag']);
        }
    }

    /**
     * Update tag
     *
     * @param integer $idWhTag
     * @param EditWhTagRequest $request
     * @return void
     */
    public function update($idWhTag, EditWhTagRequest $request)
    {
        try {
            DB::beginTransaction();
            $tag = $this->checkTag($idWhTag);
            $tag->tag = $request->tag;
            $tag->description = $request->description ? $request->description : '';
            $tag->save();
            DB::commit();
            return CustomResponse::ok(['tag_id' => $tag->id]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar actualizar el tag']);
        }
    }

    /**
     * Delete family logically
     *
     * @param integer $idWhTag
     * @return void
     */
    public function delete($idWhTag)
    {
        try {
            DB::beginTransaction();
            $tag = $this->checkTag($idWhTag);
            $tag->flag_delete = true;
            $tag->save();
            DB::commit();
            return CustomResponse::ok(['tag_id' => $tag->id]);
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e, ['user_message' => 'Ocurrió un error al intentar eliminar el tag']);
        }
    }

    /**
     * Check if tag exists in database
     *
     * @param integer $idWhTag
     * @return WhTag
     */
    private function checkTag($idWhTag)
    {
        $tag = WhTag::where('id', $idWhTag)->where('flag_delete', false)->first();
        if (!$tag) {
            throw new ValidationException('El tag no existe');
        }
        return $tag;
    }

}
