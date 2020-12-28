<?php

namespace Modules\Warehouse\Services\WhProduct;

use Modules\Warehouse\Http\Requests\WhProduct\CreateWhProductRequest;
use Modules\Warehouse\Entities\WhProduct;
use Modules\General\Entities\GBranchOffice;
use Modules\Sale\Entities\SlListPrice;
use Modules\Sale\Entities\SlDetailListPrice;
use Modules\Warehouse\Http\Requests\WhProduct\EditWhProductRequest;
use Modules\Warehouse\Entities\WhTagWhProduct;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Entities\WhProductUpcCode;


class CrudWhProductService
{

    /**
     * Store product (Item, Pack, Promo and Packing Service handle transactions)
     *
     * @param CreateWhProductRequest $request
     * @return array
     */
    public function store(CreateWhProductRequest $request)
    {
        $this->checkUniqueInternalCode($request->internal_code);
        $product = new WhProduct();
        $this->setProductParams($product, $request);
        $product->save();

        $this->saveUpcCodes($product, $request->upc_codes);
        $this->saveBranchOfficeData($product, $request->branch_office_data);

        if ( $request->has('tags') && $request->tags && count($request->tags) > 0 ) {
            $this->storeTags($product, $request->tags);
        }

        return $product;
    }

    /**
     * Update product (Item, Pack, Promo and Packing Service handle transactions)
     *
     * @param WhProduct $product
     * @param EditWhProductRequest $request
     * @return WhProduct
     */
    public function update(WhProduct $product, EditWhProductRequest $request)
    {
        $this->checkUniqueInternalCode($request->internal_code, $product->id);
        $this->setProductParams($product, $request);
        $product->save();

        $this->saveUpcCodes($product, $request->upc_codes);
        $this->saveBranchOfficeData($product, $request->branch_office_data);

        if ( $request->has('tags') && $request->tags && count($request->tags) > 0 ) {
            WhTagWhProduct::where('wh_product_id', $product->id)->delete();
            $this->storeTags($product, $request->tags);
        }


        return $product;
    }

    private function saveUpcCodes(WhProduct $product, $upc_codes = [])
    {
        if (!$upc_codes || !is_array($upc_codes))
            return false;
        // Elimina los que no están
        if ( count($upc_codes) > 0 ){
            WhProductUpcCode::where('wh_product_id', $product->id)->whereNotIn('upc_code', $upc_codes)->where('flag_delete', 0)->update(['flag_delete' => true]);
        }
        foreach($upc_codes as $upc)
        {
            $this->checkUniqueUPCcode($upc, $product->id);
            // Solo inserta si no está
            $productUpc = WhProductUpcCode::where('wh_product_id', $product->id)->where('upc_code', $upc)->where('flag_delete', 0)->first();
            if (!$productUpc) {
                $productUpc = new WhProductUpcCode();
                $productUpc->wh_product_id = $product->id;
                $productUpc->upc_code = $upc;
                $productUpc->flag_delete = false;
                $productUpc->save();
            }
        }
    }

    private function saveBranchOfficeData(WhProduct $product, $branchOfficeData)
    {
        foreach($branchOfficeData as $data)
        {
            $branchOfficeExists = GBranchOffice::where('id', $data['g_branch_office_id'])->where('flag_delete', 0)->count();
            if (!$branchOfficeExists) {
                throw new ValidationException("La sucursal (".$data['g_branch_office_id'].") no existe");
            }
            $this->checkStocks((float) $data['minimum_stock'], (float) $data['maximum_stock'], (float) $data['critical_stock']);
            $product->productDataBranchOffice()->sync([$data['g_branch_office_id'] => [
                'cost_price' => $data['cost_price'],
                'gains_margin' => $data['gains_margin'],
                'minimum_stock' => $data['minimum_stock'],
                'maximum_stock' => $data['maximum_stock'],
                'critical_stock' => $data['critical_stock']
            ]], false);

            $this->storeSalePrice($product, $data['sale_price'], $data['g_branch_office_id']);
        }
    }

