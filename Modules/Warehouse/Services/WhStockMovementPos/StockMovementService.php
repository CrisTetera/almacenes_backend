<?php

namespace Modules\Warehouse\Services\WhStockMovementPos;

use Modules\Warehouse\Entities\WhProductPos;
use Modules\Warehouse\Services\WhProductPos\ProductInventoryService;
use Modules\Warehouse\Entities\WhStockMovementPos;
use Modules\Warehouse\Entities\WhWarehousePos;

class StockMovementService
{
    /** @var ProductInventoryService $productInventoryService */
    private $productInventoryService;

    public function __construct(
        ProductInventoryService $productInventoryService
    )
    {
        $this->productInventoryService = $productInventoryService;
    }

    public function inStoreTransferMovement(WhWarehousePos $warehouse, WhProductPos $product, float $quantity)
    {
        $this->move($warehouse, $product, $quantity);
    }

    public function outStoreTransferMovement(WhWarehousePos $warehouse, WhProductPos $product, float $quantity)
    {
        $this->move($warehouse, $product, -1 * $quantity);
    }

    private function move(WhWarehousePos $warehouse, WhProductPos $product, float $quantity)
    {
        $groupedItems = $this->productInventoryService->getGroupedItems([ ['id' => $product->id, 'quantity' => $quantity] ]);
        foreach($groupedItems as $item) // $item --> [item_id, item_name, item_quantity]
        {
            $stockMovement = new WhStockMovementPos();
            $stockMovement->wh_warehouse_id = $warehouse->id;
            $stockMovement->wh_product_id = $product->id;
            $stockMovement->wh_item_id = $item['item_id'];
            $stockMovement->quantity = $item['item_quantity'];
            $stockMovement->flag_delete = false;
            $stockMovement->save();
        }
    }
}
