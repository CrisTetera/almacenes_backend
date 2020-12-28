<?php

namespace Modules\Warehouse\Services\WhSubfamilyWholesale;

use Modules\Sale\Entities\SlWholesaleRef;
use Modules\Sale\Entities\SlWholesaleDiscountFamily;
use Modules\Sale\Entities\SlWholesaleDiscountSubFamily;
use Modules\General\Entities\GBranchOffice;
use Modules\Warehouse\Entities\WhSubfamily;
use Modules\Warehouse\Entities\WhSubFamilyWholesaleRef;

class SubfamilyWholesaleDiscountService
{

    public function getWholesaleDiscount(WhSubfamily $subfamily)
    {
        $subFamilyId = $subfamily->id;
        $familyId = $subfamily->wh_family_id;
        $discounts = [];
        $whProductWholesaleRef = WhSubFamilyWholesaleRef::where('wh_subfamily_id', $subfamily->id)->get();
        if ( count($whProductWholesaleRef) > 0 )
        {
            $whProductWholesaleRef->each(function($ref) use (&$discounts, $subFamilyId, $familyId) {
                $this->handleReference($ref, $discounts, $subFamilyId, $familyId);
            });
        } else
        {
            $branchOffices = GBranchOffice::where('flag_delete', 0)->get();
            $branchOffices->each(function($branchOffice) use (&$discounts,$subFamilyId, $familyId) {
                $ref = new WhSubFamilyWholesaleRef();
                $ref->wh_subfamily_id = $subFamilyId;
                $ref->g_branch_office_id = $branchOffice->id;
                $discounts = array_merge($discounts, $this->getWholesaleDefault($ref, $subFamilyId, $familyId));
            });
        }
        return $discounts;
    }

    private function handleReference(WhSubFamilyWholesaleRef $ref, &$discounts, $subFamilyId, $familyId)
    {
        switch($ref->sl_wholesale_ref_id)
        {
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

    private function getWholesaleFamily(WhSubFamilyWholesaleRef $ref, $familyId)
    {
        return SlWholesaleDiscountFamily::where('wh_family_id', $familyId)
                                    ->where('g_branch_office_id', $ref->g_branch_office_id)
                                    ->where('flag_delete', false)
                                    ->get()
                                    ->toArray();
    }

    private function getWholesaleSubFamily(WhSubFamilyWholesaleRef $ref, $subFamilyId, $familyId)
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

    private function getWholesaleDefault(WhSubFamilyWholesaleRef $ref, $subFamilyId, $familyId)
    {
        $discounts = $this->getWholesaleSubFamily($ref, $subFamilyId, $familyId);
        if ( count($discounts) === 0 )
        {
            $discounts = $this->getWholesaleFamily($ref, $familyId);
        }
        return $discounts;
    }

}
