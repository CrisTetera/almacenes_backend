<?php

namespace Modules\Warehouse\Services\WhProductPos;

use Modules\Warehouse\Entities\WhItemPos;
use Modules\Warehouse\Entities\WhItemStockPos;
use Illuminate\Database\Eloquent\Collection;

class ProductStockService
{   

    private $productInventoryService;

    /**
     * Constructor
     *
     * @param ProductInventoryService $productInventoryService
     */
    public function __construct(ProductInventoryService $productInventoryService)
    {
        $this->productInventoryService = $productInventoryService;
    }

    /**
     * Get Stocks from simple product
     *
     * @param integer $productId
     * @return array
     */
    public function getStocks($productId) 
    {
        $groupedItems = $this->productInventoryService->getGroupedItems([['id' => $productId, 'quantity' => 1]]);
        $itemIds = array_column($groupedItems, 'item_id');

        // dump($groupedItems);
        $warehousesItems = WhItemStockPos::with('whItemPos.whProducts')->whereIn('wh_item_id', $itemIds)->get();
        
        // $groupedWarehouseItems = $this->groupWarehouseItems($warehousesItems);
        $groupedWarehouseItems = $this->calculateLogicalStock($warehousesItems, $groupedItems);
        
        return $groupedWarehouseItems;
    }

    /**
     * Get Stocks from simple product
     *
     * @param integer $productId
     * @return int
     */
    public function getStock($productId) 
    {
        $item = WhItemPos::where('wh_product_id',$productId)->where('flag_delete',false)->first();
        
        $itemStock = WhItemStockPos::where('wh_item_id',$item->id)->where('flag_delete',false)->first();
        //dump($itemStock->toArray());
        return $itemStock->stock;
    }  

    /**
     * Groups warehouses item by branch office and warehouse,
     * and calculates logic stock of a product.
     *
     * @param array $warehousesItems
     * @return array
     */
    private function groupWarehouseItems($warehousesItems) {
        $warehousesItems = $warehousesItems->toArray();
        $groupedWarehouseItems = [];
        foreach($warehousesItems as $el) {
            // Check branch office  
            $index = $el['wh_warehouse_id'];
            if ($index === false) {
                array_push($groupedWarehouseItems, [
                    'wh_warehouse_pos' => []
                ]);
                $index = count($groupedWarehouseItems) - 1;
            }    
            $groupedWarehouseItems = $this->addWarehouse($groupedWarehouseItems, $index, $el);
        }
        return $groupedWarehouseItems;
    }

    /**
     * Add warehouse item to grouped warehouse items.
     *
     * @param array $groupedWarehouseItems
     * @param integer $index
     * @param array $warehouseItem
     * @return array
     */
    private function addWarehouse($groupedWarehouseItems, $index, $warehouseItem) {
        $warehouseItemGroup = $groupedWarehouseItems[$index]['wh_warehouse_pos'];
        $idx = array_search($warehouseItem['wh_warehouse_id'], array_column($warehouseItemGroup, 'wh_warehouse_id'));
        if ($idx === false) {
            array_push($groupedWarehouseItems[$index]['wh_warehouse_pos'], [
                'wh_warehouse_id' => $warehouseItem['wh_warehouse_id'],
                'wh_warehouse_name' => $warehouseItem['wh_warehouse']['name'],
                'wh_items' => []
            ]);
            $idx = count($groupedWarehouseItems[$index]['wh_warehouse_pos']) - 1;
        }
        $groupedWarehouseItems = $this->addItem($groupedWarehouseItems, $index, $idx, $warehouseItem);
        return $groupedWarehouseItems;
    }

    /**
     * Add Item to grouped warehouse items
     *
     * @param array $groupedWarehouseItems
     * @param integer $index
     * @param integer $idx
     * @return void
     */
    private function addItem($groupedWarehouseItems, $index, $idx, $warehouseItem) {
        $warehouseItemGroup = $groupedWarehouseItems[$index]['wh_warehouse_pos'][$idx];
        $idy = array_search($warehouseItem['wh_item_id'], array_column($warehouseItemGroup, 'wh_item_id'));
        if ($idy === false) {
            array_push($groupedWarehouseItems[$index]['wh_warehouse_pos'][$idx]['wh_items'], [
                'wh_item_id' => $warehouseItem['wh_item_id'],
                'wh_item_name' => $warehouseItem['wh_item_id']['wh_product_id']['name'],
                'wh_item_stock' => floatval($warehouseItem['stock'])
            ]);
        }
        return $groupedWarehouseItems;
    }

    /**
     * Calculates logical stock of a product.
     *
     * @param array $warehousesItems
     * @param array $groupedItems
     * @return array
     */
    private function calculateLogicalStock($warehousesItems, $groupedItems) {
        $groupedItems = collect($groupedItems)->keyBy('item_id')->toArray();
        
        $stocks = [];
        foreach($warehousesItems as $item) {
            // dump($item);
            $quantity = $groupedItems[$item->wh_item_id]['item_quantity'];
            $stock = (int) floor($item->stock / $quantity);
            array_push($stocks, $stock);
            
        }
        if(count($stocks)==0) return 0;
        $logicalStock = count($groupedItems) === count($warehousesItems) ? min($stocks) : 0;

        // dump($logicalStock);
        return $logicalStock;
    }

}
