<?php

namespace Modules\General\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GMenuPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \DB::table('g_menu_pos')->delete();

        \DB::table('g_menu_pos')->insert(array (
            // SALE MENU
            1 =>
            array (
                'id' => 1,
                'name' => 'Productos',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => 'products',
                'g_module_id' => 1,
            ),
            2 =>
            array (
                'id' => 2,
                'name' => 'Clientes',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => 'customers',
                'g_module_id' => 1,
            ),
            3 =>
            array (
                'id' => 3,
                'name' => 'Tags',
                'priority' => 3,
                'icon' => 'view_list',
                'route' => 'tags',
                'g_module_id' => 1,
            ),
            4 =>
            array (
                'id' => 4,
                'name' => 'Familias',
                'priority' => 4,
                'icon' => 'view_list',
                'route' => 'families',
                'g_module_id' => 1,
            ),
            5 =>
            array (
                'id' => 5,
                'name' => 'Subfamilias',
                'priority' => 5,
                'icon' => 'view_list',
                'route' => 'subfamilies',
                'g_module_id' => 1,
            ),
            6 =>
            array (
                'id' => 6,
                'name' => 'Ofertas',
                'priority' => 6,
                'icon' => 'view_list',
                'route' => 'offer',
                'g_module_id' => 1,
            ),
            7=>
            array (
                'id' => 7,
                'name' => 'Caja',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => '/',
                'g_module_id' => 2,
            ),
            // INVENTORY MENU
            8 =>
            array (
                'id' => 8,
                'name' => 'Productos',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => '/products',
                'g_module_id' => 3,
            ),
            9 =>
            array (
                'id' => 9,
                'name' => 'Solicitudes de abastecimiento',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => '/orderers',
                'g_module_id' => 3,
            ),
            10 =>
            array (
                'id' => 10,
                'name' => 'Movimientos de inventario',
                'priority' => 3,
                'icon' => 'view_list',
                'route' => '/inventory_movement',
                'g_module_id' => 3,
            ),
            11 =>
            array (
                'id' => 11,
                'name' => 'Guías de intercambio',
                'priority' => 4,
                'icon' => 'view_list',
                'route' => '/transfer_between_warehouse',
                'g_module_id' => 3,
            ),
            12 =>
            array (
                'id' => 12,
                'name' => 'Órdenes de Compra',
                'priority' => 5,
                'icon' => 'view_list',
                'route' => '/oc',
                'g_module_id' => 3,
            ),
            13 =>
            array (
                'id' => 13,
                'name' => 'Inventario',
                'priority' => 6,
                'icon' => 'view_list',
                'route' => '/inventory',
                'g_module_id' => 3,
            ),
            14 =>
            array (
                'id' => 14,
                'name' => 'Ajustes de stock',
                'priority' => 7,
                'icon' => 'view_list',
                'route' => '/stock_adjust',
                'g_module_id' => 3,
            ),
            15 =>
            array (
                'id' => 15,
                'name' => 'Bodegas',
                'priority' => 8,
                'icon' => 'view_list',
                'route' => '/warehouse',
                'g_module_id' => 3,
            ),
            // POS GROUND MENU
            16 =>
            array (
                'id' => 16,
                'name' => 'Usar POS en Terreno',
                'priority' => 8,
                'icon' => 'view_list',
                'route' => '/',
                'g_module_id' => 4,
            ),
            // 7 =>
            // array (
            //     'id' => 8,
            //     'name' => 'Comisiones',
            //     'priority' => 7,
            //     'icon' => 'view_list',
            //     'route' => 'commissions',
            //     'g_module_id' => 1,
            // ),
            // 8 =>
            // array (
            //     'id' => 9,
            //     'name' => 'Vendedores',
            //     'priority' => 8,
            //     'icon' => 'view_list',
            //     'route' => 'users',
            //     'g_module_id' => 1,
            // ),
            // CASH MENU
            
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('g_menu_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
