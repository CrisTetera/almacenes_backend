<?php

namespace Modules\Warehouse\Services\WhPackPos;

use Modules\Warehouse\Entities\WhPackPos;
use Modules\Warehouse\Services\WhProductPos\CrudWhProductService;
use Modules\Warehouse\Http\Requests\WhPackPos\CreatePackRequest;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Modules\Warehouse\Http\Requests\WhPromoPos\EditPromoRequest;
use Illuminate\Support\Facades\DB;
use Modules\Warehouse\Entities\WhProductPos;
use App\Http\Response\CustomResponse;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Http\Requests\WhPackPos\EditPackRequest;
use Modules\Warehouse\Http\Requests\WhProductPos\EditProductRequest;
use Modules\Warehouse\Http\Requests\WhProductPos\CreateProductRequest;

class CrudWhPackService
{
    /**
     * Constructor
     *
     * 
     */
    public function __construct(/*CrudWhProductService $crudWhProductService*/)
    {
        // $this->crudWhProductService = $crudWhProductService;
    }

    public function store(CreateProductRequest $request, $productId)
    {
        $product = WhProductPos::where('id',$productId)->where('flag_delete',false)->first();
        $pack = new WhPackPos();
        $this->setPackParams($pack, $request);
        $pack->wh_product_id = $product->id;
        $pack->save();

        return $pack; 
        // [
        //     'wh_product_id' => $product->id,
        //     'wh_pack_id' => $pack->id
        // ];
    }

    public function update(EditProductRequest $request, $productId)
    {
        // $product = $this->crudWhProductService->checkProduct($idWhProduct);
        // $product = $this->crudWhProductService->update($product, $request);
        $product = WhProductPos::where('id',$productId)->where('flag_delete',false)->first();
        $pack = $this->checkIfPack($product);

        $this->setPackParams($pack, $request);
        $pack->save();

        return $pack; 
        // [
        //     'product_id' => $product->id,
        //     'pack_id' => $pack->id
        // ];
    }

    public function checkIfPack(WhProductPos $product)
    {
        if (!$product->wh_pack_id) {
            throw new ValidationException("El producto ($product->id) no es un Pack");
        }
        return WhPackPos::where('id', $product->wh_pack_id)->first();
    }

    private function setPackParams(WhPackPos &$pack, $request)
    {
        $pack->wh_item_id = $request->wh_item_id;
        $pack->item_quantity = $request->item_quantity;
    }
}
