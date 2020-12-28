<?php

namespace Modules\Pos\Services\PosSalePos;

use Modules\Warehouse\Entities\WhProductPos;
use Illuminate\Http\Request;
use Modules\Pos\Services\PosSalePos\Entities\SaleData;

/**
 * @property Modules\Pos\Services\PosSalePos\Entities\SaleData $calculatesSaleData
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
     *   
     *  "customer_id" => 1,
     *  "pos_sale_type" => 1, //Ej: Boleta
     *  "global_discount_percentage" => 10, // En %
     *  "global_discount_amount" => 0, // En monto
     *  "total" => 252, // Para validar los campos
     *  "sale_detail" => [
     *       [
     *           "wh_product_id" => 1,
     *           "quantity" => 1,
     *           "price" => 100,
     *           "discount_percentage" => 10, // En %
     *           'discount_amount' => 0, // En monto
     *           'wh_warehouse_id' => 1
     *       ],
     *       [
     *           "wh_product_id" => 2,
     *           "quantity" => 1,
     *           "price" => 200,
     *           "discount_percentage" => 0, // En %
     *           'discount_amount' => 10, // En monto
     *           'wh_warehouse_id' => 1
     *       ]
     *   ]
     * ];
     *
     * @param \Illuminate\Http\Request $request
     * @return Modules\Pos\Services\PosSalePos\Entities\SaleData
     */
    public function calculateSaleData($request) {
        $saleData = new SaleData($request->customer_id, $request->pos_sale_type, $request->global_discount_percentage, $request->global_discount_amount);
        //$i = 0;
        foreach( $request->sale_detail as $i => $detail ) {
            // Checks.
            //dump($detail);
            $product = WhProductPos::findOrFail($detail['wh_product_id']);
            // dump($product);
            $lineNumber = $i + 1;
            $saleData->attachDetailSaleData($detail['wh_warehouse_id'], $product->id, $detail['quantity'], $detail['price'], $product->is_tax_free, $detail['discount_percentage'], $detail['discount_amount'], $lineNumber);
        }

        $saleData->apply();

        return $saleData;
    }

}