    private function checkStocks($minimumStock, $maximumStock, $criticalStock)
    {
        if ($minimumStock > $maximumStock)
        {
            throw new ValidationException("El stock mínimo ($minimumStock) debe ser igual o menor al stock máximo ($maximumStock)");
        }
        if ($minimumStock > $criticalStock)
        {
            throw new ValidationException("El stock mínimo ($minimumStock) debe ser igual o menor al stock crítico ($criticalStock)");
        }
    }

    private function checkUniqueUPCcode($upc, $excludeId = null)
    {
        $count = 0;
        if ($excludeId != null) {
            $count = WhProductUpcCode::where('upc_code', $upc)->where('flag_delete', false)->where('wh_product_id', '!=', $excludeId)->count();
        } else {
            $count = WhProductUpcCode::where('upc_code', $upc)->where('flag_delete', false)->count();
        }
        if ($count > 0) {
            throw new ValidationException("El código UPC '$upc' ya ha sido tomado");
        }
    }

    private function checkUniqueInternalCode($internalCode, $excludeId = null)
    {
        $count = 0;
        if ($excludeId != null) {
            $count = WhProduct::where('internal_code', $internalCode)->where('flag_delete', false)->where('id', '!=', $excludeId)->count();
        } else {
            $count = WhProduct::where('internal_code', $internalCode)->where('flag_delete', false)->count();
        }
        if ($count > 0) {
            throw new ValidationException("El código Interno '$internalCode' ya ha sido tomado");
        }
    }

    private function setProductParams(&$product, $request)
    {
        $product->name = $request->name;
        $product->alias_name = $request->alias_name;
        $product->description = $request->description ? $request->description : '';
        $product->internal_code = $request->internal_code;
        $product->wh_subfamily_id = $request->wh_subfamily_id;
        $product->warranty_days = $request->warranty_days;
        $product->is_repackaged = $request->is_repackaged;
        $product->is_tax_free = $request->is_tax_free;
        $product->is_salable = $request->is_salable;
        $product->is_consumable = $request->is_consumable;
        $product->is_seasonal = $request->is_seasonal;
    }

    /**
     * Store tags
     *
     * $tags array: [1, 2, 3, ...]
     *
     * @param WhProduct $product
     * @param array $tags
     * @return void
     */
    private function storeTags($product, $tags)
    {
        $product->whTags()->attach($tags);
    }

    /**
     * Store product sale price on each branch office
     *
     * @param WhProduct $product
     * @param integer $salePrice
     * @return void
     */
    public function storeSalePrice($product, $salePrice, $branchOfficeId)
    {

        $listPrice = $this->getListPrice($branchOfficeId);
        if (!$listPrice) {
            $this->storeNewListPrice($branchOfficeId);
        }

        $detail = $this->getDetailListPrice($listPrice->id, $product->id);
        if (!$detail) {
            $detail = $this->newDetailListPrice($listPrice->id, $product->id);
        }
        $detail->sale_price = $salePrice;
        $detail->save();
    }

    private function getListPrice($branchOfficeId)
    {
        return SlListPrice::where('g_branch_office_id', $branchOfficeId)->where('is_active', true)->where('flag_delete', false)->first();
    }

    private function storeNewListPrice($branchOfficeId)
    {
        $listPrice = new SlListPrice();
        $listPrice->g_branch_office_id = $branchOfficeId;
        $listPrice->name = 'Lista de Precios';
        $listPrice->description = '';
        $listPrice->is_active = true;
        $listPrice->flag_delete = false;
        $listPrice->save();
        return $listPrice;
    }

    private function getDetailListPrice($idSlListPrice, $idWhProduct)
    {
        return SlDetailListPrice::where('sl_list_price_id', $idSlListPrice)
                            ->where('wh_product_id', $idWhProduct)
                            ->where('flag_delete',  false)
                            ->first();
    }

    private function newDetailListPrice($idSlListPrice, $idWhProduct)
    {
        $detail = new SlDetailListPrice();
        $detail->sl_list_price_id = $idSlListPrice;
        $detail->wh_product_id = $idWhProduct;
        $detail->flag_delete = false;
        return $detail;
    }

    public function checkProduct($idWhProduct) : WhProduct
    {
        $product = WhProduct::where('id', $idWhProduct)->where('flag_delete', false)->first();
        if (!$product) {
            throw new ValidationException("El producto ($idWhProduct) no existe");
        }
        return $product;
    }

}
