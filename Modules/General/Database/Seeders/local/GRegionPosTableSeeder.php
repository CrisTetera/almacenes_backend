<?php

namespace Modules\General\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GRegionPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('g_region_pos')->delete();
        
        \DB::table('g_region_pos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Tarapacá',
                'iso_3166_2_cl' => 'CL-TA',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Antofagasta',
                'iso_3166_2_cl' => 'CL-AN',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Atacama',
                'iso_3166_2_cl' => 'CL-AT',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Coquimbo',
                'iso_3166_2_cl' => 'CL-CO',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Valparaíso',
                'iso_3166_2_cl' => 'CL-VS',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Región del Libertador Gral. Bernardo O\'Higgins',
                'iso_3166_2_cl' => 'CL-LI',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Región del Maule',
                'iso_3166_2_cl' => 'CL-ML',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Región del Biobío',
                'iso_3166_2_cl' => 'CL-BI',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Región de la Araucanía',
                'iso_3166_2_cl' => 'CL-AR',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Región de Los Lagos',
                'iso_3166_2_cl' => 'CL-LL',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Región Aisén del Gral. Carlos Ibáñez del Campo',
                'iso_3166_2_cl' => 'CL-AI',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Región de Magallanes y de la Antártica Chilena',
                'iso_3166_2_cl' => 'CL-MA',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Región Metropolitana de Santiago',
                'iso_3166_2_cl' => 'CL-RM',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Región de Los Ríos',
                'iso_3166_2_cl' => 'CL-LR',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Arica y Parinacota',
                'iso_3166_2_cl' => 'CL-AP',
            ),
        ));
        
        $now = \Carbon\Carbon::now();
        \DB::table('g_region')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
