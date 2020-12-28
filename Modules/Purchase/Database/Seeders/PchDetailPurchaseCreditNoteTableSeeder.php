<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PchDetailPurchaseCreditNoteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pch_detail_purchase_credit_note')->delete();
        
        \DB::table('pch_detail_purchase_credit_note')->insert(array (
            0 => 
            array (
                'id' => 1,
                'wh_product_id' => 1,
                'pch_purchase_credit_note_id' => 1,
                'quantity' => '487.16',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            1 => 
            array (
                'id' => 2,
                'wh_product_id' => 2,
                'pch_purchase_credit_note_id' => 2,
                'quantity' => '82.71',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            2 => 
            array (
                'id' => 3,
                'wh_product_id' => 3,
                'pch_purchase_credit_note_id' => 3,
                'quantity' => '48.98',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            3 => 
            array (
                'id' => 4,
                'wh_product_id' => 4,
                'pch_purchase_credit_note_id' => 4,
                'quantity' => '21.88',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            4 => 
            array (
                'id' => 5,
                'wh_product_id' => 5,
                'pch_purchase_credit_note_id' => 5,
                'quantity' => '14.91',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            5 => 
            array (
                'id' => 6,
                'wh_product_id' => 6,
                'pch_purchase_credit_note_id' => 6,
                'quantity' => '32.74',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            6 => 
            array (
                'id' => 7,
                'wh_product_id' => 7,
                'pch_purchase_credit_note_id' => 7,
                'quantity' => '18.68',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            7 => 
            array (
                'id' => 8,
                'wh_product_id' => 8,
                'pch_purchase_credit_note_id' => 8,
                'quantity' => '34.51',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            8 => 
            array (
                'id' => 9,
                'wh_product_id' => 9,
                'pch_purchase_credit_note_id' => 9,
                'quantity' => '51.27',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            9 => 
            array (
                'id' => 10,
                'wh_product_id' => 10,
                'pch_purchase_credit_note_id' => 10,
                'quantity' => '12.19',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            10 => 
            array (
                'id' => 11,
                'wh_product_id' => 11,
                'pch_purchase_credit_note_id' => 11,
                'quantity' => '524.17',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            11 => 
            array (
                'id' => 12,
                'wh_product_id' => 12,
                'pch_purchase_credit_note_id' => 12,
                'quantity' => '24.45',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            12 => 
            array (
                'id' => 13,
                'wh_product_id' => 13,
                'pch_purchase_credit_note_id' => 13,
                'quantity' => '20.74',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            13 => 
            array (
                'id' => 14,
                'wh_product_id' => 14,
                'pch_purchase_credit_note_id' => 14,
                'quantity' => '27.01',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            14 => 
            array (
                'id' => 15,
                'wh_product_id' => 15,
                'pch_purchase_credit_note_id' => 15,
                'quantity' => '82.17',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            15 => 
            array (
                'id' => 16,
                'wh_product_id' => 16,
                'pch_purchase_credit_note_id' => 16,
                'quantity' => '29.91',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            16 => 
            array (
                'id' => 17,
                'wh_product_id' => 17,
                'pch_purchase_credit_note_id' => 17,
                'quantity' => '62.63',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            17 => 
            array (
                'id' => 18,
                'wh_product_id' => 18,
                'pch_purchase_credit_note_id' => 18,
                'quantity' => '13.09',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            18 => 
            array (
                'id' => 19,
                'wh_product_id' => 19,
                'pch_purchase_credit_note_id' => 19,
                'quantity' => '17.31',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            19 => 
            array (
                'id' => 20,
                'wh_product_id' => 20,
                'pch_purchase_credit_note_id' => 20,
                'quantity' => '34.76',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            20 => 
            array (
                'id' => 21,
                'wh_product_id' => 21,
                'pch_purchase_credit_note_id' => 21,
                'quantity' => '147.78',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            21 => 
            array (
                'id' => 22,
                'wh_product_id' => 22,
                'pch_purchase_credit_note_id' => 22,
                'quantity' => '26.93',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            22 => 
            array (
                'id' => 23,
                'wh_product_id' => 23,
                'pch_purchase_credit_note_id' => 23,
                'quantity' => '57.84',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            23 => 
            array (
                'id' => 24,
                'wh_product_id' => 24,
                'pch_purchase_credit_note_id' => 24,
                'quantity' => '25.56',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            24 => 
            array (
                'id' => 25,
                'wh_product_id' => 25,
                'pch_purchase_credit_note_id' => 25,
                'quantity' => '13.34',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            25 => 
            array (
                'id' => 26,
                'wh_product_id' => 26,
                'pch_purchase_credit_note_id' => 26,
                'quantity' => '25.89',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            26 => 
            array (
                'id' => 27,
                'wh_product_id' => 27,
                'pch_purchase_credit_note_id' => 27,
                'quantity' => '16.96',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            27 => 
            array (
                'id' => 28,
                'wh_product_id' => 28,
                'pch_purchase_credit_note_id' => 28,
                'quantity' => '39.53',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            28 => 
            array (
                'id' => 29,
                'wh_product_id' => 29,
                'pch_purchase_credit_note_id' => 29,
                'quantity' => '325.47',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            29 => 
            array (
                'id' => 30,
                'wh_product_id' => 30,
                'pch_purchase_credit_note_id' => 30,
                'quantity' => '43.03',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            30 => 
            array (
                'id' => 31,
                'wh_product_id' => 31,
                'pch_purchase_credit_note_id' => 31,
                'quantity' => '16.02',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            31 => 
            array (
                'id' => 32,
                'wh_product_id' => 32,
                'pch_purchase_credit_note_id' => 32,
                'quantity' => '36.14',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            32 => 
            array (
                'id' => 33,
                'wh_product_id' => 33,
                'pch_purchase_credit_note_id' => 33,
                'quantity' => '25.25',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            33 => 
            array (
                'id' => 34,
                'wh_product_id' => 34,
                'pch_purchase_credit_note_id' => 34,
                'quantity' => '19.05',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            34 => 
            array (
                'id' => 35,
                'wh_product_id' => 35,
                'pch_purchase_credit_note_id' => 35,
                'quantity' => '33.93',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            35 => 
            array (
                'id' => 36,
                'wh_product_id' => 36,
                'pch_purchase_credit_note_id' => 36,
                'quantity' => '12.81',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            36 => 
            array (
                'id' => 37,
                'wh_product_id' => 37,
                'pch_purchase_credit_note_id' => 37,
                'quantity' => '41.59',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            37 => 
            array (
                'id' => 38,
                'wh_product_id' => 38,
                'pch_purchase_credit_note_id' => 38,
                'quantity' => '151.03',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            38 => 
            array (
                'id' => 39,
                'wh_product_id' => 39,
                'pch_purchase_credit_note_id' => 39,
                'quantity' => '36.83',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            39 => 
            array (
                'id' => 40,
                'wh_product_id' => 40,
                'pch_purchase_credit_note_id' => 40,
                'quantity' => '16.21',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            40 => 
            array (
                'id' => 41,
                'wh_product_id' => 41,
                'pch_purchase_credit_note_id' => 41,
                'quantity' => '143.41',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            41 => 
            array (
                'id' => 42,
                'wh_product_id' => 42,
                'pch_purchase_credit_note_id' => 42,
                'quantity' => '22.43',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            42 => 
            array (
                'id' => 43,
                'wh_product_id' => 43,
                'pch_purchase_credit_note_id' => 43,
                'quantity' => '62.22',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            43 => 
            array (
                'id' => 44,
                'wh_product_id' => 44,
                'pch_purchase_credit_note_id' => 44,
                'quantity' => '34.48',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            44 => 
            array (
                'id' => 45,
                'wh_product_id' => 45,
                'pch_purchase_credit_note_id' => 45,
                'quantity' => '21.83',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            45 => 
            array (
                'id' => 46,
                'wh_product_id' => 46,
                'pch_purchase_credit_note_id' => 46,
                'quantity' => '13.09',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            46 => 
            array (
                'id' => 47,
                'wh_product_id' => 47,
                'pch_purchase_credit_note_id' => 47,
                'quantity' => '19.94',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            47 => 
            array (
                'id' => 48,
                'wh_product_id' => 48,
                'pch_purchase_credit_note_id' => 48,
                'quantity' => '72.98',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            48 => 
            array (
                'id' => 49,
                'wh_product_id' => 49,
                'pch_purchase_credit_note_id' => 49,
                'quantity' => '373.80',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            49 => 
            array (
                'id' => 50,
                'wh_product_id' => 50,
                'pch_purchase_credit_note_id' => 50,
                'quantity' => '18.47',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            50 => 
            array (
                'id' => 51,
                'wh_product_id' => 51,
                'pch_purchase_credit_note_id' => 51,
                'quantity' => '28.96',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            51 => 
            array (
                'id' => 52,
                'wh_product_id' => 52,
                'pch_purchase_credit_note_id' => 52,
                'quantity' => '1592.18',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            52 => 
            array (
                'id' => 53,
                'wh_product_id' => 53,
                'pch_purchase_credit_note_id' => 53,
                'quantity' => '49.82',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            53 => 
            array (
                'id' => 54,
                'wh_product_id' => 54,
                'pch_purchase_credit_note_id' => 54,
                'quantity' => '55.93',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            54 => 
            array (
                'id' => 55,
                'wh_product_id' => 55,
                'pch_purchase_credit_note_id' => 55,
                'quantity' => '47.59',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            55 => 
            array (
                'id' => 56,
                'wh_product_id' => 56,
                'pch_purchase_credit_note_id' => 56,
                'quantity' => '24.01',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            56 => 
            array (
                'id' => 57,
                'wh_product_id' => 57,
                'pch_purchase_credit_note_id' => 57,
                'quantity' => '24.18',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            57 => 
            array (
                'id' => 58,
                'wh_product_id' => 58,
                'pch_purchase_credit_note_id' => 58,
                'quantity' => '21.05',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            58 => 
            array (
                'id' => 59,
                'wh_product_id' => 59,
                'pch_purchase_credit_note_id' => 59,
                'quantity' => '29.73',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            59 => 
            array (
                'id' => 60,
                'wh_product_id' => 60,
                'pch_purchase_credit_note_id' => 60,
                'quantity' => '34.05',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            60 => 
            array (
                'id' => 61,
                'wh_product_id' => 61,
                'pch_purchase_credit_note_id' => 61,
                'quantity' => '40.73',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            61 => 
            array (
                'id' => 62,
                'wh_product_id' => 62,
                'pch_purchase_credit_note_id' => 62,
                'quantity' => '94.51',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            62 => 
            array (
                'id' => 63,
                'wh_product_id' => 63,
                'pch_purchase_credit_note_id' => 63,
                'quantity' => '35.55',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            63 => 
            array (
                'id' => 64,
                'wh_product_id' => 64,
                'pch_purchase_credit_note_id' => 64,
                'quantity' => '29.34',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            64 => 
            array (
                'id' => 65,
                'wh_product_id' => 65,
                'pch_purchase_credit_note_id' => 65,
                'quantity' => '209.63',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            65 => 
            array (
                'id' => 66,
                'wh_product_id' => 66,
                'pch_purchase_credit_note_id' => 66,
                'quantity' => '27.97',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            66 => 
            array (
                'id' => 67,
                'wh_product_id' => 67,
                'pch_purchase_credit_note_id' => 67,
                'quantity' => '54.69',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            67 => 
            array (
                'id' => 68,
                'wh_product_id' => 68,
                'pch_purchase_credit_note_id' => 68,
                'quantity' => '27.36',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            68 => 
            array (
                'id' => 69,
                'wh_product_id' => 69,
                'pch_purchase_credit_note_id' => 69,
                'quantity' => '60.38',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            69 => 
            array (
                'id' => 70,
                'wh_product_id' => 70,
                'pch_purchase_credit_note_id' => 70,
                'quantity' => '13.22',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            70 => 
            array (
                'id' => 71,
                'wh_product_id' => 71,
                'pch_purchase_credit_note_id' => 71,
                'quantity' => '18.48',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            71 => 
            array (
                'id' => 72,
                'wh_product_id' => 72,
                'pch_purchase_credit_note_id' => 72,
                'quantity' => '26.46',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            72 => 
            array (
                'id' => 73,
                'wh_product_id' => 73,
                'pch_purchase_credit_note_id' => 73,
                'quantity' => '98.01',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            73 => 
            array (
                'id' => 74,
                'wh_product_id' => 74,
                'pch_purchase_credit_note_id' => 74,
                'quantity' => '40.87',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            74 => 
            array (
                'id' => 75,
                'wh_product_id' => 75,
                'pch_purchase_credit_note_id' => 75,
                'quantity' => '12.19',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            75 => 
            array (
                'id' => 76,
                'wh_product_id' => 76,
                'pch_purchase_credit_note_id' => 76,
                'quantity' => '41.89',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            76 => 
            array (
                'id' => 77,
                'wh_product_id' => 77,
                'pch_purchase_credit_note_id' => 77,
                'quantity' => '46.12',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            77 => 
            array (
                'id' => 78,
                'wh_product_id' => 78,
                'pch_purchase_credit_note_id' => 78,
                'quantity' => '67.13',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            78 => 
            array (
                'id' => 79,
                'wh_product_id' => 79,
                'pch_purchase_credit_note_id' => 79,
                'quantity' => '20.01',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            79 => 
            array (
                'id' => 80,
                'wh_product_id' => 80,
                'pch_purchase_credit_note_id' => 80,
                'quantity' => '16.72',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            80 => 
            array (
                'id' => 81,
                'wh_product_id' => 81,
                'pch_purchase_credit_note_id' => 81,
                'quantity' => '18.70',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            81 => 
            array (
                'id' => 82,
                'wh_product_id' => 82,
                'pch_purchase_credit_note_id' => 82,
                'quantity' => '70.22',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            82 => 
            array (
                'id' => 83,
                'wh_product_id' => 83,
                'pch_purchase_credit_note_id' => 83,
                'quantity' => '111.12',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            83 => 
            array (
                'id' => 84,
                'wh_product_id' => 84,
                'pch_purchase_credit_note_id' => 84,
                'quantity' => '52.62',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            84 => 
            array (
                'id' => 85,
                'wh_product_id' => 85,
                'pch_purchase_credit_note_id' => 85,
                'quantity' => '45.15',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            85 => 
            array (
                'id' => 86,
                'wh_product_id' => 86,
                'pch_purchase_credit_note_id' => 86,
                'quantity' => '80.30',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            86 => 
            array (
                'id' => 87,
                'wh_product_id' => 87,
                'pch_purchase_credit_note_id' => 87,
                'quantity' => '26.89',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            87 => 
            array (
                'id' => 88,
                'wh_product_id' => 88,
                'pch_purchase_credit_note_id' => 88,
                'quantity' => '238.97',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            88 => 
            array (
                'id' => 89,
                'wh_product_id' => 89,
                'pch_purchase_credit_note_id' => 89,
                'quantity' => '43.70',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            89 => 
            array (
                'id' => 90,
                'wh_product_id' => 90,
                'pch_purchase_credit_note_id' => 90,
                'quantity' => '24.29',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            90 => 
            array (
                'id' => 91,
                'wh_product_id' => 91,
                'pch_purchase_credit_note_id' => 91,
                'quantity' => '13.08',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            91 => 
            array (
                'id' => 92,
                'wh_product_id' => 92,
                'pch_purchase_credit_note_id' => 92,
                'quantity' => '22.61',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            92 => 
            array (
                'id' => 93,
                'wh_product_id' => 93,
                'pch_purchase_credit_note_id' => 93,
                'quantity' => '24.23',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            93 => 
            array (
                'id' => 94,
                'wh_product_id' => 94,
                'pch_purchase_credit_note_id' => 94,
                'quantity' => '14.40',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            94 => 
            array (
                'id' => 95,
                'wh_product_id' => 95,
                'pch_purchase_credit_note_id' => 95,
                'quantity' => '18.19',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            95 => 
            array (
                'id' => 96,
                'wh_product_id' => 96,
                'pch_purchase_credit_note_id' => 96,
                'quantity' => '111.68',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            96 => 
            array (
                'id' => 97,
                'wh_product_id' => 97,
                'pch_purchase_credit_note_id' => 97,
                'quantity' => '34.40',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            97 => 
            array (
                'id' => 98,
                'wh_product_id' => 98,
                'pch_purchase_credit_note_id' => 98,
                'quantity' => '26.64',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            98 => 
            array (
                'id' => 99,
                'wh_product_id' => 99,
                'pch_purchase_credit_note_id' => 99,
                'quantity' => '13.88',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            99 => 
            array (
                'id' => 100,
                'wh_product_id' => 100,
                'pch_purchase_credit_note_id' => 100,
                'quantity' => '145.12',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_detail_purchase_credit_note')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}