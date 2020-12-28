<?php

namespace Modules\Warehouse\Services\WhProduct;

use Modules\Warehouse\Http\Requests\WhProduct\MassiveMarginPriceProductRequest;
use Modules\Warehouse\Entities\WhProduct;


class MassiveMarginPriceProductService
{

    /** @var CrudWhProductService $crudWhProductService */
    private $crudWhProductService;

    public function __construct(
        CrudWhProductService $crudWhProductService
    )
    {
        $this->crudWhProductService = $crudWhProductService;
    }


     /**
      * Update gains margin and sale prices of products
      * $request structure:
      * {
      *    "g_branch_office_id": 1,
      *    "products" : [
      *        {
      *            "wh_product_id": 1,
      *            "gains_margin": 20,
      *            "sale_price": 200
      *        },
      *        {
      *            "wh_product_id": 2,
      *            "gains_margin": 15,
      *            "sale_price": 250
      *        }
      *    ]
      * }
      *
      * @param MassiveMarginPriceProductRequest $request
      * @return void
      */
    public function update(MassiveMarginPriceProductRequest $request)
    {
        foreach($request->products as $product)
        {
            $prod = WhProduct::find($product['wh_product_id']);
            $this->saveGainsMargin($prod, $request->g_branch_office_id, $product['gains_margin']);
            $this->crudWhProductService->storeSalePrice($prod, $product['sale_price'], $request->g_branch_office_id);
        }
    }

    /**
     * Save gains margin
     *
     * @param WhProduct $product
     * @param integer $branchOfficeId
     * @param integer $gainsMargin
     * @return void
     */
    private function saveGainsMargin(WhProduct $product, $branchOfficeId, $gainsMargin)
    {
        $product->productDataBranchOffice()->sync([$branchOfficeId => [
            'gains_margin' => $gainsMargin,
        ]], false);
    }

}
