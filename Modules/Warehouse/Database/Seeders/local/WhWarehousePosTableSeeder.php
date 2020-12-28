<?php

namespace Modules\Warehouse\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class WhWarehousePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('wh_warehouse_pos')->delete();

        \DB::table('wh_warehouse_pos')->insert(array (
            0 =>
            array (
                
                
                'name' => 'BOD-001',
                'description' => $faker->realText(),
                'address' => 'Avenida Siempre Viva #742',
                
                'flag_delete' => false,
            ),
            1 =>
            array (
                
                
                'name' => 'BOD-002',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            // (3) Waste warehouse branch office 1 (here are stored broken products in service order change)
            2 =>
            array (
                
                
                'name' => 'WASTED-LS',
                'description' => 'Waste Warehouse',
                'address' => 'Por ahí',
                
                'flag_delete' => false,
            ),
            // (4) Waste warehouse branch office 2 (here are stored broken products in service order change)
            3 =>
            array (
                
                'name' => 'WASTED-OV',
                'description' => 'Waste Warehouse',
                'address' => 'Por allá',
                
                'flag_delete' => false,
            ),
            4 =>
            array (
                
                
                'name' => 'BOD-005',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            5 =>
            array (
                
                
                'name' => 'BOD-006',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            6 =>
            array (
                
                
                'name' => 'BOD-007',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            7 =>
            array (
                
                
                'name' => 'BOD-008',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            8 =>
            array (
                
                
                'name' => 'BOD-009',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            9 =>
            array (
                'name' => 'BOD-010',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            10 =>
            array (
                'name' => 'BOD-011',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            11 =>
            array (
                
                
                'name' => 'BOD-012',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            12 =>
            array (
                
                
                'name' => 'BOD-013',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            13 =>
            array (
                
                
                'name' => 'BOD-014',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            14 =>
            array (
                
                
                'name' => 'BOD-015',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            15 =>
            array (
                
                
                'name' => 'BOD-016',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            16 =>
            array (
                
                
                'name' => 'BOD-017',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            17 =>
            array (
                
                
                'name' => 'BOD-018',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            18 =>
            array (
                
                
                'name' => 'BOD-019',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            19 =>
            array (
                
                
                'name' => 'BOD-020',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            20 =>
            array (
                
                
                'name' => 'BOD-021',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            21 =>
            array (
                
                
                'name' => 'BOD-022',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            22 =>
            array (
                
                
                'name' => 'BOD-023',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            23 =>
            array (
                
                
                'name' => 'BOD-024',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            24 =>
            array (
                
                
                'name' => 'BOD-025',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            25 =>
            array (
                
                
                'name' => 'BOD-026',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            26 =>
            array (
                
                
                'name' => 'BOD-027',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            27 =>
            array (
                
                
                'name' => 'BOD-028',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            28 =>
            array (
                
                
                'name' => 'BOD-029',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            29 =>
            array (
                
                
                'name' => 'BOD-030',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            30 =>
            array (
                
                
                'name' => 'BOD-031',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            31 =>
            array (
                
                
                'name' => 'BOD-032',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            32 =>
            array (
                
                
                'name' => 'BOD-033',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            33 =>
            array (
                
                
                'name' => 'BOD-034',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            34 =>
            array (
                
                
                'name' => 'BOD-035',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            35 =>
            array (
                
                
                'name' => 'BOD-036',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            36 =>
            array (
                
                
                'name' => 'BOD-037',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            37 =>
            array (
                
                
                'name' => 'BOD-038',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            38 =>
            array (
                
                
                'name' => 'BOD-039',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            39 =>
            array (
                
                
                'name' => 'BOD-040',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            40 =>
            array (
                
                
                'name' => 'BOD-041',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            41 =>
            array (
                
                
                'name' => 'BOD-042',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            42 =>
            array (
                
                
                'name' => 'BOD-043',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            43 =>
            array (
                
                
                'name' => 'BOD-044',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            44 =>
            array (
                
                
                'name' => 'BOD-045',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            45 =>
            array (
                
                
                'name' => 'BOD-046',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            46 =>
            array (
                
                
                'name' => 'BOD-047',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            47 =>
            array (
                
                
                'name' => 'BOD-048',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            48 =>
            array (
                
                
                'name' => 'BOD-049',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            49 =>
            array (
                
                
                'name' => 'BOD-050',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            50 =>
            array (
                
                
                'name' => 'BOD-051',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            51 =>
            array (
                
                
                'name' => 'BOD-052',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            52 =>
            array (
                
                
                'name' => 'BOD-053',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            53 =>
            array (
                
                
                'name' => 'BOD-054',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            54 =>
            array (
                
                
                'name' => 'BOD-055',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            55 =>
            array (
                
                
                'name' => 'BOD-056',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            56 =>
            array (
                
                
                'name' => 'BOD-057',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            57 =>
            array (
                
                
                'name' => 'BOD-058',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            58 =>
            array (
                
                
                'name' => 'BOD-059',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            59 =>
            array (
                
                
                'name' => 'BOD-060',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            60 =>
            array (
                
                
                'name' => 'BOD-061',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            61 =>
            array (
                
                
                'name' => 'BOD-062',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            62 =>
            array (
                
                
                'name' => 'BOD-063',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            63 =>
            array (
                
                
                'name' => 'BOD-064',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            64 =>
            array (
                
                
                'name' => 'BOD-065',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            65 =>
            array (
                
                
                'name' => 'BOD-066',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            66 =>
            array (
                
                
                'name' => 'BOD-067',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            67 =>
            array (
                
                
                'name' => 'BOD-068',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            68 =>
            array (
                
                
                'name' => 'BOD-069',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            69 =>
            array (
                
                
                'name' => 'BOD-070',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            70 =>
            array (
                
                
                'name' => 'BOD-071',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            71 =>
            array (
                
                
                'name' => 'BOD-072',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            72 =>
            array (
                
                
                'name' => 'BOD-073',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            73 =>
            array (
                
                
                'name' => 'BOD-074',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            74 =>
            array (
                
                
                'name' => 'BOD-075',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            75 =>
            array (
                
                
                'name' => 'BOD-076',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            76 =>
            array (
                
                
                'name' => 'BOD-077',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            77 =>
            array (
                
                
                'name' => 'BOD-078',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            78 =>
            array (
                
                
                'name' => 'BOD-079',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            79 =>
            array (
                
                
                'name' => 'BOD-080',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            80 =>
            array (
                
                
                'name' => 'BOD-081',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            81 =>
            array (
                
                
                'name' => 'BOD-082',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            82 =>
            array (
                
                
                'name' => 'BOD-083',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            83 =>
            array (
                
                
                'name' => 'BOD-084',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            84 =>
            array (
                
                
                'name' => 'BOD-085',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            85 =>
            array (
                
                
                'name' => 'BOD-086',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            86 =>
            array (
                
                
                'name' => 'BOD-087',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            87 =>
            array (
                
                
                'name' => 'BOD-088',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            88 =>
            array (
                
                
                'name' => 'BOD-089',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            89 =>
            array (
                
                
                'name' => 'BOD-090',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            90 =>
            array (
                
                
                'name' => 'BOD-091',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            91 =>
            array (
                
                
                'name' => 'BOD-092',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            92 =>
            array (
                
                
                'name' => 'BOD-093',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            93 =>
            array (
                
                
                'name' => 'BOD-094',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            94 =>
            array (
                
                
                'name' => 'BOD-095',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            95 =>
            array (
                
                
                'name' => 'BOD-096',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            96 =>
            array (
                
                
                'name' => 'BOD-097',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            97 =>
            array (
                
                
                'name' => 'BOD-098',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            98 =>
            array (
                
                
                'name' => 'BOD-099',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
            99 =>
            array (
                
                
                'name' => 'BOD-100',
                'description' => $faker->realText(),
                'address' => $faker->address,
                
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('wh_warehouse_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
