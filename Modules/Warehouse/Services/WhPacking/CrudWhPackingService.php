<?php

namespace Modules\Warehouse\Services\WhPacking;

use Modules\Warehouse\Services\WhProduct\CrudWhProductService;
use Modules\Warehouse\Http\Requests\WhPacking\CreateWhPackingRequest;
use Illuminate\Support\Facades\DB;
use Modules\Warehouse\Entities\WhPacking;
use App\Http\Response\CustomResponse;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Modules\Warehouse\Http\Requests\WhPacking\EditWhPackingRequest;
use Modules\Warehouse\Entities\WhProduct;
use Dotenv\Exception\ValidationException;

class CrudwhPackingService
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

    public function store(CreateWhPackingRequest $request)
    {
        $product = $this->crudWhProductservice->store($request);

        $this->checkPackingContent($request->wh_product_content_id);

        $packing = new WhPacking();
        $this->setPackingParams($packing, $request);
        $packing->wh_product_id = $product->id;
        $packing->save();
        $product->wh_packing_id = $packing->id;
        $product->save();

        return [
            'product_id' => $product->id,
            'packing_id' => $packing->id
        ];
    }

    public function update($idWhProduct, EditWhPackingRequest $request)
    {
        $product = $this->crudWhProductservice->checkProduct($idWhProduct);
        $product = $this->crudWhProductservice->update($product, $request);

        $this->checkPackingContent($request->wh_product_content_id);

        $packing = $this->checkIfPacking($product);
        $packing = WhPacking::where('id', $product->wh_packing_id)->first();
        $this->setPackingParams($packing, $request);
        $packing->save();

        return [
            'product_id' => $product->id,
            'packing_id' => $packing->id
        ];
    }

    private function checkIfPacking(WhProduct $product)
    {
        if (!$product->wh_packing_id) {
            throw new ValidationException("El producto ($idWhProduct) no es un Empaquetado");
        }
        return WhPacking::where('id', $product->wh_packing_id)->first();
    }

    private function checkPackingContent($idWhProduct)
    {
        $productContent = WhProduct::where('id', $idWhProduct)->where('flag_delete', false)->first();
        if (!$productContent) {
            throw new ValidationException("No se encontró el producto contenido ($idWhProduct)");
        }
        if ($productContent->wh_packing_id) {
            throw new ValidationException("El producto a contener ($idWhProduct) debe ser un Item, Pack o Promo");
        }
        return $productContent;
    }

    private function setPackingParams(WhPacking &$pack, $request)
    {
        $pack->wh_product_content_id = $request->wh_product_content_id;
        $pack->quantity_product = $request->quantity_product;
    }
}
