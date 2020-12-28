<?php

namespace Modules\Warehouse\Services\WhProduct;

use Modules\Warehouse\Entities\WhProduct;
use Modules\Warehouse\Entities\WhWarehouseItem;
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

        $warehousesItems = WhWarehouseItem::with('whWarehouse.gBranchOffice')->with('whItem.whProduct')->whereIn('wh_item_id', $itemIds)->get();

        $groupedWarehouseItems = $this->groupWarehouseItems($warehousesItems);
        $groupedWarehouseItems = $this->calculateLogicalStock($groupedWarehouseItems, $groupedItems);
        return $groupedWarehouseItems;
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
            $index = array_search($el['wh_warehouse']['g_branch_office_id'], array_column($groupedWarehouseItems, 'g_branch_office_id'));
            if ($index === false) {
                array_push($groupedWarehouseItems, [
                    'g_branch_office_id' => $el['wh_warehouse']['g_branch_office_id'],
                    'g_branch_office_address' => $el['wh_warehouse']['g_branch_office']['address'],
                    'wh_warehouses' => []
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
        $warehouseItemGroup = $groupedWarehouseItems[$index]['wh_warehouses'];
        $idx = array_search($warehouseItem['wh_warehouse_id'], array_column($warehouseItemGroup, 'wh_warehouse_id'));
        if ($idx === false) {
            array_push($groupedWarehouseItems[$index]['wh_warehouses'], [
                'wh_warehouse_id' => $warehouseItem['wh_warehouse_id'],
                'wh_warehouse_name' => $warehouseItem['wh_warehouse']['name'],
                'wh_items' => []
            ]);
            $idx = count($groupedWarehouseItems[$index]['wh_warehouses']) - 1;
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
        $warehouseItemGroup = $groupedWarehouseItems[$index]['wh_warehouses'][$idx];
        $idy = array_search($warehouseItem['wh_item_id'], array_column($warehouseItemGroup, 'wh_item_id'));
        if ($idy === false) {
            array_push($groupedWarehouseItems[$index]['wh_warehouses'][$idx]['wh_items'], [
                'wh_item_id' => $warehouseItem['wh_item_id'],
                'wh_item_name' => $warehouseItem['wh_item']['wh_product']['name'],
                'wh_item_stock' => floatval($warehouseItem['stock'])
            ]);
        }
        return $groupedWarehouseItems;
    }

    /**
     * Calculates logical stock of a product.
     *
     * @param array $groupedWarehouseItems
     * @param array $groupedItems
     * @return array
     */
    private function calculateLogicalStock($groupedWarehouseItems, $groupedItems) {
        $groupedItems = collect($groupedItems)->groupBy('item_id')->toArray();

        foreach($groupedWarehouseItems as $i => $branchOffice) {
            foreach($branchOffice['wh_warehouses'] as $j => $warehouse) {
                $stocks = [];
                foreach($warehouse['wh_items'] as $item) {
                    $quantity = $groupedItems[ $item['wh_item_id'] ][0]['item_quantity'];
                    $stock = (int) floor($item['wh_item_stock'] / $quantity);
                    array_push($stocks, $stock);
                }
                $logicalStock = count($groupedItems) === count($warehouse['wh_items']) ? min($stocks) : 0;
                $groupedWarehouseItems[$i]['wh_warehouses'][$j]['logical_stock'] = $logicalStock;
            }
        }
        return $groupedWarehouseItems;
    }


    
}
