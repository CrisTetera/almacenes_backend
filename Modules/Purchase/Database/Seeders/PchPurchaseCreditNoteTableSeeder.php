<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PchPurchaseCreditNoteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pch_purchase_credit_note')->delete();
        
        \DB::table('pch_purchase_credit_note')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pch_purchase_invoice_id' => 1,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 1,
                'number' => '00000001',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            1 => 
            array (
                'id' => 2,
                'pch_purchase_invoice_id' => 2,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 2,
                'number' => '00000002',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            2 => 
            array (
                'id' => 3,
                'pch_purchase_invoice_id' => 3,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 3,
                'number' => '00000003',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            3 => 
            array (
                'id' => 4,
                'pch_purchase_invoice_id' => 4,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 4,
                'number' => '00000004',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            4 => 
            array (
                'id' => 5,
                'pch_purchase_invoice_id' => 5,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 5,
                'number' => '00000005',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            5 => 
            array (
                'id' => 6,
                'pch_purchase_invoice_id' => 6,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 6,
                'number' => '00000006',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            6 => 
            array (
                'id' => 7,
                'pch_purchase_invoice_id' => 7,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 7,
                'number' => '00000007',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            7 => 
            array (
                'id' => 8,
                'pch_purchase_invoice_id' => 8,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 8,
                'number' => '00000008',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            8 => 
            array (
                'id' => 9,
                'pch_purchase_invoice_id' => 9,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 9,
                'number' => '00000009',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            9 => 
            array (
                'id' => 10,
                'pch_purchase_invoice_id' => 10,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 10,
                'number' => '00000010',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            10 => 
            array (
                'id' => 11,
                'pch_purchase_invoice_id' => 11,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 11,
                'number' => '00000011',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            11 => 
            array (
                'id' => 12,
                'pch_purchase_invoice_id' => 12,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 12,
                'number' => '00000012',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            12 => 
            array (
                'id' => 13,
                'pch_purchase_invoice_id' => 13,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 13,
                'number' => '00000013',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            13 => 
            array (
                'id' => 14,
                'pch_purchase_invoice_id' => 14,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 14,
                'number' => '00000014',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            14 => 
            array (
                'id' => 15,
                'pch_purchase_invoice_id' => 15,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 15,
                'number' => '00000015',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            15 => 
            array (
                'id' => 16,
                'pch_purchase_invoice_id' => 16,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 16,
                'number' => '00000016',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            16 => 
            array (
                'id' => 17,
                'pch_purchase_invoice_id' => 17,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 17,
                'number' => '00000017',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            17 => 
            array (
                'id' => 18,
                'pch_purchase_invoice_id' => 18,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 18,
                'number' => '00000018',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            18 => 
            array (
                'id' => 19,
                'pch_purchase_invoice_id' => 19,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 19,
                'number' => '00000019',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            19 => 
            array (
                'id' => 20,
                'pch_purchase_invoice_id' => 20,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 20,
                'number' => '00000020',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            20 => 
            array (
                'id' => 21,
                'pch_purchase_invoice_id' => 21,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 21,
                'number' => '00000021',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            21 => 
            array (
                'id' => 22,
                'pch_purchase_invoice_id' => 22,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 22,
                'number' => '00000022',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            22 => 
            array (
                'id' => 23,
                'pch_purchase_invoice_id' => 23,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 23,
                'number' => '00000023',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            23 => 
            array (
                'id' => 24,
                'pch_purchase_invoice_id' => 24,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 24,
                'number' => '00000024',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            24 => 
            array (
                'id' => 25,
                'pch_purchase_invoice_id' => 25,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 25,
                'number' => '00000025',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            25 => 
            array (
                'id' => 26,
                'pch_purchase_invoice_id' => 26,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 26,
                'number' => '00000026',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            26 => 
            array (
                'id' => 27,
                'pch_purchase_invoice_id' => 27,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 27,
                'number' => '00000027',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            27 => 
            array (
                'id' => 28,
                'pch_purchase_invoice_id' => 28,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 28,
                'number' => '00000028',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            28 => 
            array (
                'id' => 29,
                'pch_purchase_invoice_id' => 29,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 29,
                'number' => '00000029',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            29 => 
            array (
                'id' => 30,
                'pch_purchase_invoice_id' => 30,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 30,
                'number' => '00000030',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            30 => 
            array (
                'id' => 31,
                'pch_purchase_invoice_id' => 31,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 31,
                'number' => '00000031',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            31 => 
            array (
                'id' => 32,
                'pch_purchase_invoice_id' => 32,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 32,
                'number' => '00000032',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            32 => 
            array (
                'id' => 33,
                'pch_purchase_invoice_id' => 33,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 33,
                'number' => '00000033',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            33 => 
            array (
                'id' => 34,
                'pch_purchase_invoice_id' => 34,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 34,
                'number' => '00000034',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            34 => 
            array (
                'id' => 35,
                'pch_purchase_invoice_id' => 35,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 35,
                'number' => '00000035',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            35 => 
            array (
                'id' => 36,
                'pch_purchase_invoice_id' => 36,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 36,
                'number' => '00000036',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            36 => 
            array (
                'id' => 37,
                'pch_purchase_invoice_id' => 37,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 37,
                'number' => '00000037',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            37 => 
            array (
                'id' => 38,
                'pch_purchase_invoice_id' => 38,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 38,
                'number' => '00000038',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            38 => 
            array (
                'id' => 39,
                'pch_purchase_invoice_id' => 39,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 39,
                'number' => '00000039',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            39 => 
            array (
                'id' => 40,
                'pch_purchase_invoice_id' => 40,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 40,
                'number' => '00000040',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            40 => 
            array (
                'id' => 41,
                'pch_purchase_invoice_id' => 41,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 41,
                'number' => '00000041',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            41 => 
            array (
                'id' => 42,
                'pch_purchase_invoice_id' => 42,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 42,
                'number' => '00000042',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            42 => 
            array (
                'id' => 43,
                'pch_purchase_invoice_id' => 43,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 43,
                'number' => '00000043',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            43 => 
            array (
                'id' => 44,
                'pch_purchase_invoice_id' => 44,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 44,
                'number' => '00000044',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            44 => 
            array (
                'id' => 45,
                'pch_purchase_invoice_id' => 45,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 45,
                'number' => '00000045',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            45 => 
            array (
                'id' => 46,
                'pch_purchase_invoice_id' => 46,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 46,
                'number' => '00000046',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            46 => 
            array (
                'id' => 47,
                'pch_purchase_invoice_id' => 47,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 47,
                'number' => '00000047',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            47 => 
            array (
                'id' => 48,
                'pch_purchase_invoice_id' => 48,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 48,
                'number' => '00000048',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            48 => 
            array (
                'id' => 49,
                'pch_purchase_invoice_id' => 49,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 49,
                'number' => '00000049',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            49 => 
            array (
                'id' => 50,
                'pch_purchase_invoice_id' => 50,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 50,
                'number' => '00000050',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            50 => 
            array (
                'id' => 51,
                'pch_purchase_invoice_id' => 51,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 51,
                'number' => '00000051',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            51 => 
            array (
                'id' => 52,
                'pch_purchase_invoice_id' => 52,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 52,
                'number' => '00000052',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            52 => 
            array (
                'id' => 53,
                'pch_purchase_invoice_id' => 53,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 53,
                'number' => '00000053',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            53 => 
            array (
                'id' => 54,
                'pch_purchase_invoice_id' => 54,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 54,
                'number' => '00000054',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            54 => 
            array (
                'id' => 55,
                'pch_purchase_invoice_id' => 55,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 55,
                'number' => '00000055',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            55 => 
            array (
                'id' => 56,
                'pch_purchase_invoice_id' => 56,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 56,
                'number' => '00000056',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            56 => 
            array (
                'id' => 57,
                'pch_purchase_invoice_id' => 57,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 57,
                'number' => '00000057',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            57 => 
            array (
                'id' => 58,
                'pch_purchase_invoice_id' => 58,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 58,
                'number' => '00000058',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            58 => 
            array (
                'id' => 59,
                'pch_purchase_invoice_id' => 59,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 59,
                'number' => '00000059',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            59 => 
            array (
                'id' => 60,
                'pch_purchase_invoice_id' => 60,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 60,
                'number' => '00000060',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            60 => 
            array (
                'id' => 61,
                'pch_purchase_invoice_id' => 61,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 61,
                'number' => '00000061',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            61 => 
            array (
                'id' => 62,
                'pch_purchase_invoice_id' => 62,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 62,
                'number' => '00000062',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            62 => 
            array (
                'id' => 63,
                'pch_purchase_invoice_id' => 63,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 63,
                'number' => '00000063',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            63 => 
            array (
                'id' => 64,
                'pch_purchase_invoice_id' => 64,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 64,
                'number' => '00000064',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            64 => 
            array (
                'id' => 65,
                'pch_purchase_invoice_id' => 65,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 65,
                'number' => '00000065',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            65 => 
            array (
                'id' => 66,
                'pch_purchase_invoice_id' => 66,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 66,
                'number' => '00000066',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            66 => 
            array (
                'id' => 67,
                'pch_purchase_invoice_id' => 67,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 67,
                'number' => '00000067',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            67 => 
            array (
                'id' => 68,
                'pch_purchase_invoice_id' => 68,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 68,
                'number' => '00000068',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            68 => 
            array (
                'id' => 69,
                'pch_purchase_invoice_id' => 69,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 69,
                'number' => '00000069',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            69 => 
            array (
                'id' => 70,
                'pch_purchase_invoice_id' => 70,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 70,
                'number' => '00000070',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            70 => 
            array (
                'id' => 71,
                'pch_purchase_invoice_id' => 71,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 71,
                'number' => '00000071',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            71 => 
            array (
                'id' => 72,
                'pch_purchase_invoice_id' => 72,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 72,
                'number' => '00000072',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            72 => 
            array (
                'id' => 73,
                'pch_purchase_invoice_id' => 73,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 73,
                'number' => '00000073',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            73 => 
            array (
                'id' => 74,
                'pch_purchase_invoice_id' => 74,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 74,
                'number' => '00000074',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            74 => 
            array (
                'id' => 75,
                'pch_purchase_invoice_id' => 75,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 75,
                'number' => '00000075',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            75 => 
            array (
                'id' => 76,
                'pch_purchase_invoice_id' => 76,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 76,
                'number' => '00000076',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            76 => 
            array (
                'id' => 77,
                'pch_purchase_invoice_id' => 77,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 77,
                'number' => '00000077',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            77 => 
            array (
                'id' => 78,
                'pch_purchase_invoice_id' => 78,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 78,
                'number' => '00000078',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            78 => 
            array (
                'id' => 79,
                'pch_purchase_invoice_id' => 79,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 79,
                'number' => '00000079',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            79 => 
            array (
                'id' => 80,
                'pch_purchase_invoice_id' => 80,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 80,
                'number' => '00000080',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            80 => 
            array (
                'id' => 81,
                'pch_purchase_invoice_id' => 81,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 81,
                'number' => '00000081',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            81 => 
            array (
                'id' => 82,
                'pch_purchase_invoice_id' => 82,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 82,
                'number' => '00000082',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            82 => 
            array (
                'id' => 83,
                'pch_purchase_invoice_id' => 83,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 83,
                'number' => '00000083',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            83 => 
            array (
                'id' => 84,
                'pch_purchase_invoice_id' => 84,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 84,
                'number' => '00000084',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            84 => 
            array (
                'id' => 85,
                'pch_purchase_invoice_id' => 85,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 85,
                'number' => '00000085',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            85 => 
            array (
                'id' => 86,
                'pch_purchase_invoice_id' => 86,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 86,
                'number' => '00000086',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            86 => 
            array (
                'id' => 87,
                'pch_purchase_invoice_id' => 87,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 87,
                'number' => '00000087',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            87 => 
            array (
                'id' => 88,
                'pch_purchase_invoice_id' => 88,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 88,
                'number' => '00000088',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            88 => 
            array (
                'id' => 89,
                'pch_purchase_invoice_id' => 89,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 89,
                'number' => '00000089',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            89 => 
            array (
                'id' => 90,
                'pch_purchase_invoice_id' => 90,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 90,
                'number' => '00000090',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            90 => 
            array (
                'id' => 91,
                'pch_purchase_invoice_id' => 91,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 91,
                'number' => '00000091',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            91 => 
            array (
                'id' => 92,
                'pch_purchase_invoice_id' => 92,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 92,
                'number' => '00000092',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            92 => 
            array (
                'id' => 93,
                'pch_purchase_invoice_id' => 93,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 93,
                'number' => '00000093',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            93 => 
            array (
                'id' => 94,
                'pch_purchase_invoice_id' => 94,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 94,
                'number' => '00000094',
                'core_business' => $faker->sentence(8),
                'flag_delete' => false,
            ),
            94 => 
            array (
                'id' => 95,
                'pch_purchase_invoice_id' => 95,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 95,
                'number' => '00000095',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            95 => 
            array (
                'id' => 96,
                'pch_purchase_invoice_id' => 96,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 96,
                'number' => '00000096',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            96 => 
            array (
                'id' => 97,
                'pch_purchase_invoice_id' => 97,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 97,
                'number' => '00000097',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            97 => 
            array (
                'id' => 98,
                'pch_purchase_invoice_id' => 98,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 98,
                'number' => '00000098',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            98 => 
            array (
                'id' => 99,
                'pch_purchase_invoice_id' => 99,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 99,
                'number' => '00000099',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
            99 => 
            array (
                'id' => 100,
                'pch_purchase_invoice_id' => 100,
                'g_commune_id' => $faker->numberBetween(1, 346),
                'pch_provider_account_movement_id' => 100,
                'number' => '00000100',
                'core_business' => $faker->sentence(8),
                'flag_delete' => true,
            ),
        ));

                
        $now = \Carbon\Carbon::now();
        \DB::table('pch_purchase_credit_note')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}