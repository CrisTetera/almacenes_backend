<?php

namespace Modules\Sale\Services\SlWholesaleDiscount;

use Dotenv\Exception\ValidationException;
use Modules\Warehouse\Entities\WhFamily;
use Modules\Sale\Http\Requests\SlWholeSale\CreateSlWholesaleDiscountBySubFamilyRequest;
use Modules\Sale\Http\Requests\SlWholeSale\EditSlWholesaleDiscountBySubFamilyRequest;
use Modules\Sale\Entities\SlWholesaleDiscountSubFamily;
use Modules\Warehouse\Entities\WhSubfamily;


class CrudSlWholesaleDiscountBySubFamilyService
{
    public function store(CreateSlWholesaleDiscountBySubFamilyRequest $request)
    {
        return $this->insertWholesaleDiscounts($request);
    }

    private function insertWholesaleDiscounts($request)
    {
        $slWholesaleDiscounts = [];
        foreach( $request->discount_schema as $schema )
        {
            $slWholesaleDiscount = $this->insertWholesaleDiscount($request, $schema);
            array_push($slWholesaleDiscounts, $slWholesaleDiscount);
        }
        return $slWholesaleDiscounts;
    }

    private function insertWholesaleDiscount($request, $schema)
    {
        $slWholesaleDiscount = new SlWholesaleDiscountSubFamily();
        $this->setWholesaleDiscountParams($slWholesaleDiscount, $request, $schema);
        $slWholesaleDiscount->save();
        return $slWholesaleDiscount;
    }

    public function update($idSubFamily, EditSlWholesaleDiscountBySubFamilyRequest $request)
    {
        $this->checkSubFamily($idSubFamily);
        SlWholesaleDiscountSubFamily::where('wh_subfamily_id', $idSubFamily)
                            ->where('g_branch_office_id', $request->g_branch_office_id)
                            ->update(['flag_delete' => true]);
        $slWholesaleDiscounts = [];
        if (isset($request['discount_schema']) && $request->discount_schema && count($request->discount_schema) > 0)
        {
            foreach( $request->discount_schema as $schema )
            {
                $slWholesaleDiscount = new SlWholesaleDiscountSubFamily();
                $slWholesaleDiscount->wh_subfamily_id = $idSubFamily;
                $this->setWholesaleDiscountParams($slWholesaleDiscount, $request, $schema);
                $slWholesaleDiscount->save();
                array_push($slWholesaleDiscounts, $slWholesaleDiscount);
            }
        }

        return $slWholesaleDiscounts;
    }

    /**
     * Set params to wholesale discount
     *
     * @param SlWholesaleDiscountSubFamily $slWholesaleDiscount
     * @param array $request
     * @param integer $index Index of the discount_schema[] of the request
     * @return void
     */
    private function setWholesaleDiscountParams(SlWholesaleDiscountSubFamily $slWholesaleDiscount, $request, $schema)
    {
        if (isset($request['wh_subfamily_id']) && $request->wh_subfamily_id){
            $slWholesaleDiscount->wh_subfamily_id = $request->wh_subfamily_id;
        }
        $slWholesaleDiscount->g_branch_office_id = $request->g_branch_office_id;
        $slWholesaleDiscount->quantity_discount = $schema['quantity_discount'];
        $slWholesaleDiscount->percentage_discount = $schema['percentage_discount'];
        $slWholesaleDiscount->flag_delete = false;
    }

    /**
     * Check if subfamily exists in database
     *
     * @param integer $idSubFamily
     * @return WhSubfamily
     */
    private function checkSubFamily($idSubFamily)
    {
        $subfamily = WhSubfamily::where('id', $idSubFamily)->where('flag_delete', false)->first();
        if (!$subfamily) {
            throw new ValidationException('La subfamilia no existe');
        }
        return $subfamily;
    }
}
