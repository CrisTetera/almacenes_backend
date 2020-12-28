<?php

namespace Modules\Sale\Services\SlWholesaleDiscount;

use Dotenv\Exception\ValidationException;
use Modules\Sale\Http\Requests\SlWholeSale\CreateSlWholesaleDiscountByFamilyRequest;
use Modules\Warehouse\Entities\WhFamily;
use Modules\Sale\Http\Requests\SlWholeSale\EditSlWholesaleDiscountByFamilyRequest;
use Modules\Sale\Entities\SlWholesaleDiscountFamily;


class CrudSlWholesaleDiscountByFamilyService
{
    public function store(CreateSlWholesaleDiscountByFamilyRequest $request)
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
        $slWholesaleDiscount = new SlWholesaleDiscountFamily();
        $this->setWholesaleDiscountParams($slWholesaleDiscount, $request, $schema);
        $slWholesaleDiscount->save();
        return $slWholesaleDiscount;
    }

    public function update($idFamily, EditSlWholesaleDiscountByFamilyRequest $request)
    {
        $this->checkFamily($idFamily);
        SlWholesaleDiscountFamily::where('wh_family_id', $idFamily)
                            ->where('g_branch_office_id', $request->g_branch_office_id)
                            ->update(['flag_delete' => true]);
        $slWholesaleDiscounts = [];
        if (isset($request['discount_schema']) && $request->discount_schema && count($request->discount_schema) > 0)
        {
            foreach( $request->discount_schema as $schema )
            {
                $slWholesaleDiscount = new SlWholesaleDiscountFamily();
                $slWholesaleDiscount->wh_family_id = $idFamily;
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
     * @param SlWholesaleDiscountFamily $slWholesaleDiscount
     * @param array $request
     * @param integer $index Index of the discount_schema[] of the request
     * @return void
     */
    private function setWholesaleDiscountParams(SlWholesaleDiscountFamily $slWholesaleDiscount, $request, $schema)
    {
        if (isset($request['wh_family_id']) && $request->wh_family_id){
            $slWholesaleDiscount->wh_family_id = $request->wh_family_id;
        }
        $slWholesaleDiscount->g_branch_office_id = $request->g_branch_office_id;
        $slWholesaleDiscount->quantity_discount = $schema['quantity_discount'];
        $slWholesaleDiscount->percentage_discount = $schema['percentage_discount'];
        $slWholesaleDiscount->flag_delete = false;
    }

    /**
     * Check if family exists in database
     *
     * @param integer $idFamily
     * @return WhFamily
     */
    private function checkFamily($idFamily)
    {
        $family = WhFamily::where('id', $idFamily)->where('flag_delete', false)->first();
        if (!$family) {
            throw new ValidationException('La familia no existe');
        }
        return $family;
    }
}
