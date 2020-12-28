<?php

namespace Modules\Warehouse\Services\WhStockMovement;

use Modules\Warehouse\Entities\WhProduct;
use Modules\Warehouse\Services\WhProduct\ProductInventoryService;
use Modules\Warehouse\Entities\WhStockMovement;
use Modules\Warehouse\Entities\WhWarehouseMovement;
use Modules\Warehouse\Entities\WhWarehouse;

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

    public function inStoreTransferMovement(WhWarehouse $warehouse, WhProduct $product, float $quantity)
    {
        $this->move($warehouse, $product, $quantity);
    }

    public function outStoreTransferMovement(WhWarehouse $warehouse, WhProduct $product, float $quantity)
    {
        $this->move($warehouse, $product, -1 * $quantity);
    }

    private function move(WhWarehouse $warehouse, WhProduct $product, float $quantity)
    {
        $groupedItems = $this->productInventoryService->getGroupedItems([ ['id' => $product->id, 'quantity' => $quantity] ]);
        foreach($groupedItems as $item) // $item --> [item_id, item_name, item_quantity]
        {
            $stockMovement = new WhStockMovement();
            $stockMovement->wh_warehouse_movement_id = WhWarehouseMovement::TRANSFER_BETWEEN_WAREHOUSE;
            $stockMovement->wh_warehouse_id = $warehouse->id;
            $stockMovement->wh_product_id = $product->id;
            $stockMovement->wh_item_id = $item['item_id'];
            $stockMovement->quantity = $item['item_quantity'];
            $stockMovement->flag_delete = false;
            $stockMovement->save();
        }
    }

}
