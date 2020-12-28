<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PchDetailPurchaseInvoiceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pch_detail_purchase_invoice')->delete();
        
        \DB::table('pch_detail_purchase_invoice')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pch_purchase_invoice_id' => 1,
                'wh_product_id' => 1,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            1 => 
            array (
                'id' => 2,
                'pch_purchase_invoice_id' => 2,
                'wh_product_id' => 2,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            2 => 
            array (
                'id' => 3,
                'pch_purchase_invoice_id' => 3,
                'wh_product_id' => 3,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            3 => 
            array (
                'id' => 4,
                'pch_purchase_invoice_id' => 4,
                'wh_product_id' => 4,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            4 => 
            array (
                'id' => 5,
                'pch_purchase_invoice_id' => 5,
                'wh_product_id' => 5,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            5 => 
            array (
                'id' => 6,
                'pch_purchase_invoice_id' => 6,
                'wh_product_id' => 6,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            6 => 
            array (
                'id' => 7,
                'pch_purchase_invoice_id' => 7,
                'wh_product_id' => 7,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            7 => 
            array (
                'id' => 8,
                'pch_purchase_invoice_id' => 8,
                'wh_product_id' => 8,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            8 => 
            array (
                'id' => 9,
                'pch_purchase_invoice_id' => 9,
                'wh_product_id' => 9,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            9 => 
            array (
                'id' => 10,
                'pch_purchase_invoice_id' => 10,
                'wh_product_id' => 10,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            10 => 
            array (
                'id' => 11,
                'pch_purchase_invoice_id' => 11,
                'wh_product_id' => 11,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            11 => 
            array (
                'id' => 12,
                'pch_purchase_invoice_id' => 12,
                'wh_product_id' => 12,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            12 => 
            array (
                'id' => 13,
                'pch_purchase_invoice_id' => 13,
                'wh_product_id' => 13,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            13 => 
            array (
                'id' => 14,
                'pch_purchase_invoice_id' => 14,
                'wh_product_id' => 14,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            14 => 
            array (
                'id' => 15,
                'pch_purchase_invoice_id' => 15,
                'wh_product_id' => 15,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            15 => 
            array (
                'id' => 16,
                'pch_purchase_invoice_id' => 16,
                'wh_product_id' => 16,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            16 => 
            array (
                'id' => 17,
                'pch_purchase_invoice_id' => 17,
                'wh_product_id' => 17,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            17 => 
            array (
                'id' => 18,
                'pch_purchase_invoice_id' => 18,
                'wh_product_id' => 18,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            18 => 
            array (
                'id' => 19,
                'pch_purchase_invoice_id' => 19,
                'wh_product_id' => 19,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            19 => 
            array (
                'id' => 20,
                'pch_purchase_invoice_id' => 20,
                'wh_product_id' => 20,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            20 => 
            array (
                'id' => 21,
                'pch_purchase_invoice_id' => 21,
                'wh_product_id' => 21,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            21 => 
            array (
                'id' => 22,
                'pch_purchase_invoice_id' => 22,
                'wh_product_id' => 22,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            22 => 
            array (
                'id' => 23,
                'pch_purchase_invoice_id' => 23,
                'wh_product_id' => 23,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            23 => 
            array (
                'id' => 24,
                'pch_purchase_invoice_id' => 24,
                'wh_product_id' => 24,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            24 => 
            array (
                'id' => 25,
                'pch_purchase_invoice_id' => 25,
                'wh_product_id' => 25,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            25 => 
            array (
                'id' => 26,
                'pch_purchase_invoice_id' => 26,
                'wh_product_id' => 26,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            26 => 
            array (
                'id' => 27,
                'pch_purchase_invoice_id' => 27,
                'wh_product_id' => 27,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            27 => 
            array (
                'id' => 28,
                'pch_purchase_invoice_id' => 28,
                'wh_product_id' => 28,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            28 => 
            array (
                'id' => 29,
                'pch_purchase_invoice_id' => 29,
                'wh_product_id' => 29,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            29 => 
            array (
                'id' => 30,
                'pch_purchase_invoice_id' => 30,
                'wh_product_id' => 30,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            30 => 
            array (
                'id' => 31,
                'pch_purchase_invoice_id' => 31,
                'wh_product_id' => 31,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            31 => 
            array (
                'id' => 32,
                'pch_purchase_invoice_id' => 32,
                'wh_product_id' => 32,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            32 => 
            array (
                'id' => 33,
                'pch_purchase_invoice_id' => 33,
                'wh_product_id' => 33,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            33 => 
            array (
                'id' => 34,
                'pch_purchase_invoice_id' => 34,
                'wh_product_id' => 34,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            34 => 
            array (
                'id' => 35,
                'pch_purchase_invoice_id' => 35,
                'wh_product_id' => 35,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            35 => 
            array (
                'id' => 36,
                'pch_purchase_invoice_id' => 36,
                'wh_product_id' => 36,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            36 => 
            array (
                'id' => 37,
                'pch_purchase_invoice_id' => 37,
                'wh_product_id' => 37,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            37 => 
            array (
                'id' => 38,
                'pch_purchase_invoice_id' => 38,
                'wh_product_id' => 38,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            38 => 
            array (
                'id' => 39,
                'pch_purchase_invoice_id' => 39,
                'wh_product_id' => 39,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            39 => 
            array (
                'id' => 40,
                'pch_purchase_invoice_id' => 40,
                'wh_product_id' => 40,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            40 => 
            array (
                'id' => 41,
                'pch_purchase_invoice_id' => 41,
                'wh_product_id' => 41,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            41 => 
            array (
                'id' => 42,
                'pch_purchase_invoice_id' => 42,
                'wh_product_id' => 42,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            42 => 
            array (
                'id' => 43,
                'pch_purchase_invoice_id' => 43,
                'wh_product_id' => 43,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            43 => 
            array (
                'id' => 44,
                'pch_purchase_invoice_id' => 44,
                'wh_product_id' => 44,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            44 => 
            array (
                'id' => 45,
                'pch_purchase_invoice_id' => 45,
                'wh_product_id' => 45,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            45 => 
            array (
                'id' => 46,
                'pch_purchase_invoice_id' => 46,
                'wh_product_id' => 46,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            46 => 
            array (
                'id' => 47,
                'pch_purchase_invoice_id' => 47,
                'wh_product_id' => 47,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            47 => 
            array (
                'id' => 48,
                'pch_purchase_invoice_id' => 48,
                'wh_product_id' => 48,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            48 => 
            array (
                'id' => 49,
                'pch_purchase_invoice_id' => 49,
                'wh_product_id' => 49,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            49 => 
            array (
                'id' => 50,
                'pch_purchase_invoice_id' => 50,
                'wh_product_id' => 50,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            50 => 
            array (
                'id' => 51,
                'pch_purchase_invoice_id' => 51,
                'wh_product_id' => 51,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            51 => 
            array (
                'id' => 52,
                'pch_purchase_invoice_id' => 52,
                'wh_product_id' => 52,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            52 => 
            array (
                'id' => 53,
                'pch_purchase_invoice_id' => 53,
                'wh_product_id' => 53,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            53 => 
            array (
                'id' => 54,
                'pch_purchase_invoice_id' => 54,
                'wh_product_id' => 54,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            54 => 
            array (
                'id' => 55,
                'pch_purchase_invoice_id' => 55,
                'wh_product_id' => 55,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            55 => 
            array (
                'id' => 56,
                'pch_purchase_invoice_id' => 56,
                'wh_product_id' => 56,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            56 => 
            array (
                'id' => 57,
                'pch_purchase_invoice_id' => 57,
                'wh_product_id' => 57,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            57 => 
            array (
                'id' => 58,
                'pch_purchase_invoice_id' => 58,
                'wh_product_id' => 58,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            58 => 
            array (
                'id' => 59,
                'pch_purchase_invoice_id' => 59,
                'wh_product_id' => 59,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            59 => 
            array (
                'id' => 60,
                'pch_purchase_invoice_id' => 60,
                'wh_product_id' => 60,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            60 => 
            array (
                'id' => 61,
                'pch_purchase_invoice_id' => 61,
                'wh_product_id' => 61,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            61 => 
            array (
                'id' => 62,
                'pch_purchase_invoice_id' => 62,
                'wh_product_id' => 62,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            62 => 
            array (
                'id' => 63,
                'pch_purchase_invoice_id' => 63,
                'wh_product_id' => 63,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            63 => 
            array (
                'id' => 64,
                'pch_purchase_invoice_id' => 64,
                'wh_product_id' => 64,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            64 => 
            array (
                'id' => 65,
                'pch_purchase_invoice_id' => 65,
                'wh_product_id' => 65,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            65 => 
            array (
                'id' => 66,
                'pch_purchase_invoice_id' => 66,
                'wh_product_id' => 66,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            66 => 
            array (
                'id' => 67,
                'pch_purchase_invoice_id' => 67,
                'wh_product_id' => 67,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            67 => 
            array (
                'id' => 68,
                'pch_purchase_invoice_id' => 68,
                'wh_product_id' => 68,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            68 => 
            array (
                'id' => 69,
                'pch_purchase_invoice_id' => 69,
                'wh_product_id' => 69,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            69 => 
            array (
                'id' => 70,
                'pch_purchase_invoice_id' => 70,
                'wh_product_id' => 70,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            70 => 
            array (
                'id' => 71,
                'pch_purchase_invoice_id' => 71,
                'wh_product_id' => 71,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            71 => 
            array (
                'id' => 72,
                'pch_purchase_invoice_id' => 72,
                'wh_product_id' => 72,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            72 => 
            array (
                'id' => 73,
                'pch_purchase_invoice_id' => 73,
                'wh_product_id' => 73,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            73 => 
            array (
                'id' => 74,
                'pch_purchase_invoice_id' => 74,
                'wh_product_id' => 74,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            74 => 
            array (
                'id' => 75,
                'pch_purchase_invoice_id' => 75,
                'wh_product_id' => 75,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            75 => 
            array (
                'id' => 76,
                'pch_purchase_invoice_id' => 76,
                'wh_product_id' => 76,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            76 => 
            array (
                'id' => 77,
                'pch_purchase_invoice_id' => 77,
                'wh_product_id' => 77,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            77 => 
            array (
                'id' => 78,
                'pch_purchase_invoice_id' => 78,
                'wh_product_id' => 78,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            78 => 
            array (
                'id' => 79,
                'pch_purchase_invoice_id' => 79,
                'wh_product_id' => 79,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            79 => 
            array (
                'id' => 80,
                'pch_purchase_invoice_id' => 80,
                'wh_product_id' => 80,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            80 => 
            array (
                'id' => 81,
                'pch_purchase_invoice_id' => 81,
                'wh_product_id' => 81,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            81 => 
            array (
                'id' => 82,
                'pch_purchase_invoice_id' => 82,
                'wh_product_id' => 82,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            82 => 
            array (
                'id' => 83,
                'pch_purchase_invoice_id' => 83,
                'wh_product_id' => 83,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            83 => 
            array (
                'id' => 84,
                'pch_purchase_invoice_id' => 84,
                'wh_product_id' => 84,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            84 => 
            array (
                'id' => 85,
                'pch_purchase_invoice_id' => 85,
                'wh_product_id' => 85,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            85 => 
            array (
                'id' => 86,
                'pch_purchase_invoice_id' => 86,
                'wh_product_id' => 86,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            86 => 
            array (
                'id' => 87,
                'pch_purchase_invoice_id' => 87,
                'wh_product_id' => 87,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            87 => 
            array (
                'id' => 88,
                'pch_purchase_invoice_id' => 88,
                'wh_product_id' => 88,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            88 => 
            array (
                'id' => 89,
                'pch_purchase_invoice_id' => 89,
                'wh_product_id' => 89,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            89 => 
            array (
                'id' => 90,
                'pch_purchase_invoice_id' => 90,
                'wh_product_id' => 90,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            90 => 
            array (
                'id' => 91,
                'pch_purchase_invoice_id' => 91,
                'wh_product_id' => 91,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            91 => 
            array (
                'id' => 92,
                'pch_purchase_invoice_id' => 92,
                'wh_product_id' => 92,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            92 => 
            array (
                'id' => 93,
                'pch_purchase_invoice_id' => 93,
                'wh_product_id' => 93,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            93 => 
            array (
                'id' => 94,
                'pch_purchase_invoice_id' => 94,
                'wh_product_id' => 94,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            94 => 
            array (
                'id' => 95,
                'pch_purchase_invoice_id' => 95,
                'wh_product_id' => 95,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            95 => 
            array (
                'id' => 96,
                'pch_purchase_invoice_id' => 96,
                'wh_product_id' => 96,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            96 => 
            array (
                'id' => 97,
                'pch_purchase_invoice_id' => 97,
                'wh_product_id' => 97,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            97 => 
            array (
                'id' => 98,
                'pch_purchase_invoice_id' => 98,
                'wh_product_id' => 98,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            98 => 
            array (
                'id' => 99,
                'pch_purchase_invoice_id' => 99,
                'wh_product_id' => 99,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
            99 => 
            array (
                'id' => 100,
                'pch_purchase_invoice_id' => 100,
                'wh_product_id' => 100,
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_detail_purchase_invoice')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}