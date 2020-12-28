<?php

namespace Modules\Warehouse\Services\WhWarehousePos;

use Modules\Warehouse\Services\WhProductPos\ProductInventoryService;
use Modules\Warehouse\Entities\WhWarehousePos;
use Modules\Warehouse\Entities\WhProductPos;
use Modules\Warehouse\Entities\WhItemStockPos;

class InOutWarehouseService
{
    /** @var ProductInventoryService $productInventoryService */
    private $productInventoryService;

    public function __construct(
        ProductInventoryService $productInventoryService
    )
    {
        $this->productInventoryService = $productInventoryService;
    }

    public function in(WhWarehousePos $warehouse, WhProductPos $product, float $quantity)
    {
        $this->move($warehouse, $product, $quantity);
    }

    public function out(WhWarehousePos $warehouse, WhProductPos $product, float $quantity)
    {
        $this->move($warehouse, $product, -1 * $quantity);
    }

    private function move(WhWarehousePos $warehouse, WhProductPos $product, float $quantity)
    {
        $groupedItems = $this->productInventoryService->getGroupedItems([ [ 'id' => $product->id, 'quantity' => $quantity ] ]);
        foreach($groupedItems as $item) // $item --> [item_id, item_name, item_quantity]
        {
            $warehouseItem = WhItemStockPos::whereWhWarehouseId($warehouse->id)->whereWhItemId($item['item_id'])->whereFlagDelete(0)->first();
            if (!$warehouseItem)
            {
                $warehouseItem = new WhItemStockPos();
                $warehouseItem->wh_warehouse_id = $warehouse->id;
                $warehouseItem->wh_item_id = $item['item_id'];
                $warehouseItem->stock = $item['item_quantity'];
                $warehouseItem->flag_delete = false;

            } else {
                $warehouseItem->stock += $item['item_quantity'];
            }
            $warehouseItem->save();
        }
    }

}
