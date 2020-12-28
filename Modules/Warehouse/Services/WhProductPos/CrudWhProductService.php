<?php

namespace Modules\Warehouse\Services\WhProductPos;

use Modules\Warehouse\Http\Requests\WhProductPos\CreateProductRequest;
use Modules\Warehouse\Services\WhItemPos\CrudWhItemService;
use Modules\Warehouse\Entities\WhProductPos;
use Modules\Sale\Entities\SlPriceListPos;
use Modules\Warehouse\Http\Requests\WhProductPos\EditProductRequest;
use Modules\Warehouse\Entities\WhTagWhProductPos;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Entities\WhItemPos;
use Maatwebsite\Excel\Concerns\ToArray;
use Modules\Warehouse\Entities\WhItemStockPos;
use Modules\Warehouse\Services\WhPromoPos\CrudWhPromoService;
use Modules\Warehouse\Services\WhPackPos\CrudWhPackService;

class CrudWhProductService
{
    /** @var CrudWhItemService $crudWhItemService */
    private $crudWhItemService;
    /** @var CrudWhPromoService $crudWhPromoService */
    private $crudWhPromoService;
    /** @var CrudWhPackService $crudWhPackService */
    private $crudWhPackService;

    /**
     * Constructor
     *
     * @param CrudWhItemService $crudWhItemService
     * @param CrudWhPromoService $crudWhPromoService
     * @param CrudWhPackService $crudWhPackService
     */
    public function __construct(CrudWhItemService $crudWhItemService, 
                               CrudWhPromoService $crudWhPromoService, 
                               CrudWhPackService $crudWhPackService)
    {
        $this->crudWhItemService = $crudWhItemService;
        $this->crudWhPromoService = $crudWhPromoService;
        $this->crudWhPackService = $crudWhPackService;
    }
    /**
     * Store product (Item, Pack, Promo and Packing Service handle transactions)
     * $comp --> 1: Item, 2: Promo, 3: Pack 
     * @param CreateProductRequest $request
     * @return array
     */
    public function store(CreateProductRequest $request, $comp)
    {
        $this->checkUniqueUPCCode($request->upc);
        $product = new WhProductPos();
        $this->setProductParams($product, $request);
        $product->save();

        if($comp == 1){
            $this->storeItem($request, $product);
            $this->setItemStockPos($product, $request->stock);
        } else if($comp == 2){
            $this->storePromo($request,$product);
        } else {
            $this->storePack($request,$product);
        }

        $this->storePrice($product, $request->sale_price);

        if ( $request->has('tags') && $request->tags && count($request->tags) > 0 ) {
            $this->storeTags($product, $request->tags);
        }
        return 
        [
            'wh_product_id'=>$product->id,
            'wh_item_id'=>$product->wh_item_id,
            'wh_promo_id'=> $product->wh_promo_id,
            'wh_pack_id'=> $product->wh_pack_id
        ];
    }

    public function storeItem($request, $product){
        $item = $this->crudWhItemService->store($request,$product->id);
        $item->save();

        $product->wh_item_id = $item->id;
        $product->save();
    }

    public function storePromo($request, $product){
        $promo = $this->crudWhPromoService->store($request,$product->id);
        $promo->save();

        $product->wh_promo_id = $promo->id;
        $product->save();
    }

