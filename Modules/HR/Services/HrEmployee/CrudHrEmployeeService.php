<?php

namespace Modules\Hr\Services\HrEmployee;

use Modules\General\Entities\GUser;
use Modules\General\Http\Requests\GUser\EditGUserRequest;
use Modules\General\Http\Requests\GUser\CreateGUserRequest;
use Modules\HR\Entities\HrEmployee;
use Dotenv\Exception\ValidationException;


class CrudHrEmployeeService
{

    /** @var CrudGroundSellerService $crudGroundSellerService */
    private $crudGroundSellerService;

    /** @var CrudHrEmployeeCommissionsService */
    private $crudHrEmployeeCommissionsService;

    /** @var GroundSellerCustomersService $groundSellerCustomersService */
    private $groundSellerCustomersService;

    public function __construct(
        CrudGroundSellerService $crudGroundSellerService,
        CrudHrEmployeeCommissionsService $crudHrEmployeeCommissionsService,
        GroundSellerCustomersService $groundSellerCustomersService
    )
    {
        $this->crudGroundSellerService = $crudGroundSellerService;
        $this->crudHrEmployeeCommissionsService = $crudHrEmployeeCommissionsService;
        $this->groundSellerCustomersService = $groundSellerCustomersService;
    }

    public function storeEmployee(CreateGUserRequest $request)
    {
        $this->checkRut($request->rut);
        $employee = new HrEmployee();
        $this->setEmployeeParams($employee, $request);
        $employee->save();

        $this->crudGroundSellerService->handleStoreGroundSeller($employee, $request);
        $this->crudHrEmployeeCommissionsService->handleCommissions($employee, $request);

        if ( $employee->isGroundSeller() )
        {
            $this->groundSellerCustomersService->handleCustomers($employee, $request);
        }

        return $employee;
    }

    public function updateEmployee(GUser $user, EditGUserRequest $request)
    {
        $this->checkRutWhenUpdating($request->rut, $user->hr_employee_id);
        $employee = $this->checkEmployee($user);
        $this->setEmployeeParams($employee, $request);
        $employee->save();

        $this->crudGroundSellerService->handleUpdateGroundSeller($employee, $request);
        $this->crudHrEmployeeCommissionsService->handleCommissions($employee, $request);

        $this->groundSellerCustomersService->deleteCustomers($employee);
        if ( $employee->isGroundSeller() )
        {
            $this->groundSellerCustomersService->handleCustomers($employee, $request);
        }

        return $employee;
    }

    public function deleteEmployee(GUser $user)
    {
        $employee = $this->checkEmployee($user);
        $employee->flag_delete = true;
        $employee->save();

        $this->crudGroundSellerService->deleteGroundSeller($employee);
    }

    private function checkRut($rut)
    {
        $employee = HrEmployee::where('rut', $rut)->where('flag_delete', false)->first();
        if ($employee) {
            throw new ValidationException("El rut ya ha sido tomado");
        }
    }

    private function checkRutWhenUpdating($rut, $idHrEmployee)
    {
        $employee = HrEmployee::where('rut', $rut)->where('flag_delete', false)->where('id', '!=', $idHrEmployee)->first();
        if ($employee) {
            throw new ValidationException("El rut ya ha sido tomado");
        }
    }

    private function setEmployeeParams(HrEmployee &$employee, $request)
    {
        $employee->rut = $request->rut;
        $employee->names = $request->names;
        $employee->last_name1 = $request->last_name1;
        $employee->last_name2 = $request->has('last_name2') && $request->last_name2 ? $request->last_name2 : '';
        $employee->email = $request->email;
    }

    private function checkEmployee(GUser $user)
    {
        $employee = HrEmployee::where('id', $user->hr_employee_id)->where('flag_delete', false)->first();
        if (!$employee) {
            throw new ValidationException("El empleado ($user->hr_employee_id) no existe");
        }
        return $employee;
    }

}
