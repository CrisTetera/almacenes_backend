<?php

namespace Modules\Hr\Services\HrEmployee;

use Modules\HR\Entities\HrEmployee;
use Modules\Sale\Entities\SlGroundSeller;
use Modules\Sale\Entities\SlCustomerGroundSeller;

class CrudGroundSellerService
{

    public function handleStoreGroundSeller(HrEmployee $employee, $request)
    {
        if ($this->hasToStoreGroundSeller($request))
        {
            $this->storeGroundSeller($employee);
        }
    }

    public function handleUpdateGroundSeller(HrEmployee $employee, $request)
    {
        if ($this->hasToStoreGroundSeller($request))
        {
            $this->storeGroundSeller($employee);
        }
        if ($this->hasToUpdateGroundSeller($request) && $this->existsGroundSeller($employee))
        {
            $this->updateGroundSeller($employee, $request->is_ground_seller);
        }
    }

    private function hasToStoreGroundSeller($request)
    {
        return isset($request['is_ground_seller']) && $request->is_ground_seller;
    }

    private function hasToUpdateGroundSeller($request)
    {
        return isset($request['is_ground_seller']);
    }

    private function existsGroundSeller(HrEmployee $employee)
    {
        return SlGroundSeller::where('hr_employee_id', $employee->id)->first() != null;
    }

    private function storeGroundSeller(HrEmployee $employee)
    {
        $groundSeller = new SlGroundSeller();
        $groundSeller->hr_employee_id = $employee->id;
        $groundSeller->save();
        return $groundSeller;
    }

    private function updateGroundSeller(HrEmployee $employee, $isGroundSeller)
    {
        SlGroundSeller::where('hr_employee_id', $employee->id)->update(['flag_delete' => !$isGroundSeller]);
    }

    public function deleteGroundSeller(HrEmployee $employee)
    {
        $groundSeller = SlGroundSeller::where('hr_employee_id', $employee->id)->first();
        // Delete customers
        if ($groundSeller) {
            SlCustomerGroundSeller::where('sl_ground_seller_id', $groundSeller->id)->delete();
        }
        SlGroundSeller::where('hr_employee_id', $employee->id)->update(['flag_delete' => true]);
    }

}
