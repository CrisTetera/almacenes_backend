<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PchDetailPurchaseDebitNoteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pch_detail_purchase_debit_note')->delete();
        
        \DB::table('pch_detail_purchase_debit_note')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pch_purchase_debit_note_id' => 1,
                'wh_product_id' => 1,
                'quantity' => '582.67',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '55.61',
                'flag_delete' => true,
            ),
            1 => 
            array (
                'id' => 2,
                'pch_purchase_debit_note_id' => 2,
                'wh_product_id' => 2,
                'quantity' => '23.32',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '22.25',
                'flag_delete' => false,
            ),
            2 => 
            array (
                'id' => 3,
                'pch_purchase_debit_note_id' => 3,
                'wh_product_id' => 3,
                'quantity' => '163.15',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '19.05',
                'flag_delete' => false,
            ),
            3 => 
            array (
                'id' => 4,
                'pch_purchase_debit_note_id' => 4,
                'wh_product_id' => 4,
                'quantity' => '1592.50',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '22.78',
                'flag_delete' => false,
            ),
            4 => 
            array (
                'id' => 5,
                'pch_purchase_debit_note_id' => 5,
                'wh_product_id' => 5,
                'quantity' => '44.26',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '111.54',
                'flag_delete' => true,
            ),
            5 => 
            array (
                'id' => 6,
                'pch_purchase_debit_note_id' => 6,
                'wh_product_id' => 6,
                'quantity' => '15.12',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '15.30',
                'flag_delete' => false,
            ),
            6 => 
            array (
                'id' => 7,
                'pch_purchase_debit_note_id' => 7,
                'wh_product_id' => 7,
                'quantity' => '22.86',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '16.31',
                'flag_delete' => false,
            ),
            7 => 
            array (
                'id' => 8,
                'pch_purchase_debit_note_id' => 8,
                'wh_product_id' => 8,
                'quantity' => '29.83',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '58.53',
                'flag_delete' => true,
            ),
            8 => 
            array (
                'id' => 9,
                'pch_purchase_debit_note_id' => 9,
                'wh_product_id' => 9,
                'quantity' => '14.20',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '36.55',
                'flag_delete' => true,
            ),
            9 => 
            array (
                'id' => 10,
                'pch_purchase_debit_note_id' => 10,
                'wh_product_id' => 10,
                'quantity' => '16.77',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '22.21',
                'flag_delete' => false,
            ),
            10 => 
            array (
                'id' => 11,
                'pch_purchase_debit_note_id' => 11,
                'wh_product_id' => 11,
                'quantity' => '11.83',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '16.16',
                'flag_delete' => true,
            ),
            11 => 
            array (
                'id' => 12,
                'pch_purchase_debit_note_id' => 12,
                'wh_product_id' => 12,
                'quantity' => '77.76',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '21.16',
                'flag_delete' => false,
            ),
            12 => 
            array (
                'id' => 13,
                'pch_purchase_debit_note_id' => 13,
                'wh_product_id' => 13,
                'quantity' => '50.16',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '849.76',
                'flag_delete' => true,
            ),
            13 => 
            array (
                'id' => 14,
                'pch_purchase_debit_note_id' => 14,
                'wh_product_id' => 14,
                'quantity' => '18.46',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '35.41',
                'flag_delete' => true,
            ),
            14 => 
            array (
                'id' => 15,
                'pch_purchase_debit_note_id' => 15,
                'wh_product_id' => 15,
                'quantity' => '73.18',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '23.27',
                'flag_delete' => false,
            ),
            15 => 
            array (
                'id' => 16,
                'pch_purchase_debit_note_id' => 16,
                'wh_product_id' => 16,
                'quantity' => '380.00',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '313.57',
                'flag_delete' => false,
            ),
            16 => 
            array (
                'id' => 17,
                'pch_purchase_debit_note_id' => 17,
                'wh_product_id' => 17,
                'quantity' => '32.17',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '11.70',
                'flag_delete' => true,
            ),
            17 => 
            array (
                'id' => 18,
                'pch_purchase_debit_note_id' => 18,
                'wh_product_id' => 18,
                'quantity' => '20.48',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '18.90',
                'flag_delete' => true,
            ),
            18 => 
            array (
                'id' => 19,
                'pch_purchase_debit_note_id' => 19,
                'wh_product_id' => 19,
                'quantity' => '48.30',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '59.91',
                'flag_delete' => true,
            ),
            19 => 
            array (
                'id' => 20,
                'pch_purchase_debit_note_id' => 20,
                'wh_product_id' => 20,
                'quantity' => '30.10',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '34.61',
                'flag_delete' => true,
            ),
            20 => 
            array (
                'id' => 21,
                'pch_purchase_debit_note_id' => 21,
                'wh_product_id' => 21,
                'quantity' => '13.04',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '46.25',
                'flag_delete' => true,
            ),
            21 => 
            array (
                'id' => 22,
                'pch_purchase_debit_note_id' => 22,
                'wh_product_id' => 22,
                'quantity' => '29.10',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '28.31',
                'flag_delete' => true,
            ),
            22 => 
            array (
                'id' => 23,
                'pch_purchase_debit_note_id' => 23,
                'wh_product_id' => 23,
                'quantity' => '36.54',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '34.62',
                'flag_delete' => true,
            ),
            23 => 
            array (
                'id' => 24,
                'pch_purchase_debit_note_id' => 24,
                'wh_product_id' => 24,
                'quantity' => '34.20',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '34.82',
                'flag_delete' => true,
            ),
            24 => 
            array (
                'id' => 25,
                'pch_purchase_debit_note_id' => 25,
                'wh_product_id' => 25,
                'quantity' => '52.10',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '20.89',
                'flag_delete' => true,
            ),
            25 => 
            array (
                'id' => 26,
                'pch_purchase_debit_note_id' => 26,
                'wh_product_id' => 26,
                'quantity' => '115.45',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '58.59',
                'flag_delete' => true,
            ),
            26 => 
            array (
                'id' => 27,
                'pch_purchase_debit_note_id' => 27,
                'wh_product_id' => 27,
                'quantity' => '199.72',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '32.57',
                'flag_delete' => true,
            ),
            27 => 
            array (
                'id' => 28,
                'pch_purchase_debit_note_id' => 28,
                'wh_product_id' => 28,
                'quantity' => '14.28',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '25.33',
                'flag_delete' => false,
            ),
            28 => 
            array (
                'id' => 29,
                'pch_purchase_debit_note_id' => 29,
                'wh_product_id' => 29,
                'quantity' => '16.94',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '61.84',
                'flag_delete' => false,
            ),
            29 => 
            array (
                'id' => 30,
                'pch_purchase_debit_note_id' => 30,
                'wh_product_id' => 30,
                'quantity' => '43.19',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '50.69',
                'flag_delete' => true,
            ),
            30 => 
            array (
                'id' => 31,
                'pch_purchase_debit_note_id' => 31,
                'wh_product_id' => 31,
                'quantity' => '31.99',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '25.75',
                'flag_delete' => true,
            ),
            31 => 
            array (
                'id' => 32,
                'pch_purchase_debit_note_id' => 32,
                'wh_product_id' => 32,
                'quantity' => '13.56',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '37.29',
                'flag_delete' => false,
            ),
            32 => 
            array (
                'id' => 33,
                'pch_purchase_debit_note_id' => 33,
                'wh_product_id' => 33,
                'quantity' => '12.68',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '17.87',
                'flag_delete' => false,
            ),
            33 => 
            array (
                'id' => 34,
                'pch_purchase_debit_note_id' => 34,
                'wh_product_id' => 34,
                'quantity' => '3206.87',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '343.53',
                'flag_delete' => false,
            ),
            34 => 
            array (
                'id' => 35,
                'pch_purchase_debit_note_id' => 35,
                'wh_product_id' => 35,
                'quantity' => '44.08',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '567.26',
                'flag_delete' => true,
            ),
            35 => 
            array (
                'id' => 36,
                'pch_purchase_debit_note_id' => 36,
                'wh_product_id' => 36,
                'quantity' => '33.82',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '12.21',
                'flag_delete' => true,
            ),
            36 => 
            array (
                'id' => 37,
                'pch_purchase_debit_note_id' => 37,
                'wh_product_id' => 37,
                'quantity' => '19.37',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '29.27',
                'flag_delete' => true,
            ),
            37 => 
            array (
                'id' => 38,
                'pch_purchase_debit_note_id' => 38,
                'wh_product_id' => 38,
                'quantity' => '18.81',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '40.23',
                'flag_delete' => true,
            ),
            38 => 
            array (
                'id' => 39,
                'pch_purchase_debit_note_id' => 39,
                'wh_product_id' => 39,
                'quantity' => '24.23',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '56.76',
                'flag_delete' => true,
            ),
            39 => 
            array (
                'id' => 40,
                'pch_purchase_debit_note_id' => 40,
                'wh_product_id' => 40,
                'quantity' => '21.23',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '58.42',
                'flag_delete' => false,
            ),
            40 => 
            array (
                'id' => 41,
                'pch_purchase_debit_note_id' => 41,
                'wh_product_id' => 41,
                'quantity' => '69.28',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '21.53',
                'flag_delete' => true,
            ),
            41 => 
            array (
                'id' => 42,
                'pch_purchase_debit_note_id' => 42,
                'wh_product_id' => 42,
                'quantity' => '35.19',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '25.62',
                'flag_delete' => false,
            ),
            42 => 
            array (
                'id' => 43,
                'pch_purchase_debit_note_id' => 43,
                'wh_product_id' => 43,
                'quantity' => '11.71',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '16.05',
                'flag_delete' => true,
            ),
            43 => 
            array (
                'id' => 44,
                'pch_purchase_debit_note_id' => 44,
                'wh_product_id' => 44,
                'quantity' => '40.52',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '12.17',
                'flag_delete' => false,
            ),
            44 => 
            array (
                'id' => 45,
                'pch_purchase_debit_note_id' => 45,
                'wh_product_id' => 45,
                'quantity' => '21.84',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '16.69',
                'flag_delete' => false,
            ),
            45 => 
            array (
                'id' => 46,
                'pch_purchase_debit_note_id' => 46,
                'wh_product_id' => 46,
                'quantity' => '82.15',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '14.15',
                'flag_delete' => true,
            ),
            46 => 
            array (
                'id' => 47,
                'pch_purchase_debit_note_id' => 47,
                'wh_product_id' => 47,
                'quantity' => '100.30',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '900.49',
                'flag_delete' => true,
            ),
            47 => 
            array (
                'id' => 48,
                'pch_purchase_debit_note_id' => 48,
                'wh_product_id' => 48,
                'quantity' => '10.73',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '15.69',
                'flag_delete' => false,
            ),
            48 => 
            array (
                'id' => 49,
                'pch_purchase_debit_note_id' => 49,
                'wh_product_id' => 49,
                'quantity' => '488.75',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '180.78',
                'flag_delete' => true,
            ),
            49 => 
            array (
                'id' => 50,
                'pch_purchase_debit_note_id' => 50,
                'wh_product_id' => 50,
                'quantity' => '92.21',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '33.99',
                'flag_delete' => false,
            ),
            50 => 
            array (
                'id' => 51,
                'pch_purchase_debit_note_id' => 51,
                'wh_product_id' => 51,
                'quantity' => '21.71',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '18.73',
                'flag_delete' => false,
            ),
            51 => 
            array (
                'id' => 52,
                'pch_purchase_debit_note_id' => 52,
                'wh_product_id' => 52,
                'quantity' => '74.07',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '78.05',
                'flag_delete' => false,
            ),
            52 => 
            array (
                'id' => 53,
                'pch_purchase_debit_note_id' => 53,
                'wh_product_id' => 53,
                'quantity' => '34.89',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '135.36',
                'flag_delete' => false,
            ),
            53 => 
            array (
                'id' => 54,
                'pch_purchase_debit_note_id' => 54,
                'wh_product_id' => 54,
                'quantity' => '31.51',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '25.19',
                'flag_delete' => true,
            ),
            54 => 
            array (
                'id' => 55,
                'pch_purchase_debit_note_id' => 55,
                'wh_product_id' => 55,
                'quantity' => '26.41',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '32.00',
                'flag_delete' => false,
            ),
            55 => 
            array (
                'id' => 56,
                'pch_purchase_debit_note_id' => 56,
                'wh_product_id' => 56,
                'quantity' => '112.29',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '21.51',
                'flag_delete' => false,
            ),
            56 => 
            array (
                'id' => 57,
                'pch_purchase_debit_note_id' => 57,
                'wh_product_id' => 57,
                'quantity' => '24.12',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '13.49',
                'flag_delete' => true,
            ),
            57 => 
            array (
                'id' => 58,
                'pch_purchase_debit_note_id' => 58,
                'wh_product_id' => 58,
                'quantity' => '18.18',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '45.45',
                'flag_delete' => false,
            ),
            58 => 
            array (
                'id' => 59,
                'pch_purchase_debit_note_id' => 59,
                'wh_product_id' => 59,
                'quantity' => '66.10',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '17.58',
                'flag_delete' => false,
            ),
            59 => 
            array (
                'id' => 60,
                'pch_purchase_debit_note_id' => 60,
                'wh_product_id' => 60,
                'quantity' => '62.05',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '13.51',
                'flag_delete' => true,
            ),
            60 => 
            array (
                'id' => 61,
                'pch_purchase_debit_note_id' => 61,
                'wh_product_id' => 61,
                'quantity' => '19.99',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '17.21',
                'flag_delete' => true,
            ),
            61 => 
            array (
                'id' => 62,
                'pch_purchase_debit_note_id' => 62,
                'wh_product_id' => 62,
                'quantity' => '57.41',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '144.63',
                'flag_delete' => false,
            ),
            62 => 
            array (
                'id' => 63,
                'pch_purchase_debit_note_id' => 63,
                'wh_product_id' => 63,
                'quantity' => '225.22',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '29.47',
                'flag_delete' => false,
            ),
            63 => 
            array (
                'id' => 64,
                'pch_purchase_debit_note_id' => 64,
                'wh_product_id' => 64,
                'quantity' => '48.45',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '416.71',
                'flag_delete' => false,
            ),
            64 => 
            array (
                'id' => 65,
                'pch_purchase_debit_note_id' => 65,
                'wh_product_id' => 65,
                'quantity' => '33.53',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '21.06',
                'flag_delete' => true,
            ),
            65 => 
            array (
                'id' => 66,
                'pch_purchase_debit_note_id' => 66,
                'wh_product_id' => 66,
                'quantity' => '23.09',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '40.09',
                'flag_delete' => true,
            ),
            66 => 
            array (
                'id' => 67,
                'pch_purchase_debit_note_id' => 67,
                'wh_product_id' => 67,
                'quantity' => '22.98',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '59.55',
                'flag_delete' => true,
            ),
            67 => 
            array (
                'id' => 68,
                'pch_purchase_debit_note_id' => 68,
                'wh_product_id' => 68,
                'quantity' => '83.69',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '11.22',
                'flag_delete' => false,
            ),
            68 => 
            array (
                'id' => 69,
                'pch_purchase_debit_note_id' => 69,
                'wh_product_id' => 69,
                'quantity' => '27.35',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '52.44',
                'flag_delete' => false,
            ),
            69 => 
            array (
                'id' => 70,
                'pch_purchase_debit_note_id' => 70,
                'wh_product_id' => 70,
                'quantity' => '42.55',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '16.35',
                'flag_delete' => false,
            ),
            70 => 
            array (
                'id' => 71,
                'pch_purchase_debit_note_id' => 71,
                'wh_product_id' => 71,
                'quantity' => '22.35',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '39.24',
                'flag_delete' => false,
            ),
            71 => 
            array (
                'id' => 72,
                'pch_purchase_debit_note_id' => 72,
                'wh_product_id' => 72,
                'quantity' => '19.94',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '15.21',
                'flag_delete' => true,
            ),
            72 => 
            array (
                'id' => 73,
                'pch_purchase_debit_note_id' => 73,
                'wh_product_id' => 73,
                'quantity' => '21.56',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '23.32',
                'flag_delete' => true,
            ),
            73 => 
            array (
                'id' => 74,
                'pch_purchase_debit_note_id' => 74,
                'wh_product_id' => 74,
                'quantity' => '37.05',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '32.19',
                'flag_delete' => false,
            ),
            74 => 
            array (
                'id' => 75,
                'pch_purchase_debit_note_id' => 75,
                'wh_product_id' => 75,
                'quantity' => '21.14',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '37.32',
                'flag_delete' => true,
            ),
            75 => 
            array (
                'id' => 76,
                'pch_purchase_debit_note_id' => 76,
                'wh_product_id' => 76,
                'quantity' => '327.15',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '23.32',
                'flag_delete' => false,
            ),
            76 => 
            array (
                'id' => 77,
                'pch_purchase_debit_note_id' => 77,
                'wh_product_id' => 77,
                'quantity' => '48.39',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '31.59',
                'flag_delete' => false,
            ),
            77 => 
            array (
                'id' => 78,
                'pch_purchase_debit_note_id' => 78,
                'wh_product_id' => 78,
                'quantity' => '151.49',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '15129.17',
                'flag_delete' => true,
            ),
            78 => 
            array (
                'id' => 79,
                'pch_purchase_debit_note_id' => 79,
                'wh_product_id' => 79,
                'quantity' => '72.44',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '8941.12',
                'flag_delete' => false,
            ),
            79 => 
            array (
                'id' => 80,
                'pch_purchase_debit_note_id' => 80,
                'wh_product_id' => 80,
                'quantity' => '64.45',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '15.31',
                'flag_delete' => true,
            ),
            80 => 
            array (
                'id' => 81,
                'pch_purchase_debit_note_id' => 81,
                'wh_product_id' => 81,
                'quantity' => '263.17',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '28.00',
                'flag_delete' => false,
            ),
            81 => 
            array (
                'id' => 82,
                'pch_purchase_debit_note_id' => 82,
                'wh_product_id' => 82,
                'quantity' => '22.92',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '31.85',
                'flag_delete' => true,
            ),
            82 => 
            array (
                'id' => 83,
                'pch_purchase_debit_note_id' => 83,
                'wh_product_id' => 83,
                'quantity' => '39.27',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '39.63',
                'flag_delete' => true,
            ),
            83 => 
            array (
                'id' => 84,
                'pch_purchase_debit_note_id' => 84,
                'wh_product_id' => 84,
                'quantity' => '19.15',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '19.86',
                'flag_delete' => false,
            ),
            84 => 
            array (
                'id' => 85,
                'pch_purchase_debit_note_id' => 85,
                'wh_product_id' => 85,
                'quantity' => '64.11',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '25.39',
                'flag_delete' => false,
            ),
            85 => 
            array (
                'id' => 86,
                'pch_purchase_debit_note_id' => 86,
                'wh_product_id' => 86,
                'quantity' => '37.63',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '17.40',
                'flag_delete' => true,
            ),
            86 => 
            array (
                'id' => 87,
                'pch_purchase_debit_note_id' => 87,
                'wh_product_id' => 87,
                'quantity' => '25.08',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '47.25',
                'flag_delete' => false,
            ),
            87 => 
            array (
                'id' => 88,
                'pch_purchase_debit_note_id' => 88,
                'wh_product_id' => 88,
                'quantity' => '18.63',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '27.10',
                'flag_delete' => true,
            ),
            88 => 
            array (
                'id' => 89,
                'pch_purchase_debit_note_id' => 89,
                'wh_product_id' => 89,
                'quantity' => '21.93',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '31.26',
                'flag_delete' => false,
            ),
            89 => 
            array (
                'id' => 90,
                'pch_purchase_debit_note_id' => 90,
                'wh_product_id' => 90,
                'quantity' => '54.24',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '35.62',
                'flag_delete' => true,
            ),
            90 => 
            array (
                'id' => 91,
                'pch_purchase_debit_note_id' => 91,
                'wh_product_id' => 91,
                'quantity' => '11.84',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '11.00',
                'flag_delete' => false,
            ),
            91 => 
            array (
                'id' => 92,
                'pch_purchase_debit_note_id' => 92,
                'wh_product_id' => 92,
                'quantity' => '13.95',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '24.42',
                'flag_delete' => false,
            ),
            92 => 
            array (
                'id' => 93,
                'pch_purchase_debit_note_id' => 93,
                'wh_product_id' => 93,
                'quantity' => '188.28',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '21.35',
                'flag_delete' => true,
            ),
            93 => 
            array (
                'id' => 94,
                'pch_purchase_debit_note_id' => 94,
                'wh_product_id' => 94,
                'quantity' => '23.12',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '21.47',
                'flag_delete' => false,
            ),
            94 => 
            array (
                'id' => 95,
                'pch_purchase_debit_note_id' => 95,
                'wh_product_id' => 95,
                'quantity' => '18.99',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '60.14',
                'flag_delete' => false,
            ),
            95 => 
            array (
                'id' => 96,
                'pch_purchase_debit_note_id' => 96,
                'wh_product_id' => 96,
                'quantity' => '22.07',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '21.14',
                'flag_delete' => false,
            ),
            96 => 
            array (
                'id' => 97,
                'pch_purchase_debit_note_id' => 97,
                'wh_product_id' => 97,
                'quantity' => '15.61',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '27.09',
                'flag_delete' => false,
            ),
            97 => 
            array (
                'id' => 98,
                'pch_purchase_debit_note_id' => 98,
                'wh_product_id' => 98,
                'quantity' => '3704.89',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '49.39',
                'flag_delete' => false,
            ),
            98 => 
            array (
                'id' => 99,
                'pch_purchase_debit_note_id' => 99,
                'wh_product_id' => 99,
                'quantity' => '14.75',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '35.07',
                'flag_delete' => true,
            ),
            99 => 
            array (
                'id' => 100,
                'pch_purchase_debit_note_id' => 100,
                'wh_product_id' => 100,
                'quantity' => '73.55',
                'detail' => $faker->sentence(8),
                'discount_or_surcharge' => $faker->numberBetween(0, 100),
                'subtotal' => '63.59',
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_detail_purchase_debit_note')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}