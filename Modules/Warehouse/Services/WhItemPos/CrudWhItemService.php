<?php

namespace Modules\Warehouse\Services\WhItemPos;

use Modules\Warehouse\Http\Requests\WhItemPos\CreateItemRequest;
use Modules\Warehouse\Services\WhProductPos\CrudWhProductService;
use Modules\Warehouse\Entities\WhItemPos;
use Modules\Warehouse\Http\Requests\WhItemPos\EditItemRequest;
use Modules\Warehouse\Entities\WhProductPos;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Http\Requests\WhProductPos\CreateProductRequest;
use Modules\Warehouse\Http\Requests\WhProductPos\EditProductRequest;

class CrudWhItemService
{

    /** @var CrudWhProductService $crudWhProductService */
    private $crudWhProductPosService;

    /**
     * Constructor
     *
     * @param CrudWhProductService $crudWhProductService
     */
    public function __construct()
    {
        //$this->crudWhProductService = $crudWhProductService;
    }

    public function store(CreateProductRequest $request, $wh_product_id)
    {
        // Store item
        $item = new WhItemPos();
        $this->setItemParams($item, $wh_product_id, $request);
        $item->save();

        // Return item 
        return $item;
    }

    public function update(EditProductRequest $request, $wh_product_id)
    {
        $item =WhItemPos::where('wh_product_id', $wh_product_id)->first();
        $this->setItemParams($item, $wh_product_id, $request);
        $item->save();

        return $item;
    }

    public function checkIfItem(WhProductPos $product) : WhItemPos
    {
        if (!$product->wh_item_id) {
            //dump("El producto ($product->id) no es un Item");
            throw new ValidationException("El producto ($product->id) no es un Item");
        }
        return WhItemPos::where('id', $product->wh_item_id)->first();
    }

    private function setItemParams(WhItemPos &$item, $wh_product_id, $request)
    {
        $item->wh_product_id = $wh_product_id;
        $item->have_decimal_quantity = $request->have_decimal_quantity;
    }

}
