<?php

namespace Modules\Sale\Services\SlWholesaleDiscount;

use Modules\Sale\Entities\SlWholesaleDiscount;
use Dotenv\Exception\ValidationException;
use Modules\Sale\Http\Requests\SlWholesale\EditSlWholesaleDiscountRequest;
use Modules\Sale\Http\Requests\SlWholesale\CreateSlWholesaleDiscountRequest;
use Modules\Warehouse\Entities\WhProduct;


class CrudSlWholesaleDiscountService
{
    /**
     * Store many wholesale discount of a single product
     *
     * @param CreateSlWholesaleDiscountRequest $request
     * @return void
     */
    public function store(CreateSlWholesaleDiscountRequest $request)
    {
        return $this->insertWholesaleDiscounts($request);
    }

    private function insertWholesaleDiscounts($request)
    {
        $slWholesaleDiscounts = [];
        foreach( $request->discount_schema as $index => $schema )
        {
            $slWholesaleDiscount = $this->insertWholesaleDiscount($request, $schema);
            array_push($slWholesaleDiscounts, $slWholesaleDiscount);
        }
        return $slWholesaleDiscounts;
    }

    private function insertWholesaleDiscount($request, $schema)
    {
        // Se prioriza el percentage discount.
        $slWholesaleDiscount = new SlWholesaleDiscount();
        $this->setWholesaleDiscountParams($slWholesaleDiscount, $request, $schema);
        $slWholesaleDiscount->save();
        return $slWholesaleDiscount;
    }

    /**
     * Update a many wholesale discount of a single product
     *
     * @param integer $idSlWholesaleDiscount
     * @param EditSlWholesaleDiscountRequest $request
     * @return void
     */
    public function update($idProduct, EditSlWholesaleDiscountRequest $request)
    {
        $this->checkProduct($idProduct);
        SlWholesaleDiscount::where('wh_product_id', $idProduct)
                            ->where('g_branch_office_id', $request->g_branch_office_id)
                            ->update(['flag_delete' => true]);
        $slWholesaleDiscounts = [];
        if (isset($request['discount_schema']) && $request->discount_schema && count($request->discount_schema) > 0)
        {
            foreach( $request->discount_schema as $index => $schema )
            {
                $slWholesaleDiscount = new SlWholesaleDiscount();
                $slWholesaleDiscount->wh_product_id = $idProduct;
                $this->setWholesaleDiscountParams($slWholesaleDiscount, $request, $schema);
                $slWholesaleDiscount->save();
                array_push($slWholesaleDiscounts, $slWholesaleDiscount);
            }
        }

        return $slWholesaleDiscounts;
    }

    /**
     * Delete wholesale discount logically
     *
     * @param integer $idSlWholesaleDiscount
     * @return void
     */
    public function delete($idSlWholesaleDiscount)
    {
        $slWholesaleDiscount = $this->checkSlWholesaleDiscount($idSlWholesaleDiscount);
        $slWholesaleDiscount->flag_delete = true;
        $slWholesaleDiscount->save();
    }


    /**
     * Set params to wholesale discount
     *
     * @param SlWholesaleDiscount $slWholesaleDiscount
     * @param array $request
     * @param integer $index Index of the discount_schema[] of the request
     * @return void
     */
    private function setWholesaleDiscountParams(SlWholesaleDiscount $slWholesaleDiscount, $request, $schema)
    {
        if (isset($request['wh_product_id']) && $request->wh_product_id){
            $slWholesaleDiscount->wh_product_id = $request->wh_product_id;
        }
        $slWholesaleDiscount->g_branch_office_id = $request->g_branch_office_id;
        $slWholesaleDiscount->quantity_discount = $schema['quantity_discount'];
        $slWholesaleDiscount->percentage_discount = $schema['percentage_discount'];
        $slWholesaleDiscount->unit_price_discount = $schema['percentage_discount'] == 0 ? $schema['unit_price_discount'] : 0;
        $slWholesaleDiscount->flag_delete = false;
    }

    /**
     * Check if wholesale discount exists in database
     *
     * @param integer $idSlWholesaleDiscount
     * @return SlWholesaleDiscount
     */
    private function checkSlWholesaleDiscount($idSlWholesaleDiscount)
    {
        $slWholesaleDiscount = SlWholesaleDiscount::where('id', $idSlWholesaleDiscount)->where('flag_delete', false)->first();
        if (!$slWholesaleDiscount) {
            throw new ValidationException("El esquema ($idSlWholesaleDiscount) no existe");
        }
        return $slWholesaleDiscount;
    }

    private function checkProduct($idProduct)
    {
        $product = WhProduct::where('id', $idProduct)->where('flag_delete', false)->first();
        if (!$product) {
            throw new ValidationException("El producto ($idProduct) no existe");
        }
        return $product;
    }

}
