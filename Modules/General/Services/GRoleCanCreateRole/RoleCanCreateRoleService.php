<?php

namespace Modules\General\Services\GRoleCanCreateRole;

use Modules\General\Entities\GRoleCanCreateRolePos;

class RoleCanCreateRoleService
{

    public function canCreateRole($roleId, $roleCanCreateId)
    {
        $roleCanCreateRole = GRoleCanCreateRolePos::where('role_id', $roleId)
                                                ->where('role_can_create_id', $roleCanCreateId)
                                                ->first();
        return $roleCanCreateRole != null;
    }

}
