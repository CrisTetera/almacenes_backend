<?php

namespace Modules\General\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\General\Services\PermissionConstant;
class GSubmenuPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \DB::table('g_submenu_pos')->delete();

        \DB::table('g_submenu_pos')->insert(array (
            /***** SALE MODULE *****/
            // SALE - PRODUCTS
            1 =>
            array (
                'id' => 1,
                'name' => 'Ver listado Productos',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => 'products',
                'g_menu_id' => 1,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_ALL_PRODUCTS)
                                      ->first()
                                      ->id,
            ),
            2 =>
            array (
                'id' => 2,
                'name' => 'Crear Producto',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => 'products/create',
                'g_menu_id' => 1,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_CREATE_PRODUCT)
                                      ->first()
                                      ->id,
            ),
            3 =>
            array (
                'id' => 3,
                'name' => 'Ver listado Promos',
                'priority' => 3,
                'icon' => 'view_list',
                'route' => 'promos',
                'g_menu_id' => 1,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_ALL_PROMOS)
                                      ->first()
                                      ->id,
            ),
            4 =>
            array (
                'id' => 4,
                'name' => 'Crear Promos',
                'priority' => 4,
                'icon' => 'view_list',
                'route' => 'promos/create',
                'g_menu_id' => 1,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_CREATE_PROMO)
                                      ->first()
                                      ->id,
            ),
            5 =>
            array (
                'id' => 5,
                'name' => 'Editar Precios',
                'priority' => 5,
                'icon' => 'view_list',
                'route' => 'products/sale_price',
                'g_menu_id' => 1,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_EDIT_SALE_PRICE)
                                      ->first()
                                      ->id,
            ),
            // SALE - CUSTOMERS
            6 =>
            array (
                'id' => 6,
                'name' => 'Ver listado Clientes',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => 'customers',
                'g_menu_id' => 2,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_ALL_CUSTOMERS)
                                      ->first()
                                      ->id,
            ),
            7 =>
            array (
                'id' => 7,
                'name' => 'Crear Cliente',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => 'customers/create',
                'g_menu_id' => 2,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_CREATE_CUSTOMER)
                                      ->first()
                                      ->id,
            ),
            // SALE - TAGS
            8 =>
            array (
                'id' => 8,
                'name' => 'Ver listado Tags',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => 'tags',
                'g_menu_id' => 3,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_ALL_TAGS)
                                      ->first()
                                      ->id,
            ),
            9 =>
            array (
                'id' => 9,
                'name' => 'Crear Tag',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => 'tags/create',
                'g_menu_id' => 3,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_CREATE_TAG)
                                      ->first()
                                      ->id,
            ),
            // SALE - FAMILIES
            10 =>
            array (
                'id' => 10,
                'name' => 'Ver listado Familias',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => 'families',
                'g_menu_id' => 4,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_ALL_FAMILIES)
                                      ->first()
                                      ->id,
            ),
            11 =>
            array (
                'id' => 11,
                'name' => 'Crear Familia',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => 'families/create',
                'g_menu_id' => 4,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_CREATE_FAMILY)
                                      ->first()
                                      ->id,
            ),
            // SALE - SUBFAMILIES
            // 12 =>
            // array (
            //     'id' => 12,
            //     'name' => 'Ver listado Subfamilias',
            //     'priority' => 1,
            //     'icon' => 'view_list',
            //     'route' => 'subfamilies',
            //     'g_menu_id' => 5,
            //     'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_ALL_SUBFAMILIES)
            //                           ->first()
            //                           ->id,
            // ),
            // 13 =>
            // array (
            //     'id' => 13,
            //     'name' => 'Crear Subfamilia',
            //     'priority' => 2,
            //     'icon' => 'view_list',
            //     'route' => 'subfamilies/create',
            //     'g_menu_id' => 5,
            //     'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_CREATE_SUBFAMILY)
            //                           ->first()
            //                           ->id,
            // ),
            // SALE - OFFER
            14 =>
            array (
                'id' => 14,
                'name' => 'Ver listado Ofertas Masivas',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => 'offer',
                'g_menu_id' => 6,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_ALL_MASSIVE_OFFER)
                                      ->first()
                                      ->id,
            ),
            15 =>
            array (
                'id' => 15,
                'name' => 'Crear Ofertas Masivas',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => 'offer/create',
                'g_menu_id' => 6,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_CREATE_MASSIVE_OFFER)
                                      ->first()
                                      ->id,
            ),
            // SALE - COMMISSIONS
            16 =>
            array (
                'id' => 16,
                'name' => 'Ver listado Comisiones',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => 'commissions',
                'g_menu_id' => 8,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_ALL_COMMISSIONS)
                                      ->first()
                                      ->id,
            ),
            17 =>
            array (
                'id' => 17,
                'name' => 'Crear Comisión',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => 'commissions/create',
                'g_menu_id' => 8,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_CREATE_COMMISSION)
                                      ->first()
                                      ->id,
            ),
            // SALE - SELLERS
            18 =>
            array (
                'id' => 18,
                'name' => 'Ver listado Vendedores',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => 'users',
                'g_menu_id' => 9,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_ALL_SELLER)
                                      ->first()
                                      ->id,
            ),
            19 =>
            array (
                'id' => 19,
                'name' => 'Crear Vendedor',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => 'users/create',
                'g_menu_id' => 9,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_CREATE_SELLER)
                                      ->first()
                                      ->id,
            ),
            /***** CASH MODULE *****/
            20 =>
            array (
                'id' => 20,
                'name' => 'Operar Caja',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 7,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::POS_OPERAR_CAJA)
                                      ->first()
                                      ->id,
            ),
            /***** INVENTORY MODULE *****/
            // INVENTORY - PRODUCTS
            21 =>
            array (
                'id' => 21,
                'name' => 'Ver listado productos',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 10,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_ALL_PRODUCTS)
                                      ->first()
                                      ->id,
            ),
            22 =>
            array (
                'id' => 22,
                'name' => 'Crear producto',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 10,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::SL_VIEW_CREATE_PRODUCT)
                                      ->first()
                                      ->id,
            ),
            // INVENTORY - ORDERER
            23 =>
            array (
                'id' => 23,
                'name' => 'Ver listado Sol. de Abastecimiento',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 11,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_VIEW_ALL_ORDERERS)
                                      ->first()
                                      ->id,
            ),
            24 =>
            array (
                'id' => 24,
                'name' => 'Crear Sol. de Abastecimiento',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 11,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_CREATE_ORDERER)
                                      ->first()
                                      ->id,
            ),
            // INVENTORY - INVENTORY MOVEMENT
            25 =>
            array (
                'id' => 25,
                'name' => 'Ver listado Mov. Inventario',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 12,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_VIEW_ALL_MOVEMENT_INVENTORY)
                                      ->first()
                                      ->id,
            ),
            // INVENTORY - TRANSFER BETWEEN WAREHOUSE
            26 =>
            array (
                'id' => 26,
                'name' => 'Ver listado Sol. de Intercambio',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 13,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_VIEW_ALL_TRANSFERS_BETWEEN_WAREHOUSES)
                                      ->first()
                                      ->id,
            ),
            27 =>
            array (
                'id' => 27,
                'name' => 'Crear Sol. de Intercambio',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 13,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_CREATE_TRANSFER_BETWEEN_WAREHOUSE)
                                      ->first()
                                      ->id,
            ),
            // INVENTORY - PURCHASE ORDER
            28 =>
            array (
                'id' => 28,
                'name' => 'Ver listado Órdenes de Compra',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 14,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_VIEW_ALL_OC)
                                      ->first()
                                      ->id,
            ),
            29 =>
            array (
                'id' => 29,
                'name' => 'Recepción Orden de Compra',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 14,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_RECEIPT_OC)
                                      ->first()
                                      ->id,
            ),
            // INVENTORY - INVENTORIES
            30 =>
            array (
                'id' => 30,
                'name' => 'Ver listado Inventarios',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 15,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_VIEW_ALL_INVENTORIES)
                                      ->first()
                                      ->id,
            ),
            31 =>
            array (
                'id' => 31,
                'name' => 'Crear Inventario',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 15,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_CREATE_INVENTORY)
                                      ->first()
                                      ->id,
            ),
            // INVENTORY - STOCK ADJUST
            32 =>
            array (
                'id' => 32,
                'name' => 'Ver listado Ajustes de Stock',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 16,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_VIEW_ALL_STOCK_ADJUST)
                                      ->first()
                                      ->id,
            ),
            33 =>
            array (
                'id' => 33,
                'name' => 'Crear Ajuste de Stock',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 16,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_CREATE_STOCK_ADJUST)
                                      ->first()
                                      ->id,
            ),
            // INVENTORY - WAREHOUSE
            34 =>
            array (
                'id' => 34,
                'name' => 'Ver listado Bodegas',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 17,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_VIEW_ALL_WAREHOUSES)
                                      ->first()
                                      ->id,
            ),
            35 =>
            array (
                'id' => 35,
                'name' => 'Crear Bodega',
                'priority' => 2,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 17,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::WH_CREATE_WAREHOUSE)
                                      ->first()
                                      ->id,
            ),
            /***** POS GROUND MODULE *****/
            // POS GROUND - GENERAL VIEW
            36 =>
            array (
                'id' => 36,
                'name' => 'Usar POS en Terreno',
                'priority' => 1,
                'icon' => 'view_list',
                'route' => '/',
                'g_menu_id' => 18,
                'permissions_id' => \DB::table('permissions')->where('name', PermissionConstant::POS_USE_POS_GROUND)
                                      ->first()
                                      ->id,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('g_submenu_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
