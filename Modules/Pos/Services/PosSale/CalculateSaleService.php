<?php

namespace Modules\Pos\Services\PosSale;

use Modules\Warehouse\Entities\WhProduct;
use Illuminate\Http\Request;
use Modules\Pos\Services\PosSale\Entities\SaleData;

/**
 * @property Modules\Pos\Services\PosSale\Entities\SaleData $calculatesSaleData
 */
class CalculateSaleService
{

    public const IVA = 0.19;

    private $checkService;

    public function __construct(CheckPosSaleService $checkService)
    {
        $this->checkService = $checkService;
    }

    /**
     * Calculate the Sale Data
     *
     * Request structure:
     *
     * public $saleJSON = [
     *   "customer_id" => 1,
     *   'customer' => null,
     *   'sucursal_id' => 1,
     *   "pos_sale_type" => 1, //Ej: Boleta
     *   "global_discount" => 10, // En %
     *   "total" => 252, // Para validar los campos
     *   "sale_detail" => [
     *       [
     *           "product_id" => 1,
     *           "quantity" => 1,
     *           "price" => 100,
     *           "discount" => 10, // En %
     *           'discount_unit_price' => 0, // En monto
     *           'wh_warehouse_id' => 1
     *       ],
     *       [
     *           "product_id" => 2,
     *           "quantity" => 1,
     *           "price" => 200,
     *           "discount" => 0,
     *           'discount_unit_price' => 10, // En monto
     *           'wh_warehouse_id' => 1
     *       ]
     *   ]
     * ];
     *
     * @param \Illuminate\Http\Request $request
     * @return Modules\Pos\Services\PosSale\Entities\SaleData
     */
    public function calculateSaleData($request) {
        $saleData = new SaleData($request->sucursal_id, $request->customer_id, $request->pos_sale_type, $request->global_discount, $request->global_discount_amount);

        foreach( $request->sale_detail as $i => $detail ) {
            // Checks.
            $product = WhProduct::findOrFail($detail['product_id']);
            $this->checkService->checkProductIsSalable($product);
            $lineNumber = $i + 1;
            $saleData->attachDetailSaleData($detail['wh_warehouse_id'], $product->id, $detail['quantity'], $detail['price'], $product->isTaxFree, $detail['discount'], $detail['discount_unit_price'], $lineNumber);
        }

        $saleData->apply();

        return $saleData;
    }

}
