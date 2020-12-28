<?php

namespace Modules\General\Tests\Unit\GRoleCanCreateRole;

use Tests\TestCase;
use Modules\General\Services\GRoleCanCreateRole\RoleCanCreateRoleService;


class RoleCanCreateRoleTest extends TestCase
{
    private $supervisor = 1;
    private $cashier = 2;
    private $seller = 3;

    public function test_Supervisor_CanCreate_Cashier_And_Seller()
    {
        $roleCanCreateRoleService = new RoleCanCreateRoleService();
        $canCreateRole = $roleCanCreateRoleService->canCreateRole($this->supervisor, $this->cashier);
        $this->assertTrue($canCreateRole);
        $canCreateRole = $roleCanCreateRoleService->canCreateRole($this->supervisor, $this->seller);
        $this->assertTrue($canCreateRole);
    }

    public function test_Cashier_CantCreate_Supervisor()
    {
        $roleCanCreateRoleService = new RoleCanCreateRoleService();
        $canCreateRole = $roleCanCreateRoleService->canCreateRole($this->cashier, $this->supervisor);
        $this->assertFalse($canCreateRole);
    }

    public function test_Seller_CantCreate_Supervisor()
    {
        $roleCanCreateRoleService = new RoleCanCreateRoleService();
        $canCreateRole = $roleCanCreateRoleService->canCreateRole($this->seller, $this->supervisor);
        $this->assertFalse($canCreateRole);
    }


}
