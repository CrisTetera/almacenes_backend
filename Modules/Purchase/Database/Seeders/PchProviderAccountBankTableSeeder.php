<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PchProviderAccountBankTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pch_provider_account_bank')->delete();
        
        \DB::table('pch_provider_account_bank')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pch_provider_id' => 1,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000001',
                'flag_delete' => false,
            ),
            1 => 
            array (
                'id' => 2,
                'pch_provider_id' => 2,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000002',
                'flag_delete' => true,
            ),
            2 => 
            array (
                'id' => 3,
                'pch_provider_id' => 3,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000003',
                'flag_delete' => false,
            ),
            3 => 
            array (
                'id' => 4,
                'pch_provider_id' => 4,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000004',
                'flag_delete' => true,
            ),
            4 => 
            array (
                'id' => 5,
                'pch_provider_id' => 5,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000005',
                'flag_delete' => true,
            ),
            5 => 
            array (
                'id' => 6,
                'pch_provider_id' => 6,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000006',
                'flag_delete' => true,
            ),
            6 => 
            array (
                'id' => 7,
                'pch_provider_id' => 7,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000007',
                'flag_delete' => true,
            ),
            7 => 
            array (
                'id' => 8,
                'pch_provider_id' => 8,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000008',
                'flag_delete' => true,
            ),
            8 => 
            array (
                'id' => 9,
                'pch_provider_id' => 9,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000009',
                'flag_delete' => true,
            ),
            9 => 
            array (
                'id' => 10,
                'pch_provider_id' => 10,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000010',
                'flag_delete' => true,
            ),
            10 => 
            array (
                'id' => 11,
                'pch_provider_id' => 11,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000011',
                'flag_delete' => true,
            ),
            11 => 
            array (
                'id' => 12,
                'pch_provider_id' => 12,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000012',
                'flag_delete' => true,
            ),
            12 => 
            array (
                'id' => 13,
                'pch_provider_id' => 13,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000013',
                'flag_delete' => true,
            ),
            13 => 
            array (
                'id' => 14,
                'pch_provider_id' => 14,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000014',
                'flag_delete' => true,
            ),
            14 => 
            array (
                'id' => 15,
                'pch_provider_id' => 15,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000015',
                'flag_delete' => true,
            ),
            15 => 
            array (
                'id' => 16,
                'pch_provider_id' => 16,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000016',
                'flag_delete' => false,
            ),
            16 => 
            array (
                'id' => 17,
                'pch_provider_id' => 17,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000017',
                'flag_delete' => true,
            ),
            17 => 
            array (
                'id' => 18,
                'pch_provider_id' => 18,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000018',
                'flag_delete' => true,
            ),
            18 => 
            array (
                'id' => 19,
                'pch_provider_id' => 19,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000019',
                'flag_delete' => true,
            ),
            19 => 
            array (
                'id' => 20,
                'pch_provider_id' => 20,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000020',
                'flag_delete' => true,
            ),
            20 => 
            array (
                'id' => 21,
                'pch_provider_id' => 21,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000021',
                'flag_delete' => true,
            ),
            21 => 
            array (
                'id' => 22,
                'pch_provider_id' => 22,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000022',
                'flag_delete' => true,
            ),
            22 => 
            array (
                'id' => 23,
                'pch_provider_id' => 23,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000023',
                'flag_delete' => true,
            ),
            23 => 
            array (
                'id' => 24,
                'pch_provider_id' => 24,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000024',
                'flag_delete' => true,
            ),
            24 => 
            array (
                'id' => 25,
                'pch_provider_id' => 25,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000025',
                'flag_delete' => true,
            ),
            25 => 
            array (
                'id' => 26,
                'pch_provider_id' => 26,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000026',
                'flag_delete' => false,
            ),
            26 => 
            array (
                'id' => 27,
                'pch_provider_id' => 27,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000027',
                'flag_delete' => false,
            ),
            27 => 
            array (
                'id' => 28,
                'pch_provider_id' => 28,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000028',
                'flag_delete' => false,
            ),
            28 => 
            array (
                'id' => 29,
                'pch_provider_id' => 29,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000029',
                'flag_delete' => true,
            ),
            29 => 
            array (
                'id' => 30,
                'pch_provider_id' => 30,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000030',
                'flag_delete' => false,
            ),
            30 => 
            array (
                'id' => 31,
                'pch_provider_id' => 31,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000031',
                'flag_delete' => false,
            ),
            31 => 
            array (
                'id' => 32,
                'pch_provider_id' => 32,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000032',
                'flag_delete' => false,
            ),
            32 => 
            array (
                'id' => 33,
                'pch_provider_id' => 33,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000033',
                'flag_delete' => true,
            ),
            33 => 
            array (
                'id' => 34,
                'pch_provider_id' => 34,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000034',
                'flag_delete' => false,
            ),
            34 => 
            array (
                'id' => 35,
                'pch_provider_id' => 35,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000035',
                'flag_delete' => false,
            ),
            35 => 
            array (
                'id' => 36,
                'pch_provider_id' => 36,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000036',
                'flag_delete' => true,
            ),
            36 => 
            array (
                'id' => 37,
                'pch_provider_id' => 37,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000037',
                'flag_delete' => true,
            ),
            37 => 
            array (
                'id' => 38,
                'pch_provider_id' => 38,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000038',
                'flag_delete' => true,
            ),
            38 => 
            array (
                'id' => 39,
                'pch_provider_id' => 39,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000039',
                'flag_delete' => false,
            ),
            39 => 
            array (
                'id' => 40,
                'pch_provider_id' => 40,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000040',
                'flag_delete' => false,
            ),
            40 => 
            array (
                'id' => 41,
                'pch_provider_id' => 41,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000041',
                'flag_delete' => false,
            ),
            41 => 
            array (
                'id' => 42,
                'pch_provider_id' => 42,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000042',
                'flag_delete' => true,
            ),
            42 => 
            array (
                'id' => 43,
                'pch_provider_id' => 43,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000043',
                'flag_delete' => false,
            ),
            43 => 
            array (
                'id' => 44,
                'pch_provider_id' => 44,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000044',
                'flag_delete' => true,
            ),
            44 => 
            array (
                'id' => 45,
                'pch_provider_id' => 45,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000045',
                'flag_delete' => false,
            ),
            45 => 
            array (
                'id' => 46,
                'pch_provider_id' => 46,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000046',
                'flag_delete' => false,
            ),
            46 => 
            array (
                'id' => 47,
                'pch_provider_id' => 47,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000047',
                'flag_delete' => false,
            ),
            47 => 
            array (
                'id' => 48,
                'pch_provider_id' => 48,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000048',
                'flag_delete' => true,
            ),
            48 => 
            array (
                'id' => 49,
                'pch_provider_id' => 49,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000049',
                'flag_delete' => false,
            ),
            49 => 
            array (
                'id' => 50,
                'pch_provider_id' => 50,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000050',
                'flag_delete' => false,
            ),
            50 => 
            array (
                'id' => 51,
                'pch_provider_id' => 51,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000051',
                'flag_delete' => false,
            ),
            51 => 
            array (
                'id' => 52,
                'pch_provider_id' => 52,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000052',
                'flag_delete' => false,
            ),
            52 => 
            array (
                'id' => 53,
                'pch_provider_id' => 53,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000053',
                'flag_delete' => false,
            ),
            53 => 
            array (
                'id' => 54,
                'pch_provider_id' => 54,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000054',
                'flag_delete' => false,
            ),
            54 => 
            array (
                'id' => 55,
                'pch_provider_id' => 55,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000055',
                'flag_delete' => false,
            ),
            55 => 
            array (
                'id' => 56,
                'pch_provider_id' => 56,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000056',
                'flag_delete' => true,
            ),
            56 => 
            array (
                'id' => 57,
                'pch_provider_id' => 57,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000057',
                'flag_delete' => false,
            ),
            57 => 
            array (
                'id' => 58,
                'pch_provider_id' => 58,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000058',
                'flag_delete' => false,
            ),
            58 => 
            array (
                'id' => 59,
                'pch_provider_id' => 59,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000059',
                'flag_delete' => false,
            ),
            59 => 
            array (
                'id' => 60,
                'pch_provider_id' => 60,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000060',
                'flag_delete' => false,
            ),
            60 => 
            array (
                'id' => 61,
                'pch_provider_id' => 61,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000061',
                'flag_delete' => false,
            ),
            61 => 
            array (
                'id' => 62,
                'pch_provider_id' => 62,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000062',
                'flag_delete' => true,
            ),
            62 => 
            array (
                'id' => 63,
                'pch_provider_id' => 63,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000063',
                'flag_delete' => false,
            ),
            63 => 
            array (
                'id' => 64,
                'pch_provider_id' => 64,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000064',
                'flag_delete' => false,
            ),
            64 => 
            array (
                'id' => 65,
                'pch_provider_id' => 65,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000065',
                'flag_delete' => false,
            ),
            65 => 
            array (
                'id' => 66,
                'pch_provider_id' => 66,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000066',
                'flag_delete' => false,
            ),
            66 => 
            array (
                'id' => 67,
                'pch_provider_id' => 67,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000067',
                'flag_delete' => false,
            ),
            67 => 
            array (
                'id' => 68,
                'pch_provider_id' => 68,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000068',
                'flag_delete' => true,
            ),
            68 => 
            array (
                'id' => 69,
                'pch_provider_id' => 69,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000069',
                'flag_delete' => false,
            ),
            69 => 
            array (
                'id' => 70,
                'pch_provider_id' => 70,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000070',
                'flag_delete' => true,
            ),
            70 => 
            array (
                'id' => 71,
                'pch_provider_id' => 71,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000071',
                'flag_delete' => true,
            ),
            71 => 
            array (
                'id' => 72,
                'pch_provider_id' => 72,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000072',
                'flag_delete' => false,
            ),
            72 => 
            array (
                'id' => 73,
                'pch_provider_id' => 73,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000073',
                'flag_delete' => true,
            ),
            73 => 
            array (
                'id' => 74,
                'pch_provider_id' => 74,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000074',
                'flag_delete' => false,
            ),
            74 => 
            array (
                'id' => 75,
                'pch_provider_id' => 75,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000075',
                'flag_delete' => true,
            ),
            75 => 
            array (
                'id' => 76,
                'pch_provider_id' => 76,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000076',
                'flag_delete' => false,
            ),
            76 => 
            array (
                'id' => 77,
                'pch_provider_id' => 77,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000077',
                'flag_delete' => false,
            ),
            77 => 
            array (
                'id' => 78,
                'pch_provider_id' => 78,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000078',
                'flag_delete' => true,
            ),
            78 => 
            array (
                'id' => 79,
                'pch_provider_id' => 79,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000079',
                'flag_delete' => false,
            ),
            79 => 
            array (
                'id' => 80,
                'pch_provider_id' => 80,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000080',
                'flag_delete' => true,
            ),
            80 => 
            array (
                'id' => 81,
                'pch_provider_id' => 81,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000081',
                'flag_delete' => false,
            ),
            81 => 
            array (
                'id' => 82,
                'pch_provider_id' => 82,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000082',
                'flag_delete' => true,
            ),
            82 => 
            array (
                'id' => 83,
                'pch_provider_id' => 83,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000083',
                'flag_delete' => true,
            ),
            83 => 
            array (
                'id' => 84,
                'pch_provider_id' => 84,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000084',
                'flag_delete' => false,
            ),
            84 => 
            array (
                'id' => 85,
                'pch_provider_id' => 85,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000085',
                'flag_delete' => true,
            ),
            85 => 
            array (
                'id' => 86,
                'pch_provider_id' => 86,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000086',
                'flag_delete' => true,
            ),
            86 => 
            array (
                'id' => 87,
                'pch_provider_id' => 87,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000087',
                'flag_delete' => false,
            ),
            87 => 
            array (
                'id' => 88,
                'pch_provider_id' => 88,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000088',
                'flag_delete' => true,
            ),
            88 => 
            array (
                'id' => 89,
                'pch_provider_id' => 89,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000089',
                'flag_delete' => false,
            ),
            89 => 
            array (
                'id' => 90,
                'pch_provider_id' => 90,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000090',
                'flag_delete' => true,
            ),
            90 => 
            array (
                'id' => 91,
                'pch_provider_id' => 91,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000091',
                'flag_delete' => true,
            ),
            91 => 
            array (
                'id' => 92,
                'pch_provider_id' => 92,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000092',
                'flag_delete' => false,
            ),
            92 => 
            array (
                'id' => 93,
                'pch_provider_id' => 93,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000093',
                'flag_delete' => true,
            ),
            93 => 
            array (
                'id' => 94,
                'pch_provider_id' => 94,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000094',
                'flag_delete' => true,
            ),
            94 => 
            array (
                'id' => 95,
                'pch_provider_id' => 95,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000095',
                'flag_delete' => true,
            ),
            95 => 
            array (
                'id' => 96,
                'pch_provider_id' => 96,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000096',
                'flag_delete' => true,
            ),
            96 => 
            array (
                'id' => 97,
                'pch_provider_id' => 97,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000097',
                'flag_delete' => true,
            ),
            97 => 
            array (
                'id' => 98,
                'pch_provider_id' => 98,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000098',
                'flag_delete' => false,
            ),
            98 => 
            array (
                'id' => 99,
                'pch_provider_id' => 99,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000099',
                'flag_delete' => false,
            ),
            99 => 
            array (
                'id' => 100,
                'pch_provider_id' => 100,
                'g_bank_id' => $faker->numberBetween(1, 14),
                'g_type_account_bank_id' => $faker->numberBetween(1, 4),
                'account_number' => '0000000100',
                'flag_delete' => true,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_provider_account_bank')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}