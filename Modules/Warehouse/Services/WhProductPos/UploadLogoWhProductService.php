<?php

namespace Modules\Warehouse\Services\WhProductPos;

use Modules\Warehouse\Http\Requests\WhProductPos\UploadLogoWhProductRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Entities\WhProductPos;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class UploadLogoWhProductService
{

    /**
     * Product storage path
     */
    public const STORAGE_PATH = 'public/logo/product';

    /**
     * Upload product logo
     *
     * @param integer $idWhProduct
     * @param UploadLogoWhProductRequest $request
     * @return array
     */
    public function upload($idWhProduct, UploadLogoWhProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = WhProductPos::where('id', $idWhProduct)->where('flag_delete', false)->first();
            if (!$product) {
                throw new ValidationException("El producto ($idWhProduct) no existe");
            }
            // Remove previous photo
            $this->removePhoto($product->path_logo);
            // Set new photo
            $path = $request->file('logo')->store(self::STORAGE_PATH);
            $product->path_logo = Storage::url($path);
            $product->save();
            DB::commit();
            // Return product id and item id
            return CustomResponse::ok([
                'message' => 'Foto subida con éxito',
                'path' => $product->path_logo
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return CustomResponse::error($e);
        }
    }

    /**
     * Remove photo
     *
     * @param string $path
     * @return void
     */
    private function removePhoto($path)
    {
        $path = str_replace("/storage", "public", $path);
        $canRemoveFile = $path && Storage::exists($path);
        if ($canRemoveFile) {
            Storage::delete($path);
        }
    }

}