    public function storePack($request, $product){
        $pack = $this->crudWhPackService->store($request,$product->id);
        $pack->save();

        $product->wh_pack_id = $pack->id;
        $product->save();
    }
    /**
     * Update product (Item, Pack, Promo and Packing Service handle transactions)
     *
     * @param WhProductPos $product
     * @param EditProductRequest $request
     * @return WhProductPos
     */
    public function update(EditProductRequest $request, $wh_product_id)
    {
        $product = $this->checkProduct($wh_product_id);
        
        if($product->wh_item_id){
            $item = $this->crudWhItemService->checkIfItem($product);
            $this->updateItem($request,$product);
        }else if ($product->wh_promo_id){
            $promo = $this->crudWhPromoService->checkIfPromo($product);
            $this->updatePromo($request,$product);
        }else if ($product->wh_pack_id){
            $pack = $this->crudWhPackService->checkIfPack($product);
            $this->updatePack($request,$product);
        }

        $this->storePrice($product, $request->sale_price);


        if ( $request->has('tags') && $request->tags && count($request->tags) > 0 ) {
            WhTagWhProductPos::where('wh_product_id', $product->id)->delete();
            $this->storeTags($product, $request->tags);
        }
        return [
            'wh_product_id'=>$product->id,
            'wh_item_id'=> $product->wh_item_id,
            'wh_promo_id'=> $product->wh_promo_id,
            'wh_pack_id'=> $product->wh_pack_id
        ];
    }
    public function updateItem($request, $product){
        $item = $this->crudWhItemService->update($request,$product->id);
        $item->save();
        $this->setProductParams($product, $request);
        $product->wh_item_id = $item->id;
        $product->save();
        
        $this->setItemStockPos($product, $request->stock);
    }

    public function updatePromo($request, $product){
        $promo = $this->crudWhPromoService->update($request,$product->id);
        $promo->save();
        $this->setProductParams($product, $request);
        $product->wh_promo_id = $promo->id;
        $product->save();
    }
    public function updatePack($request, $product){
        $pack = $this->crudWhPackService->update($request,$product->id);
        $pack->save();
        $this->setProductParams($product, $request);
        $product->wh_pack_id = $pack->id;
        $product->save();
    }

    private function checkStocks()
    {
        
    }

    private function checkUniqueUPCcode($upc, $excludeId = null)
    {
        $count = 0;
        if ($excludeId != null) {
            $count = WhProductPos::where('upc', $upc)->where('flag_delete', false)->where('wh_product_id', '!=', $excludeId)->count();
        } else {
            $count = WhProductPos::where('upc', $upc)->where('flag_delete', false)->count();
        }
        if ($count > 0) {
            throw new ValidationException("El código UPC '$upc' ya ha sido tomado");
        }
    }

    private function setProductParams(&$product, $request)
    {
        $product->name = $request->name;
        $product->description  = $request->description ? $request->description : '';
        $product->wh_subfamily_id = $request->wh_subfamily_id;
        $product->path_logo = $request->path_logo ? $request->path_logo : '';
        $product->is_tax_free = $request->is_tax_free;
        $product->upc = $request->upc;
        $product->cost_price = $request->cost_price;
        $product->gains_margin = $request->gains_margin;
    }

    private function setItemStockPos(&$product, $stock){
        $itemStock = new WhItemStockPos();
        
        $itemStock->stock = $stock;
        $itemStock->wh_warehouse_id = 1;
        $itemStock->wh_item_id = $product->wh_item_id;
        $itemStock->flag_delete = false;
        $itemStock->save();

    }
    /**
     * Store tags
     *
     * $tags array: [1, 2, 3, ...]
     *
     * @param WhProductPos $product
     * @param array $tags
     * @return void
     */
    private function storeTags($product, $tags)
    {
        $product->whTags()->attach($tags);
    }

    /**
     * Store product sale price 
     *
     * @param WhProductPos $product
     * @param integer $salePrice
     * @return void
     */
    public function storePrice($product, $salePrice)
    {
        $detail = $this->getPriceList($product->id);
        if (!$detail) {
            $detail = $this->newPriceList($product->id);
        }
        $detail->sale_price = $salePrice;
        $detail->save();
    }

    private function getPriceList($idWhProduct)
    {
        return SlPriceListPos::where('wh_product_id', $idWhProduct)
                            ->where('flag_delete',  false)
                            ->first();
    }

    private function newPriceList($idWhProduct)
    {
        $detail = new SlPriceListPos();
        $detail->wh_product_id = $idWhProduct;
        $detail->flag_delete = false;
        return $detail;
    }

    public function checkProduct($idWhProduct) : WhProductPos
    {
        $product = WhProductPos::where('id', $idWhProduct)->where('flag_delete', false)->first();
        if (!$product) {
            throw new ValidationException("El producto ($idWhProduct) no existe");
        }else{
        }
        
        return $product;
    }

}
