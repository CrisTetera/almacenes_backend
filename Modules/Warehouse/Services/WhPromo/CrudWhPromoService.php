<?php

namespace Modules\Warehouse\Services\WhPromo;

use Illuminate\Support\Facades\DB;
use Modules\Warehouse\Entities\WhProduct;
use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Entities\WhPromo;
use App\Http\Response\CustomResponse;
use Modules\Warehouse\Http\Requests\WhPromo\CreateWhPromoRequest;
use Modules\Warehouse\Http\Requests\WhPromo\EditWhPromoRequest;
use Modules\Warehouse\Services\WhProduct\CrudWhProductService;
use Modules\Warehouse\Entities\WhPromoWhProductPromo;
use Illuminate\Validation\ValidationException as LaravelValidationException;


class CrudWhPromoService
{
    /** @var CrudWhProductService $crudWhProductservice */
    private $crudWhProductservice;

    /**
     * Constructor
     *
     * @param CrudWhProductService $crudWhProductservice
     */
    public function __construct(CrudWhProductService $crudWhProductservice)
    {
        $this->crudWhProductservice = $crudWhProductservice;
    }

    public function store(CreateWhPromoRequest $request)
    {
        $product = $this->crudWhProductservice->store($request);

        $promo = new WhPromo();
        $promo->wh_product_id = $product->id;
        $promo->save();
        $product->wh_promo_id = $promo->id;
        $product->save();

        $this->storeProducts($promo, $request->products);

        return [
            'product_id' => $product->id,
            'promo_id' => $promo->id
        ];
    }

    public function update($idWhProduct, EditWhPromoRequest $request)
    {
        $product = $this->crudWhProductservice->checkProduct($idWhProduct);
        $product = $this->crudWhProductservice->update($product, $request);

        $promo = $this->checkIfPromo($product);

        WhPromoWhProductPromo::where('wh_promo_id', $promo->id)->delete();
        $this->storeProducts($promo, $request->products);

        return [
            'product_id' => $product->id,
            'promo_id' => $product->wh_promo_id
        ];
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
    private function storeProducts(WhPromo $promo, $products)
    {
        foreach($products as $product)
        {
            $this->checkProductPromo($product['wh_product_id']);
            $promo->whProductsPromo()->attach([$product['wh_product_id'] => ['quantity' => $product['quantity']]]);
        }
    }

    private function checkIfPromo(WhProduct $product)
    {
        if (!$product->wh_promo_id) {
            throw new ValidationException("El producto ($product->id) no es una Promo");
        }
        return WhPromo::where('id', $product->wh_promo_id)->first();
    }

    private function checkProductPromo($idWhProduct) {
        $product = $this->crudWhProductservice->checkProduct($idWhProduct);
        if (!$product->wh_item_id && !$product->wh_pack_id) {
            throw new ValidationException("El producto ($idWhProduct) debe ser un Item o un Pack");
        }
    }

}
