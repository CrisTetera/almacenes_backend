<?php

namespace Modules\Warehouse\Services\WhTagPos;

use Modules\Warehouse\Entities\WhTagPos;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Http\Requests\WhTagPos\EditTagRequest;
use Modules\Warehouse\Http\Requests\WhTagPos\CreateTagRequest;


class CrudWhTagService
{

        /**
     * Store new tag
     *
     * @param CreateTagRequest $request
     * @return void
     */
    public function store(CreateTagRequest $request)
    {
        try {
            DB::beginTransaction();
            $tag = new WhTagPos([
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
     * @param EditTagRequest $request
     * @return void
     */
    public function update($idWhTag, EditTagRequest $request)
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
     * @return WhTagPos
     */
    private function checkTag($idWhTag)
    {
        $tag = WhTagPos::where('id', $idWhTag)->where('flag_delete', false)->first();
        if (!$tag) {
            throw new ValidationException('El tag no existe');
        }
        return $tag;
    }

}
