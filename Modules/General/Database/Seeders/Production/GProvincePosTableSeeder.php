<?php

namespace Modules\General\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GProvincePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('g_province_pos')->delete();
        
        \DB::table('g_province_pos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Arica',
                'g_region_id' => 15,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Parinacota',
                'g_region_id' => 15,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Iquique',
                'g_region_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Tamarugal',
                'g_region_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Antofagasta',
                'g_region_id' => 2,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'El Loa',
                'g_region_id' => 2,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Tocopilla',
                'g_region_id' => 2,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Copiapó',
                'g_region_id' => 3,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Chañaral',
                'g_region_id' => 3,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Huasco',
                'g_region_id' => 3,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Elqui',
                'g_region_id' => 4,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Choapa',
                'g_region_id' => 4,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Limarí',
                'g_region_id' => 4,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Valparaíso',
                'g_region_id' => 5,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Isla de Pascua',
                'g_region_id' => 5,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Los Andes',
                'g_region_id' => 5,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Petorca',
                'g_region_id' => 5,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Quillota',
                'g_region_id' => 5,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'San Antonio',
                'g_region_id' => 5,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'San Felipe de Aconcagua',
                'g_region_id' => 5,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Marga Marga',
                'g_region_id' => 5,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Cachapoal',
                'g_region_id' => 6,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Cardenal Caro',
                'g_region_id' => 6,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Colchagua',
                'g_region_id' => 6,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Talca',
                'g_region_id' => 7,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Cauquenes',
                'g_region_id' => 7,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Curicó',
                'g_region_id' => 7,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Linares',
                'g_region_id' => 7,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Concepción',
                'g_region_id' => 8,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Arauco',
                'g_region_id' => 8,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Biobío',
                'g_region_id' => 8,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Ñuble',
                'g_region_id' => 8,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Cautín',
                'g_region_id' => 9,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Malleco',
                'g_region_id' => 9,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Valdivia',
                'g_region_id' => 14,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Ranco',
                'g_region_id' => 14,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Llanquihue',
                'g_region_id' => 10,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Chiloé',
                'g_region_id' => 10,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Osorno',
                'g_region_id' => 10,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Palena',
                'g_region_id' => 10,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Coihaique',
                'g_region_id' => 11,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Aisén',
                'g_region_id' => 11,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Capitán Prat',
                'g_region_id' => 11,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'General Carrera',
                'g_region_id' => 11,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Magallanes',
                'g_region_id' => 12,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Antártica Chilena',
                'g_region_id' => 12,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Tierra del Fuego',
                'g_region_id' => 12,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Última Esperanza',
                'g_region_id' => 12,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Santiago',
                'g_region_id' => 13,
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Cordillera',
                'g_region_id' => 13,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Chacabuco',
                'g_region_id' => 13,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Maipo',
                'g_region_id' => 13,
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Melipilla',
                'g_region_id' => 13,
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Talagante',
                'g_region_id' => 13,
            ),
        ));
        
        $now = \Carbon\Carbon::now();
        \DB::table('g_province')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
