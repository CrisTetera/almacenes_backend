<?php

namespace Modules\Pos\Services\PosSale;

use Modules\Warehouse\Services\WhProduct\ProductInventoryService;
use Modules\Warehouse\Entities\WhWarehouseItem;
use Modules\Pos\Entities\PosSaleStockReservation;
use Modules\Pos\Entities\PosSale;
use App\Http\Response\CustomResponse;
use Illuminate\Support\Facades\DB;
use Modules\Pos\Services\PosSale\Entities\DetailSaleData;


class StockReservationService
{


    /**
     * Stores stock's reservation of a sale in database
     *
     * @param integer $posSaleId
     * @param  Modules\Pos\Services\PosSale\Entities\DetailSaleData[] $saleDetails
     * @return void
     */
    public function storeStockReservation($posSaleId, $saleDetails)
    {
        DB::beginTransaction();
        try
        {
            $productInventoryService = new ProductInventoryService();
            // Each product can have difference warehouses
            // that's why grouped items are per product

            /** @var DetailSaleData[] $saleDetails @var DetailSaleData $saleDetail  */
            foreach( $saleDetails as $i => $saleDetail) {
                $product = ['id' => $saleDetail->getProductId(), 'quantity' => $saleDetail->getQuantity()];
                $groupedItems = $productInventoryService->getGroupedItems([$product]);
                foreach( $groupedItems as $groupedItem ) {
                    $posSaleStockReservation = $this->newStockReservation($posSaleId, $saleDetails[$i]->getWarehouseId(), $groupedItem['item_id'], $groupedItem['item_quantity']);
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
     * Generates a new stock reservation
     *
     * @param integer $posSaleId
     * @param integer $whWarehouseId
     * @param integer $whItemId
     * @param float $stock
     * @return PosSaleStockReservation
     */
    public function newStockReservation($posSaleId, $whWarehouseId, $whItemId, $stock)
    {
        return new PosSaleStockReservation([
            'pos_sale_id' => $posSaleId,
            'wh_warehouse_id' => $whWarehouseId,
            'wh_item_id' => $whItemId,
            'stock' => $stock
        ]);
    }

    /**
     * Decrease stock quantity for all products in a sale
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

?>
