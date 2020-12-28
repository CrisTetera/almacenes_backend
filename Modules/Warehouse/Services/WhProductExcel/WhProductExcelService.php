<?php

namespace Modules\Warehouse\Services\WhProductExcel;

use Illuminate\Http\Request;
use Excel;
use Modules\Warehouse\Entities\WhProductImport;
use Illuminate\Support\Facades\Input;
use Modules\Warehouse\Entities\WhItem;
use Modules\Warehouse\Entities\WhProduct;
use Modules\Warehouse\Entities\WhPack;
use Modules\Warehouse\Entities\WhPromo;
use Modules\Warehouse\Services\WhProduct\CrudWhProductService;
use Modules\Warehouse\Http\Requests\WhProduct\CreateWhProductRequest;
use Modules\Warehouse\Entities\WhWarehouseItem;
use Modules\Sale\Entities\SlWholesaleDiscount;


class WhProductExcelService
{
    /** @var CrudWhProductService $crudWhProductService */
    private $crudWhProductService;

    public function __construct(CrudWhProductService $crudWhProductService)
    {
        $this->crudWhProductService = $crudWhProductService;
    }

    /**
     * Almacena el excel en base de datos.
     * Por defecto se van a la sucursal de ID 1, y a la bodega de ID 1.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $items = Excel::toCollection(new WhProductImport, Input::file('file'));
        // For some reason i have to make two each
        $items->each(function($items_)
        {
            $items_->each(function($rowData, $key)
            {
                // Omite el header
                if ($key === 0)
                    return;
                $this->handleRow($rowData);
            });
        });
        $this->log("=======================================================================");
        $this->log("REMOVING TEST PRODUCTS LOGICALLY ...... (FLAG_DELETE = TRUE)");
        $this->removeOldProductsLogically();
    }

    private function log($message)
    {
        echo $message.'<br>';
    }

    private function handleRow($row)
    {
        $productType = $row[ WhProductExcelConstant::PRODUCT_TYPE ];
        $createWhProductRequest = $this->transformRowToProductRequest($row);
        $product = $this->saveProduct($createWhProductRequest);
        $this->saveWholesaleDiscount($product, $row);
        switch( $productType )
        {
            case WhProductExcelConstant::PRODUCT_TYPE_ITEM:
                $this->saveItem($product, $row);
                break;
            case WhProductExcelConstant::PRODUCT_TYPE_PACK:
                $this->savePack($product, $row);
                break;
            case WhProductExcelConstant::PRODUCT_TYPE_PROMO:
                $this->savePromo($product, $row);
                break;
        }
        $this->log("OK ....... Producto ".$row[WhProductExcelConstant::PRODUCT_NAME]);
    }

    /**
     * Transform row array to CreateWhProductRequest
     *
     * @param array $row
     * @return CreateWhProductRequest
     */
    private function transformRowToProductRequest($row)
    {
        $request = new CreateWhProductRequest();
        $request->merge([
            'name' => $row[ WhProductExcelConstant::PRODUCT_NAME ],
            'alias_name' => $row[ WhProductExcelConstant::PRODUCT_ALIAS ],
            'description' => $row[ WhProductExcelConstant::PRODUCT_DESCRIPTION ],
            'internal_code' => $row[ WhProductExcelConstant::INTERNAL_CODE ],
            'wh_subfamily_id' => 1,
            'warranty_days' => $row[ WhProductExcelConstant::PRODUCT_WARRANTY_DAYS ],
            'is_repackaged' => $row[ WhProductExcelConstant::PRODUCT_IS_REPACKAGED ],
            'is_tax_free' => $row[ WhProductExcelConstant::PRODUCT_IS_TAX_FREE ],
            'is_salable'=> $row[ WhProductExcelConstant::PRODUCT_IS_SALABLE ],
            'is_consumable' => $row[ WhProductExcelConstant::PRODUCT_IS_CONSUMABLE ],
            'is_seasonal' => $row[ WhProductExcelConstant::PRODUCT_IS_SEASONAL ],
            // Extra Product Data
            'tags' => [],
            'branch_office_data' => [
                [
                    'g_branch_office_id' => 1,
                    'cost_price' => $row[ WhProductExcelConstant::PRODUCT_COST_PRICE ],
                    'sale_price' => $row[ WhProductExcelConstant::PRODUCT_SALE_PRICE ],
                    'gains_margin' => 20,
                    'minimum_stock' => 10,
                    'maximum_stock' => 9999,
                    'critical_stock' => 100,
                ]
            ],
            'upc_codes' => [ $row[ WhProductExcelConstant::UPC_CODE ] ],
        ]);
        return $request;
    }

