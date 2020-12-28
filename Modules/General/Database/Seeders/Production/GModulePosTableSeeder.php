<?php

namespace Modules\General\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GModulePosTableSeeder extends Seeder
{
    /**
     * Const for Modules Ids 
     */
    private const LOGIN_MODULE_ID       = 0;
    private const SALE_MODULE_ID        = 1;
    private const CASH_MODULE_ID        = 2;
    private const INVENTORY_MODULE_ID   = 3;
    private const POS_GROUND_MODULE_ID  = 4;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \DB::table('g_module_pos')->delete();

        \DB::table('g_module_pos')->insert(array (
            0 =>
            array (
                'id' => 0,
                'name' => 'Módulo de Login',
                'url_module' => 'http://localhost:8080/',
                'url_bg_module' => 'storage/assets/module.jpg',
            ),
            1 =>
            array (
                'id' => 1,
                'name' => 'Módulo de Ventas',
                'url_module' => 'http://localhost:8081/',
                'url_bg_module' => 'storage/assets/module.jpg',
            ),
            2 =>
            array (
                'id' => 2,
                'name' => 'Módulo de Caja',
                'url_module' => 'http://localhost:8082/',
                'url_bg_module' => 'storage/assets/module.jpg',
            ),
            3 =>
            array (
                'id' => 3,
                'name' => 'Módulo de Inventario',
                'url_module' => 'http://localhost:8083/',
                'url_bg_module' => 'storage/assets/module.jpg',
            ),
            4 =>
            array (
                'id' => 4,
                'name' => 'Módulo Pos En Terreno',
                'url_module' => 'http://localhost:8084/',
                'url_bg_module' => 'storage/assets/module.jpg',
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('g_module_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);

        // Update Url Module if exist in .env
        if(env('APP_LOGIN_MODULE_URL') != null)
            \DB::table('g_module_pos')
               ->where(['id' => self::LOGIN_MODULE_ID])   
               ->update(['url_module' => env('APP_LOGIN_MODULE_URL')]);

        // Update Url Module if exist in .env
        if(env('APP_SALE_MODULE_URL') != null)
            \DB::table('g_module_pos')
               ->where(['id' => self::SALE_MODULE_ID])
               ->update(['url_module' => env('APP_SALE_MODULE_URL')]);
        
        // Update Url Module if exist in .env
        if(env('APP_CASH_MODULE_URL') != null)
            \DB::table('g_module_pos')
               ->where(['id' => self::CASH_MODULE_ID])
               ->update(['url_module' => env('APP_CASH_MODULE_URL')]);
        
        // Update Url Module if exist in .env
        if(env('APP_INVENTORY_MODULE_URL') != null)
            \DB::table('g_module_pos')
               ->where(['id' => self::INVENTORY_MODULE_ID])
               ->update(['url_module' => env('APP_INVENTORY_MODULE_URL')]);
        
        // Update Url Module if exist in .env
        if(env('APP_POS_GROUND_MODULE_URL') != null)
            \DB::table('g_module_pos')
               ->where(['id' => self::POS_GROUND_MODULE_ID])
               ->update(['url_module' => env('APP_POS_GROUND_MODULE_URL')]);
    }
}
