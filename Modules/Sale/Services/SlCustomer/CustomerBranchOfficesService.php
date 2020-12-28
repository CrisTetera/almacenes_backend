<?php

namespace Modules\Sale\Services\SlCustomer;

use Modules\Sale\Entities\SlCustomer;
use Modules\Sale\Entities\SlCustomerBranchOffices;


class CustomerBranchOfficesService
{
    public function handleBranchOffices(SlCustomer $customer, $branchOffices = [])
    {
        foreach($branchOffices as $branchOffice)
        {
            $customerBranchOffice = new SlCustomerBranchOffices();
            $this->setCustomerBranchOfficeParams($customerBranchOffice, $customer, $branchOffice);
            $customerBranchOffice->save();
        }
    }

    public function handleUpdateBranchOffices(SlCustomer $customer, $branchOffices = [])
    {
        $foundedIds = [];
        foreach($branchOffices as $branchOffice)
        {
            // Si existe por comuna/dirección actualiza, si no inserta.
            $customerBranchOffice = $this->getCustomerBranchOffice($customer, $branchOffice);
            if (!$customerBranchOffice)
            {
                $customerBranchOffice = new SlCustomerBranchOffices();
            }
            $this->setCustomerBranchOfficeParams($customerBranchOffice, $customer, $branchOffice);
            $customerBranchOffice->save();
            array_push($foundedIds, $customerBranchOffice->id);
        }
        // Elimina los IDS inexistentes
        $this->removeNotFoundCustomerBranchOffices($customer, $foundedIds);
    }

    private function getCustomerBranchOffice(SlCustomer $customer, $branchOffice)
    {
        return SlCustomerBranchOffices::where('sl_customer_id', $customer->id)
                                        ->where('g_commune_id', $branchOffice['g_commune_id'])
                                        ->where('address', $branchOffice['address'])
                                        ->where('flag_delete', false)
                                        ->first();
    }

    private function removeNotFoundCustomerBranchOffices(SlCustomer $customer, $foundedIds = [])
    {
        SlCustomerBranchOffices::where('sl_customer_id', $customer->id)
                                ->whereNotIn('id', $foundedIds)
                                ->update(['flag_delete' => true]);
    }

    private function setCustomerBranchOfficeParams(SlCustomerBranchOffices $customerBranchOffice, SlCustomer $customer, $branchOffice)
    {
        $customerBranchOffice->sl_customer_id = $customer->id;
        $customerBranchOffice->address = $branchOffice['address'];
        $customerBranchOffice->phone = $branchOffice['phone'] ? $branchOffice['phone'] : '';
        $customerBranchOffice->email = $branchOffice['email'] ? $branchOffice['email'] : '';
        $customerBranchOffice->g_commune_id = isset($branchOffice['g_commune_id']) && $branchOffice['g_commune_id'] ? $branchOffice['g_commune_id'] : SlCustomerBranchOffices::DEFAULT_COMMUNE;
        $customerBranchOffice->default_branch_office = $branchOffice['default_branch_office'];
        $customerBranchOffice->flag_delete = false;
    }
}