    /**
     * Save Product into database
     *
     * @param CreateWhProductRequest $request
     * @return WhProduct
     */
    private function saveProduct(CreateWhProductRequest $request)
    {
        return $this->crudWhProductService->store($request);
    }

    /**
     * Save Item into database
     *
     * @param WhProduct $product
     * @param array $row
     * @return WhItem
     */
    private function saveItem(WhProduct $product, $row)
    {
        // New Item
        $item = new WhItem();
        $item->wh_product_id = $product->id;
        $item->wh_unit_of_measurement_id = 1;
        $item->uom_quantity = 1;
        $item->is_inventoriable = true;
        $item->have_decimal_quantity = false;
        $item->flag_delete = false;
        $item->save();

        $product->wh_item_id = $item->id;
        $product->save();

        $this->saveItemInWarehouse($item, $row); // Warehouse ID: 1, Branch Office ID: 1

        return $item;
    }

    /**
     * Save Pack into database
     *
     * @param WhProduct $product
     * @param array $row
     * @return WhPack
     */
    private function savePack(WhProduct $product, $row)
    {
        $packData = explode(',', $row[ WhProductExcelConstant::PRODUCT_COMPOSITION ]);
        $prod = WhProduct::where('internal_code', $packData[1])->first();

        $pack = new WhPack();
        $pack->wh_product_id = $product->id;
        $pack->wh_item_id = $prod->wh_item_id;
        $pack->item_quantity = $packData[0];
        $pack->flag_delete = false;
        $pack->save();

        $product->wh_pack_id = $pack->id;
        $product->save();

        return $pack;
    }

    /**
     * Save Promo into database
     *
     * @param WhProduct $product
     * @param array $row
     * @return WhPromo
     */
    private function savePromo(WhProduct $product, $row)
    {
        $promo = new WhPromo();
        $promo->wh_product_id = $product->id;
        $promo->flag_delete = false;
        $promo->save();

        $product->wh_promo_id = $promo->id;
        $product->save();

        // Add products to promo
        $row = explode(',', $row[ WhProductExcelConstant::PRODUCT_COMPOSITION ]);
        foreach($row as $internal_code) {
            $prod = WhProduct::where('internal_code', $internal_code)->first();
            $promo->whProductsPromo()->attach([$promo['id'] => ['wh_product_id' => $prod['id']]]);
        }

        return $promo;
    }

    /**
     * Remove products logically (set flag_delete = false)
     *
     * @return void
     */
    private function removeOldProductsLogically()
    {
        $cant = 400;
        WhProduct::where('id', '<=', $cant)->update(['flag_delete' => true]);
    }

    /**
     * Save item in warehouse (default 1) in branch office 1
     *
     * @param integer $warehouseId
     * @param integer $branchOfficeId
     * @param WhItem $item
     * @param array $row
     * @return WhWarehouseItem
     */
    private function saveItemInWarehouse(WhItem $item, $row)
    {
        $warehouseItem = new WhWarehouseItem();
        $warehouseItem->wh_item_id = $item->id;
        $warehouseItem->wh_warehouse_id = 1;
        $warehouseItem->stock = $row[ WhProductExcelConstant::PRODUCT_STOCK ];
        $warehouseItem->flag_delete = false;
        $warehouseItem->save();
        return $warehouseItem;
    }

    private function saveWholesaleDiscount(WhProduct $product, $row)
    {
        $productWholesale = new SlWholesaleDiscount();
        $productWholesale->wh_product_id = $product->id;
        $productWholesale->g_branch_office_id = 1;
        $productWholesale->percentage_discount = $row[ WhProductExcelConstant::SCHEMA_DISCOUNT ];
        $productWholesale->quantity_discount = $row[ WhProductExcelConstant::SCHEMA_QUANTITY ];
        $productWholesale->unit_price_discount = 0;
        $productWholesale->flag_delete = false;
        $productWholesale->save();
        return $productWholesale;
    }

}
