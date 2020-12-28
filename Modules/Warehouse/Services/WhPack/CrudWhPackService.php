<?php

namespace Modules\Warehouse\Services\WhPack;

use Modules\Warehouse\Entities\WhPack;
use Modules\Warehouse\Services\WhProduct\CrudWhProductService;
use Modules\Warehouse\Http\Requests\WhPack\CreateWhPackRequest;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Modules\Warehouse\Http\Requests\WhPromo\EditWhPromoRequest;
use Illuminate\Support\Facades\DB;
use Modules\Warehouse\Entities\WhProduct;
use App\Http\Response\CustomResponse;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Http\Requests\WhPack\EditWhPackRequest;

class CrudWhPackService
{
    /** @var CrudWhProductService $crudWhProductservice */
    private $crudWhProductservice;

    /**
     * Constructor
     *
     * @param CrudWhProductService $crudWhProductservice
     */
    public function __construct(CrudWhProductService $crudWhProductservice)
    {
        $this->crudWhProductservice = $crudWhProductservice;
    }

    public function store(CreateWhPackRequest $request)
    {
        $product = $this->crudWhProductservice->store($request);

        $pack = new WhPack();
        $this->setPackParams($pack, $request);
        $pack->wh_product_id = $product->id;
        $pack->save();
        $product->wh_pack_id = $pack->id;
        $product->save();

        return [
            'product_id' => $product->id,
            'pack_id' => $pack->id
        ];
    }

    public function update($idWhProduct, EditWhPackRequest $request)
    {
        $product = $this->crudWhProductservice->checkProduct($idWhProduct);
        $product = $this->crudWhProductservice->update($product, $request);

        $pack = $this->checkIfPack($product);
        $this->setPackParams($pack, $request);
        $pack->save();

        return [
            'product_id' => $product->id,
            'pack_id' => $pack->id
        ];
    }

    private function checkIfPack(WhProduct $product)
    {
        if (!$product->wh_pack_id) {
            throw new ValidationException("El producto ($idWhProduct) no es un Pack");
        }
        return WhPack::where('id', $product->wh_pack_id)->first();
    }

    private function setPackParams(WhPack &$pack, $request)
    {
        $pack->wh_item_id = $request->wh_item_id;
        $pack->item_quantity = $request->item_quantity;
    }
}
