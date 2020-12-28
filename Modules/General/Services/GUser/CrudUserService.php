<?php

namespace Modules\General\Services\GUser;

use Modules\General\Http\Requests\GUser\CreateGUserRequest;
use Modules\General\Http\Requests\GUser\EditGUserRequest;
use Modules\General\Entities\GUser;
use Dotenv\Exception\ValidationException;
use Spatie\Permission\Models\Role;
use Modules\General\Services\RoleConstant;
use Modules\Hr\Services\HrEmployee\CrudHrEmployeeService;
use Illuminate\Support\Facades\DB;
use Modules\HR\Entities\HrEmployee;
use Modules\Sale\Entities\SlCustomerGroundSeller;
use Modules\Sale\Entities\SlGroundSeller;


class CrudUserService
{

    /** @var AuthCodeService $authCodeService */
    private $authCodeService;

    /** @var BarAuthCodeService $barAuthCodeService */
    private $barAuthCodeService;

    /** @var CrudHrEmployeeService */
    private $crudHrEmployeeService;

    public function __construct(
        AuthCodeService $authCodeService,
        BarAuthCodeService $barAuthCodeService,
        CrudHrEmployeeService $crudHrEmployeeService
    )
    {
        $this->authCodeService = $authCodeService;
        $this->barAuthCodeService = $barAuthCodeService;
        $this->crudHrEmployeeService = $crudHrEmployeeService;
    }

    public function store(CreateGUserRequest $request)
    {
        // TODO: Check if logued user can store user
        // TODO: Check if logued user can create role (use the RoleCanCreateRoleService)
        $employee = $this->crudHrEmployeeService->storeEmployee($request);

        $user = new GUser();
        $user->hr_employee_id = $employee->id;
        $user->auth_code = $this->authCodeService->generate();
        $user->save();

        $role = Role::where('id', $request->role)->first();
        $user->assignRole($role);

        if ($this->hasToGenerateBarAuthCode($role->name)) {
            $barAuthCode = $this->barAuthCodeService->getNewBarAuthCode();
            $user->bar_auth_code = $barAuthCode;
            $user->save();
        }

        return [
            'user_id' => $user->id,
            'employee_id' => $employee->id,
            'auth_code' => $user->auth_code,
            'bar_auth_code' => $user->bar_auth_code
        ];
    }

    public function update($idUser, EditGUserRequest $request)
    {
        // TODO: Check if logued user can update user
        // TODO: Check if logued user can create role (use the RoleCanCreateRoleService)
        $user = $this->checkUser($idUser);
        $employee = $this->crudHrEmployeeService->updateEmployee($user, $request);

        $this->removeUserRoles($user);
        $role = Role::where('id', $request->role)->first();
        $user->assignRole($role);
    }

    public function delete($idUser)
    {
        // TODO: Check if logued user can remove user
        $user = $this->checkUser($idUser);
        $user->flag_delete = true;
        $user->save();

        $this->crudHrEmployeeService->deleteEmployee($user);
    }

    private function checkUser($idUser)
    {
        $user = GUser::where('id', $idUser)->where('flag_delete', false)->first();
        if (!$user) {
            throw new ValidationException("El usuario ($idUser) no existe");
        }
        return $user;
    }

    private function removeUserRoles(GUser $user)
    {
        $user->getRoleNames()->each(function($item) use (&$user) {
            $user->removeRole($item);
        });
    }

    private function hasToGenerateBarAuthCode($roleName)
    {
        return in_array($roleName, RoleConstant::AVAILABLE_BAR_AUTH_CODE_ROLES);
    }

}
