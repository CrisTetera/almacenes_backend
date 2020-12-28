<?php

namespace Modules\Pos\Services\PosEmployeeSale;

use Illuminate\Support\Facades\DB;
use Modules\Warehouse\Services\WhProduct\ProductInventoryService;
use Modules\Pos\Entities\PosEmployeeSaleStockReservation;
use Modules\Warehouse\Entities\WhWarehouseItem;


class PosSaleEmployeeStockReservationService
{
    /**
     * Stores stock's reservation of a employee sale in database
     *
     * @param integer $posEmployeeSaleId
     * @param  Modules\Pos\Services\PosSale\Entities\DetailSaleData[] $saleDetails
     * @return void
     */
    public function storeStockReservation($posEmployeeSaleId, $saleDetails)
    {
        try
        {
            DB::beginTransaction();
            $productInventoryService = new ProductInventoryService();
            // Each product can have difference warehouses
            // that's why grouped items are per product

            /** @var DetailSaleData[] $saleDetails @var DetailSaleData $saleDetail  */
            foreach( $saleDetails as $i => $saleDetail) {
                $product = ['id' => $saleDetail->getProductId(), 'quantity' => $saleDetail->getQuantity()];
                $groupedItems = $productInventoryService->getGroupedItems([$product]);
                foreach( $groupedItems as $groupedItem ) {
                    $posSaleStockReservation = $this->newStockReservation($posEmployeeSaleId, $saleDetails[$i]->getWarehouseId(), $groupedItem['item_id'], $groupedItem['item_quantity']);
                    $posSaleStockReservation->save();

                    $this->decreaseStockQuantity($saleDetails[$i]->getWarehouseId(), $groupedItem['item_id'], $groupedItem['item_quantity']);
                }
            }

            DB::commit();
        } catch(\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Generates a new stock reservation of a employee sale
     *
     * @param integer $posEmployeeSaleId
     * @param integer $whWarehouseId
     * @param integer $whItemId
     * @param float $stock
     * @return PosSaleStockReservation
     */
    public function newStockReservation($posEmployeeSaleId, $whWarehouseId, $whItemId, $stock)
    {
        return new PosEmployeeSaleStockReservation([
            'pos_employee_sale_id' => $posEmployeeSaleId,
            'wh_warehouse_id' => $whWarehouseId,
            'wh_item_id' => $whItemId,
            'stock' => $stock
        ]);
    }

    /**
     * Decrease stock quantity for all products in a employee sale
     *
     * @param integer $warehouseId
     * @param integer $whItemId
     * @param integer $stock
     * @return void
     */
    public function decreaseStockQuantity($warehouseId, $whItemId, $stock) {
        $warehouseItem = WhWarehouseItem::where('wh_warehouse_id', $warehouseId)
                                        ->where('wh_item_id', $whItemId)
                                        ->where('flag_delete', false)
                                        ->firstOrFail();
        $warehouseItem['stock'] -= $stock;
        $warehouseItem->save();
    }
}
