<?php

namespace Modules\General\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\General\Entities\GUserPos;
use Modules\General\Entities\GRoleCanCreateRolePos;

class RolePermissionTableSeeder extends Seeder
{

    private $users = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user id: 1, 2, y 3 son Rubén, Rosita y Alejandro respectivamente
    $this->users = [GUserPos::find(1)/*, GUserPos::find(2), GUserPos::find(3)*/];

        // POS Roles and Permissions
        $this->assignRolesAndPermissions('pos_supervisor', [
            'autorizar apertura caja', 'autorizar egreso caja', 'autorizar ingreso caja',
            'autorizar ticket de venta', 'autorizar arqueo caja', 'autorizar nota de credito',
            'autorizar venta a personal', 'autorizar cambio productos', 'cerrar caja',
            'obtener resumen completo arqueo caja',
            'autorizar anulacion boleta o factura',
            'crear usuarios',
            'actualizar usuarios',
            'eliminar usuarios',
        ]);

        $this->assignRolesAndPermissions('pos_cashier', [
            'operar caja'
        ]);

        $this->assignRolesAndPermissions('pos_seller', [
            'operar punto venta'
        ]);
        
        // SALE Roles and Permissions
        $this->assignRolesAndPermissions('sl_manager', [
            'view all products', 'create product', 'edit product', 'delete product',
            'view all customers', 'create customer', 'edit customer', 'delete customer',
            'view all tags', 'create tag', 'edit tag', 'delete tag',
            'view all families', 'create family', 'edit family', 'delete family',
            // 'view all subfamilies', 'create subfamily', 'edit subfamily', 'delete subfamily',
            'view all massive offer', 'create massive offer',
            'view all promos', 'crate promo',
            'edit sl_price',
            'view all commissions', 'view all create commission',
            'view all seller', 'create seller',
        ]);

        // ADMIN Roles and Permissions
        $this->assignRolesAndPermissions('adm_supervisor', [ // Jefe de Administración
            'autorizar orden de compra'
        ]);

        // WAREHOUSE Roles and Permissions
        $this->assignRolesAndPermissions('admin_warehouse', [ // Administrador de Bodega
            'view all products', 'create product', 'edit product', 'delete product',
            'view all orderers', 'create orderer', 'edit orderer', 'delete orderer',
            'view all movement inventory',
            'view all transfers between warehouses', 'create transfer between warehouses', 'edit transfer between warehouses', 'delete transfer between warehouses',
            'view all OC', 'receipt OC',
            'view all inventories', 'create inventory', 'edit inventory', 'delete inventory',
            'view all stock adjusts', 'create stock adjust', 'edit stock adjust', 'delete stock adjust',
            'view all warehouses', 'create warehouse', 'edit warehouse', 'delete warehouse',
        ]);

        $this->assignRolesAndPermissions('chief_warehouse', [ // Jefe de bodega
            'view all products', 'create product', 'edit product', 'delete product',
            'view all orderers', 'create orderer', 'edit orderer', 'delete orderer',
            'view all movement inventory',
            'view all transfers between warehouses', 'create transfer between warehouses', 'edit transfer between warehouses', 'delete transfer between warehouses',
            'view all OC', 'receipt OC',
            'view all inventories', 'create inventory', 'edit inventory', 'delete inventory',
            'view all stock adjusts', 'create stock adjust', 'edit stock adjust', 'delete stock adjust',
            'view all warehouses', 'create warehouse', 'edit warehouse', 'delete warehouse',
        ]);
        
        $this->assignRolesAndPermissions('warehouse_season_manager', [ // Encargado de bodega temporal
            'view all products', 'create product', 'edit product', 'delete product',
            'view all orderers', 'create orderer', 'edit orderer', 'delete orderer',
            'view all movement inventory',
            'view all transfers between warehouses', 'create transfer between warehouses', 'edit transfer between warehouses', 'delete transfer between warehouses',
            'view all OC', 'receipt OC',
            'view all inventories', 'create inventory', 'edit inventory', 'delete inventory',
            'view all stock adjusts', 'create stock adjust', 'edit stock adjust', 'delete stock adjust',
            'view all warehouses', 'create warehouse', 'edit warehouse', 'delete warehouse',
        ]);
        
        $this->assignRolesAndPermissions('warehouse_manager', [ // Encargado de bodega
            'view all products',
            'view all orderers', 'create orderer', 'edit orderer', 'delete orderer',
            'view all movement inventory',
            'view all transfers between warehouses', 'create transfer between warehouses', 'edit transfer between warehouses', 'delete transfer between warehouses',
            'view all OC', 'receipt OC',
            'view all inventories', 'create inventory', 'edit inventory', 'delete inventory',
            'view all stock adjusts', 'create stock adjust', 'edit stock adjust', 'delete stock adjust',
            'view all warehouses', 'create warehouse', 'edit warehouse', 'delete warehouse',
        ]);

        // Pos Ground Roles and Permissions
        $this->assignRolesAndPermissions('pos_ground_seller', [ // Encargado de bodega
            'use POS Ground',
        ]);

        // What roles can create each role?
        $this->assignRoleCanCreateRole('pos_supervisor', [
            'pos_cashier', 'pos_seller'
        ]);

    }

    /**
     * Assign roles and permissions
     *
     * @param string $role
     * @param array $permissions
     * @return void
     */
    public function assignRolesAndPermissions($role, $permissions = []) {
        $role = Role::create(['name' => $role, 'guard_name' => 'api']);

        $syncPermissions = [];

        foreach( $permissions as $permission ) {
            try { 
                array_push( $syncPermissions, Permission::create([ 'name' => $permission, 'guard_name' => 'api' ]) );
            } catch(\Exception $e) {
                continue;
            }

        }
        $role->syncPermissions($syncPermissions);

        // * Usuarios de Prueba:
        $this->users[0]->assignRole($role);
        // $this->users[1]->assignRole($role);
        // $this->users[2]->assignRole($role);
    }

    public function assignRoleCanCreateRole($roleName, $rolesNameCanCreate = [])
    {
        $role = Role::where('name', $roleName)->first();
        foreach($rolesNameCanCreate as $roleNameCanCreate)
        {
            $roleCanCreate = Role::where('name', $roleNameCanCreate)->first();
            $roleCanCreateRole = new GRoleCanCreateRolePos();
            $roleCanCreateRole->g_role_id = $role->id;
            $roleCanCreateRole->g_role_can_create_id = $roleCanCreate->id;
            $roleCanCreateRole->save();
        }
    }

}
