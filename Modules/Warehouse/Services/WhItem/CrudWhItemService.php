<?php

namespace Modules\Warehouse\Services\WhItem;

use Modules\Warehouse\Http\Requests\WhItem\CreateWhItemRequest;
use Modules\Warehouse\Services\WhProduct\CrudWhProductService;
use Modules\Warehouse\Entities\WhItem;
use Modules\Warehouse\Http\Requests\WhItem\EditWhItemRequest;
use Modules\Warehouse\Entities\WhProduct;
use Dotenv\Exception\ValidationException;

class CrudWhItemService
{

    /** @var CrudWhProductService $crudWhProductService */
    private $crudWhProductService;

    /**
     * Constructor
     *
     * @param CrudWhProductService $crudWhProductService
     */
    public function __construct(CrudWhProductService $crudWhProductService)
    {
        $this->crudWhProductService = $crudWhProductService;
    }

    public function store(CreateWhItemRequest $request)
    {
        $product = $this->crudWhProductService->store($request);
        // Store item
        $item = new WhItem();
        $this->setItemParams($item, $request);
        $item->wh_product_id = $product->id;
        $item->save();
        $product->wh_item_id = $item->id;
        $product->save();
        // Return product id and item id
        return [
            'product_id' => $product->id,
            'item_id' => $item->id
        ];
    }

    public function update($idWhProduct, EditWhItemRequest $request)
    {
        $product = $this->crudWhProductService->checkProduct($idWhProduct);
        $product = $this->crudWhProductService->update($product, $request);

        $item = $this->checkIfItem($product);
        $this->setItemParams($item, $request);
        $item->save();

        return [
            'product_id' => $product->id,
            'item_id' => $item->id
        ];
    }

    private function checkIfItem(WhProduct $product)
    {
        if (!$product->wh_item_id) {
            throw new ValidationException("El producto ($product->id) no es un Item");
        }
        return WhItem::where('id', $product->wh_item_id)->first();
    }

    private function setItemParams(WhItem &$item, $request)
    {
        $item->wh_unit_of_measurement_id = $request->wh_unit_of_measurement_id;
        $item->uom_quantity = $request->uom_quantity;
        $item->is_inventoriable = $request->is_inventoriable;
        $item->have_decimal_quantity = $request->have_decimal_quantity;
    }

}
