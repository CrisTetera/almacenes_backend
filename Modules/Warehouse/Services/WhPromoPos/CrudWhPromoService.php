<?php

namespace Modules\Warehouse\Services\WhPromoPos;

use Illuminate\Support\Facades\DB;
use Modules\Warehouse\Entities\WhProductPos;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Entities\WhPromoPos;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Http\Requests\WhPromoPos\CreatePromoRequest;
use Modules\Warehouse\Http\Requests\WhPromoPos\EditPromoRequest;
use Modules\Warehouse\Services\WhProductPos\CrudWhProductService;
use Modules\Warehouse\Entities\WhProductsOnPromoPos;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Modules\Warehouse\Http\Requests\WhProductPos\CreateProductRequest;
use Modules\Warehouse\Http\Requests\WhProductPos\EditProductRequest;

class CrudWhPromoService
{
    

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        // $this->crudWhProductService = $crudWhProductService;
    }

    public function store(CreateProductRequest $request, $productId)
    {
        // $product = $this->crudWhProductService->store($request);
        $product = WhProductPos::where('id',$productId)->where('flag_delete',false)->first();
        $promo = new WhPromoPos();
        $promo->wh_product_id = $product->id;
        $promo->save();
        // $product->wh_promo_id = $promo->id;
        // $product->save();

        $this->storeProducts($promo, $request);

        return $promo;
    }

    public function update(EditProductRequest $request, $productId)
    {
        $product = WhProductPos::where('id',$productId)->where('flag_delete',false)->first();
        // $product = $this->crudWhProductService->update($request,$idWhProduct);

        $promo = $this->checkIfPromo($product);

        WhProductsOnPromoPos::where('wh_promo_id', $promo->id)->delete();
        $this->storeProducts($promo, $request);

        return $promo; 
        // [
        //     'wh_promo_id'=> $promo->id,
        //     'wh_product_id'=> $promo->wh_product_id,
        //     'flag_delete'=> $promo->flag_delete
        // ];
    }

    /**
     * Store products
     *
     * $products structure:
     * [
     *  [  'wh_product_id' => 1, 'quantity' => 1],
     *  ...
     * ]
     *
     * @param array $products
     * @return void
     */
    private function storeProducts(WhPromoPos $promo, $request)
    {
        foreach($request->products as $product)
        {
            $this->checkProductPromo($product['wh_product_id']);
            $promo->whProductsOnPromoPos()->attach([$product['wh_product_id'] => ['quantity' => $product['quantity']]]);
        }
    }

    public function checkIfPromo(WhProductPos $product)
    {
        if (!$product->wh_promo_id) {
            throw new ValidationException("El producto ($product->id) no es una Promo");
        }
        return WhPromoPos::where('id', $product->wh_promo_id)->first();
    }

    private function checkProductPromo($idWhProduct) {
        $product = $this->checkProduct($idWhProduct);
        if (!$product->wh_item_id && !$product->wh_pack_id) {
            throw new ValidationException("El producto ($idWhProduct) debe ser un Item o un Pack");
        }
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
