<?php

namespace Modules\General\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GCompanyPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('g_company_pos')->delete();
        
        \DB::table('g_company_pos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'rut' => '76795561-8',
                'business_name' => 'HAULMER SPA',
                'state' => '',
                'commercial_business' => 'VENTA AL POR MENOR POR CORREO, POR INTERNET Y VIA TELEFONICA',
                'commercial_activity_code' => 479100,
                'address' => 'ARTURO PRAT 527   CURICO',
                'g_commune_id' => 125,
                'path_icon' => '/icon/icon.png',
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('g_company_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
