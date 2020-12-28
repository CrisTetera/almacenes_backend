<?php

namespace Modules\Hr\Services\HrEmployee;

use Modules\HR\Entities\HrEmployee;
use Modules\Sale\Entities\SlGroundSeller;
use Modules\Sale\Entities\SlCustomerGroundSeller;
use Dotenv\Exception\ValidationException;


class GroundSellerCustomersService
{
    /**
     * Handle Ground Seller Customers
     *
     * @param HrEmployee $employee
     * @param array $request
     */
    public function handleCustomers(HrEmployee $employee, $request)
    {
        if ( !$this->hasToHandleCustomers($request) )
            return;
        $groundSeller = $this->checkGroundSeller($employee);
        foreach( $request->customers as $customerId )
        {
            $this->checkIsCustomerAvailable($customerId);
            $this->syncCustomer($groundSeller, $customerId);
        }
    }

    private function hasToHandleCustomers($request)
    {
        return isset($request['customers']) && is_array($request->customers);
    }

    private function checkGroundSeller(HrEmployee $employee)
    {
        $groundSeller = SlGroundSeller::where('hr_employee_id', $employee->id)->where('flag_delete', false)->first();
        if (!$groundSeller)
        {
            throw new ValidationException("El usuario no es un vendedor a terreno");
        }
        return $groundSeller;
    }

    private function checkIsCustomerAvailable($customerId)
    {
        $count = SlCustomerGroundSeller::where('sl_customer_id', $customerId)->count();
        if ( $count > 0 )
        {
            throw new ValidationException("El cliente ($customerId) ya ha sido tomado");
        }
    }

    private function syncCustomer(SlGroundSeller $groundSeller, $customerId)
    {
        $groundSeller->customers()->sync([$customerId], false);
    }

    public function deleteCustomers(HrEmployee $employee)
    {
        $groundSeller = SlGroundSeller::where('hr_employee_id', $employee->id)->first();
        if ($groundSeller)
        {
            SlCustomerGroundSeller::where('sl_ground_seller_id', $groundSeller->id)->delete();
        }
    }
}
