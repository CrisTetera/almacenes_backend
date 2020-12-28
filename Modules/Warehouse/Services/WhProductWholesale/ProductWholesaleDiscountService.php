<?php

namespace Modules\Warehouse\Services\WhProductWholesale;

use Modules\Warehouse\Entities\WhProduct;
use Modules\Warehouse\Entities\WhProductWholesaleRef;
use Modules\Sale\Entities\SlWholesaleRef;
use Modules\Sale\Entities\SlWholesaleDiscount;
use Modules\Sale\Entities\SlWholesaleDiscountFamily;
use Modules\Sale\Entities\SlWholesaleDiscountSubFamily;
use Modules\General\Entities\GBranchOffice;

class ProductWholesaleDiscountService
{

    public function getWholesaleDiscount(WhProduct $product)
    {
        $subFamilyId = $product->wh_subfamily_id;
        $familyId = $product->whSubfamily->wh_family_id;
        $discounts = [];
        $whProductWholesaleRef = WhProductWholesaleRef::where('wh_product_id', $product->id)->get();
        if ( count($whProductWholesaleRef) > 0 )
        {
            $whProductWholesaleRef->each(function($ref) use (&$discounts, $subFamilyId, $familyId) {
                $this->handleReference($ref, $discounts, $subFamilyId, $familyId);
            });
        } else
        {
            $branchOffices = GBranchOffice::where('flag_delete', 0)->get();
            $branchOffices->each(function($branchOffice) use (&$discounts,$product, $subFamilyId, $familyId) {
                $ref = new WhProductWholesaleRef();
                $ref->wh_product_id = $product->id;
                $ref->g_branch_office_id = $branchOffice->id;
                $discounts = array_merge($discounts, $this->getWholesaleDefault($ref, $subFamilyId, $familyId));
            });
        }
        return $discounts;
    }

    private function handleReference(WhProductWholesaleRef $ref, &$discounts, $subFamilyId, $familyId)
    {
        switch($ref->sl_wholesale_ref_id)
        {
            case SlWholesaleRef::PRODUCT:
                $discounts = array_merge($discounts,
                    $this->getWholesaleProducts($ref)
                );
                break;
            case SlWholesaleRef::FAMILY:
                $discounts = array_merge($discounts,
                    $this->getWholesaleFamily($ref, $familyId)
                );
                break;
            case SlWholesaleRef::SUBFAMILY:
                $discounts = array_merge($discounts,
                    $this->getWholesaleSubFamily($ref, $subFamilyId, $familyId)
                );
                break;
        }
    }

    private function getWholesaleProducts(WhProductWholesaleRef $ref)
    {
        return SlWholesaleDiscount::where('wh_product_id', $ref->wh_product_id)
                                ->where('g_branch_office_id', $ref->g_branch_office_id)
                                ->where('flag_delete', false)
                                ->get()
                                ->toArray();
    }

    private function getWholesaleFamily(WhProductWholesaleRef $ref, $familyId)
    {
        return SlWholesaleDiscountFamily::where('wh_family_id', $familyId)
                                    ->where('g_branch_office_id', $ref->g_branch_office_id)
                                    ->where('flag_delete', false)
                                    ->get()
                                    ->toArray();
    }

    private function getWholesaleSubFamily(WhProductWholesaleRef $ref, $subFamilyId, $familyId)
    {
        $wholesaleSubfamily = SlWholesaleDiscountSubFamily::where('wh_subfamily_id', $subFamilyId)
                                                        ->where('g_branch_office_id', $ref->g_branch_office_id)
                                                        ->where('flag_delete', false)
                                                        ->get()
                                                        ->toArray();
        if (count($wholesaleSubfamily) === 0)
        {
            return $this->getWholesaleFamily($ref, $familyId);
        }
        return $wholesaleSubfamily;
    }

    private function getWholesaleDefault(WhProductWholesaleRef $ref, $subFamilyId, $familyId)
    {
        $discounts = $this->getWholesaleProducts($ref);
        if ( count($discounts) === 0 )
        {
            $discounts = $this->getWholesaleSubFamily($ref, $subFamilyId, $familyId);
            if ( count($discounts) === 0 )
            {
                $discounts = $this->getWholesaleFamily($ref, $familyId);
            }
        }
        return $discounts;
    }

}
