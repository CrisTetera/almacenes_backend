<?php

namespace Modules\Warehouse\Services\WhWarehouse;

use Modules\Warehouse\Services\WhProduct\ProductInventoryService;
use Modules\Warehouse\Entities\WhWarehouse;
use Modules\Warehouse\Entities\WhProduct;
use Modules\Warehouse\Entities\WhWarehouseItem;

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

    public function in(WhWarehouse $warehouse, WhProduct $product, float $quantity)
    {
        $this->move($warehouse, $product, $quantity);
    }

    public function out(WhWarehouse $warehouse, WhProduct $product, float $quantity)
    {
        $this->move($warehouse, $product, -1 * $quantity);
    }

    private function move(WhWarehouse $warehouse, WhProduct $product, float $quantity)
    {
        $groupedItems = $this->productInventoryService->getGroupedItems([ [ 'id' => $product->id, 'quantity' => $quantity ] ]);
        foreach($groupedItems as $item) // $item --> [item_id, item_name, item_quantity]
        {
            $warehouseItem = WhWarehouseItem::whereWhWarehouseId($warehouse->id)->whereWhItemId($item['item_id'])->whereFlagDelete(0)->first();
            if (!$warehouseItem)
            {
                $warehouseItem = new WhWarehouseItem();
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
