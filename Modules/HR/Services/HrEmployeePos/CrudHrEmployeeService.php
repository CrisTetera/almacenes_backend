<?php

namespace Modules\Hr\Services\HrEmployeePos;

use Modules\General\Entities\GUserPos;
use Modules\General\Http\Requests\GUserPos\EditGUserRequest;
use Modules\General\Http\Requests\GUserPos\CreateGUserRequest;
use Modules\HR\Entities\HrEmployeePos;
use Dotenv\Exception\ValidationException;


class CrudHrEmployeeService
{
    public function __construct(
    ){}

    public function storeEmployee(CreateGUserRequest $request)
    {
        $this->checkRut($request->rut);
        $employee = new HrEmployeePos();
        $this->setEmployeeParams($employee, $request);
        $employee->save();

        /*if ( $employee->isGroundSeller() )
        {
            $this->groundSellerCustomersService->handleCustomers($employee, $request);
        }*/

        return $employee;
    }

    public function updateEmployee(GUserPos $user, EditGUserRequest $request)
    {
        $this->checkRutWhenUpdating($request->rut, $user->hr_employee_id);
        $employee = $this->checkEmployee($user);
        $this->setEmployeeParams($employee, $request);
        $employee->save();

       /* $this->crudGroundSellerService->handleUpdateGroundSeller($employee, $request);
        $this->crudHrEmployeeCommissionsService->handleCommissions($employee, $request);

        $this->groundSellerCustomersService->deleteCustomers($employee);
        if ( $employee->isGroundSeller() )
        {
            $this->groundSellerCustomersService->handleCustomers($employee, $request);
        }*/

        return $employee;
    }

    public function deleteEmployee(GUserPos $user)
    {
        $employee = $this->checkEmployee($user);
        $employee->flag_delete = true;
        $employee->save();

        //$this->crudGroundSellerService->deleteGroundSeller($employee);
    }

    private function checkRut($rut)
    {
        $employee = HrEmployeePos::where('rut', $rut)->where('flag_delete', false)->first();
        if ($employee) {
            throw new ValidationException("El rut ya ha sido tomado");
        }
    }

    private function checkRutWhenUpdating($rut, $idHrEmployee)
    {
        $employee = HrEmployeePos::where('rut', $rut)->where('flag_delete', false)->where('id', '!=', $idHrEmployee)->first();
        if ($employee) {
            throw new ValidationException("El rut ya ha sido tomado");
        }
    }

    private function setEmployeeParams(HrEmployeePos &$employee, $request)
    {
        $employee->rut = $request->rut;
        $employee->firstnames = $request->firstnames;
        $employee->last_name1 = $request->last_name1;
        $employee->last_name2 = $request->has('last_name2') && $request->last_name2 ? $request->last_name2 : '';
        $employee->email = $request->email;
    }

    private function checkEmployee(GUserPos $user)
    {
        $employee = HrEmployeePos::where('id', $user->hr_employee_id)->where('flag_delete', false)->first();
        if (!$employee) {
            throw new ValidationException("El empleado ($user->hr_employee_id) no existe");
        }
        return $employee;
    }

}
