<?php

namespace Modules\Pos\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;

class PosCashDeskPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pos_cash_desk_pos')->delete();
        
        \DB::table('pos_cash_desk_pos')->insert(array (
            0 => 
            array (
                // 'id' => 1,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '001',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            1 => 
            array (
                // 'id' => 2,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '002',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            2 => 
            array (
                // 'id' => 3,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '003',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            3 => 
            array (
                // 'id' => 4,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '004',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            4 => 
            array (
                // 'id' => 5,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '005',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            5 => 
            array (
                // 'id' => 6,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '006',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            6 => 
            array (
                // 'id' => 7,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '007',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            7 => 
            array (
                // 'id' => 8,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '008',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            8 => 
            array (
                // 'id' => 9,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '009',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            9 => 
            array (
                // 'id' => 10,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '010',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            10 => 
            array (
                // 'id' => 11,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '011',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            11 => 
            array (
                // 'id' => 12,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '012',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            12 => 
            array (
                // 'id' => 13,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '013',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            13 => 
            array (
                // 'id' => 14,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '014',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            14 => 
            array (
                // 'id' => 15,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '015',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            15 => 
            array (
                // 'id' => 16,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '016',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            16 => 
            array (
                // 'id' => 17,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '017',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            17 => 
            array (
                // 'id' => 18,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '018',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            18 => 
            array (
                // 'id' => 19,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '019',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            19 => 
            array (
                // 'id' => 20,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '020',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            20 => 
            array (
                // 'id' => 21,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '021',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            21 => 
            array (
                // 'id' => 22,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '022',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            22 => 
            array (
                // 'id' => 23,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '023',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            23 => 
            array (
                // 'id' => 24,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '024',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            24 => 
            array (
                // 'id' => 25,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '025',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            25 => 
            array (
                // 'id' => 26,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '026',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            26 => 
            array (
                // 'id' => 27,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '027',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            27 => 
            array (
                // 'id' => 28,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '028',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            28 => 
            array (
                // 'id' => 29,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '029',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            29 => 
            array (
                // 'id' => 30,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '030',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            30 => 
            array (
                // 'id' => 31,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '031',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            31 => 
            array (
                // 'id' => 32,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '032',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            32 => 
            array (
                // 'id' => 33,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '033',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            33 => 
            array (
                // 'id' => 34,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '034',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            34 => 
            array (
                // 'id' => 35,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '035',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            35 => 
            array (
                // 'id' => 36,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '036',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            36 => 
            array (
                // 'id' => 37,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '037',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            37 => 
            array (
                // 'id' => 38,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '038',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            38 => 
            array (
                // 'id' => 39,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '039',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            39 => 
            array (
                // 'id' => 40,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '040',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            40 => 
            array (
                // 'id' => 41,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '041',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            41 => 
            array (
                // 'id' => 42,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '042',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            42 => 
            array (
                // 'id' => 43,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '043',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            43 => 
            array (
                // 'id' => 44,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '044',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            44 => 
            array (
                // 'id' => 45,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '045',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            45 => 
            array (
                // 'id' => 46,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '046',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            46 => 
            array (
                // 'id' => 47,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '047',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            47 => 
            array (
                // 'id' => 48,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '048',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            48 => 
            array (
                // 'id' => 49,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '049',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            49 => 
            array (
                // 'id' => 50,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '050',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            50 => 
            array (
                // 'id' => 51,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '051',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            51 => 
            array (
                // 'id' => 52,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '052',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            52 => 
            array (
                // 'id' => 53,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '053',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            53 => 
            array (
                // 'id' => 54,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '054',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            54 => 
            array (
                // 'id' => 55,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '055',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            55 => 
            array (
                // 'id' => 56,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '056',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            56 => 
            array (
                // 'id' => 57,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '057',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            57 => 
            array (
                // 'id' => 58,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '058',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            58 => 
            array (
                // 'id' => 59,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '059',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            59 => 
            array (
                // 'id' => 60,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '060',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            60 => 
            array (
                // 'id' => 61,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '061',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            61 => 
            array (
                // 'id' => 62,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '062',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            62 => 
            array (
                // 'id' => 63,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '063',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            63 => 
            array (
                // 'id' => 64,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '064',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            64 => 
            array (
                // 'id' => 65,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '065',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            65 => 
            array (
                // 'id' => 66,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '066',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            66 => 
            array (
                // 'id' => 67,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '067',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            67 => 
            array (
                // 'id' => 68,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '068',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            68 => 
            array (
                // 'id' => 69,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '069',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            69 => 
            array (
                // 'id' => 70,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '070',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            70 => 
            array (
                // 'id' => 71,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '071',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            71 => 
            array (
                // 'id' => 72,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '072',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            72 => 
            array (
                // 'id' => 73,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '073',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            73 => 
            array (
                // 'id' => 74,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '074',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            74 => 
            array (
                // 'id' => 75,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '075',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            75 => 
            array (
                // 'id' => 76,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '076',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            76 => 
            array (
                // 'id' => 77,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '077',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            77 => 
            array (
                // 'id' => 78,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '078',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            78 => 
            array (
                // 'id' => 79,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '079',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            79 => 
            array (
                // 'id' => 80,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '080',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            80 => 
            array (
                // 'id' => 81,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '081',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            81 => 
            array (
                // 'id' => 82,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '082',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            82 => 
            array (
                // 'id' => 83,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '083',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            83 => 
            array (
                // 'id' => 84,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '084',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            84 => 
            array (
                // 'id' => 85,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '085',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            85 => 
            array (
                // 'id' => 86,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '086',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            86 => 
            array (
                // 'id' => 87,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '087',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            87 => 
            array (
                // 'id' => 88,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '088',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            88 => 
            array (
                // 'id' => 89,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '089',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            89 => 
            array (
                // 'id' => 90,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '090',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            90 => 
            array (
                // 'id' => 91,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '091',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            91 => 
            array (
                // 'id' => 92,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '092',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            92 => 
            array (
                // 'id' => 93,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '093',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            93 => 
            array (
                // 'id' => 94,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '094',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            94 => 
            array (
                // 'id' => 95,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '095',
                // 'name' => $faker->word,
                'flag_delete' => true,
            ),
            95 => 
            array (
                // 'id' => 96,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '096',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            96 => 
            array (
                // 'id' => 97,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '097',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            97 => 
            array (
                // 'id' => 98,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '098',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            98 => 
            array (
                // 'id' => 99,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '099',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
            99 => 
            array (
                // 'id' => 100,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                'number' => '100',
                // 'name' => $faker->word,
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pos_cash_desk_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
