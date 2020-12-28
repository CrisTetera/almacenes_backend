<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PchDetailPurchaseQuotationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pch_detail_purchase_quotation')->delete();
        
        \DB::table('pch_detail_purchase_quotation')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pch_purchase_quotation_id' => 1,
                'wh_product_id' => 1,
                'quantity' => '27.14',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '2170.23',
                'flag_delete' => true,
            ),
            1 => 
            array (
                'id' => 2,
                'pch_purchase_quotation_id' => 2,
                'wh_product_id' => 2,
                'quantity' => '278.70',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '69.41',
                'flag_delete' => true,
            ),
            2 => 
            array (
                'id' => 3,
                'pch_purchase_quotation_id' => 3,
                'wh_product_id' => 3,
                'quantity' => '24.73',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '99.78',
                'flag_delete' => false,
            ),
            3 => 
            array (
                'id' => 4,
                'pch_purchase_quotation_id' => 4,
                'wh_product_id' => 4,
                'quantity' => '45.77',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '21.35',
                'flag_delete' => true,
            ),
            4 => 
            array (
                'id' => 5,
                'pch_purchase_quotation_id' => 5,
                'wh_product_id' => 5,
                'quantity' => '24.87',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '154.94',
                'flag_delete' => false,
            ),
            5 => 
            array (
                'id' => 6,
                'pch_purchase_quotation_id' => 6,
                'wh_product_id' => 6,
                'quantity' => '24.05',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '65.33',
                'flag_delete' => true,
            ),
            6 => 
            array (
                'id' => 7,
                'pch_purchase_quotation_id' => 7,
                'wh_product_id' => 7,
                'quantity' => '27.01',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '23.95',
                'flag_delete' => true,
            ),
            7 => 
            array (
                'id' => 8,
                'pch_purchase_quotation_id' => 8,
                'wh_product_id' => 8,
                'quantity' => '42.22',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '81.07',
                'flag_delete' => false,
            ),
            8 => 
            array (
                'id' => 9,
                'pch_purchase_quotation_id' => 9,
                'wh_product_id' => 9,
                'quantity' => '15.74',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '102.70',
                'flag_delete' => false,
            ),
            9 => 
            array (
                'id' => 10,
                'pch_purchase_quotation_id' => 10,
                'wh_product_id' => 10,
                'quantity' => '54.61',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '68.81',
                'flag_delete' => true,
            ),
            10 => 
            array (
                'id' => 11,
                'pch_purchase_quotation_id' => 11,
                'wh_product_id' => 11,
                'quantity' => '64.57',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '851.30',
                'flag_delete' => false,
            ),
            11 => 
            array (
                'id' => 12,
                'pch_purchase_quotation_id' => 12,
                'wh_product_id' => 12,
                'quantity' => '28.79',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '90.99',
                'flag_delete' => false,
            ),
            12 => 
            array (
                'id' => 13,
                'pch_purchase_quotation_id' => 13,
                'wh_product_id' => 13,
                'quantity' => '14.06',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '25.73',
                'flag_delete' => true,
            ),
            13 => 
            array (
                'id' => 14,
                'pch_purchase_quotation_id' => 14,
                'wh_product_id' => 14,
                'quantity' => '16.03',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '17.52',
                'flag_delete' => false,
            ),
            14 => 
            array (
                'id' => 15,
                'pch_purchase_quotation_id' => 15,
                'wh_product_id' => 15,
                'quantity' => '24.98',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '15.25',
                'flag_delete' => false,
            ),
            15 => 
            array (
                'id' => 16,
                'pch_purchase_quotation_id' => 16,
                'wh_product_id' => 16,
                'quantity' => '19.84',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '13.01',
                'flag_delete' => true,
            ),
            16 => 
            array (
                'id' => 17,
                'pch_purchase_quotation_id' => 17,
                'wh_product_id' => 17,
                'quantity' => '171.34',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '17.46',
                'flag_delete' => true,
            ),
            17 => 
            array (
                'id' => 18,
                'pch_purchase_quotation_id' => 18,
                'wh_product_id' => 18,
                'quantity' => '19.77',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '242.12',
                'flag_delete' => false,
            ),
            18 => 
            array (
                'id' => 19,
                'pch_purchase_quotation_id' => 19,
                'wh_product_id' => 19,
                'quantity' => '33.94',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '35.98',
                'flag_delete' => false,
            ),
            19 => 
            array (
                'id' => 20,
                'pch_purchase_quotation_id' => 20,
                'wh_product_id' => 20,
                'quantity' => '151.65',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '165.88',
                'flag_delete' => true,
            ),
            20 => 
            array (
                'id' => 21,
                'pch_purchase_quotation_id' => 21,
                'wh_product_id' => 21,
                'quantity' => '18.35',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '21.81',
                'flag_delete' => true,
            ),
            21 => 
            array (
                'id' => 22,
                'pch_purchase_quotation_id' => 22,
                'wh_product_id' => 22,
                'quantity' => '17.14',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '13.89',
                'flag_delete' => true,
            ),
            22 => 
            array (
                'id' => 23,
                'pch_purchase_quotation_id' => 23,
                'wh_product_id' => 23,
                'quantity' => '207.25',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '75.01',
                'flag_delete' => false,
            ),
            23 => 
            array (
                'id' => 24,
                'pch_purchase_quotation_id' => 24,
                'wh_product_id' => 24,
                'quantity' => '111.27',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '124.61',
                'flag_delete' => true,
            ),
            24 => 
            array (
                'id' => 25,
                'pch_purchase_quotation_id' => 25,
                'wh_product_id' => 25,
                'quantity' => '19.73',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '307.12',
                'flag_delete' => true,
            ),
            25 => 
            array (
                'id' => 26,
                'pch_purchase_quotation_id' => 26,
                'wh_product_id' => 26,
                'quantity' => '28.57',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '14.51',
                'flag_delete' => true,
            ),
            26 => 
            array (
                'id' => 27,
                'pch_purchase_quotation_id' => 27,
                'wh_product_id' => 27,
                'quantity' => '23.00',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '14.00',
                'flag_delete' => false,
            ),
            27 => 
            array (
                'id' => 28,
                'pch_purchase_quotation_id' => 28,
                'wh_product_id' => 28,
                'quantity' => '121.90',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '104.13',
                'flag_delete' => true,
            ),
            28 => 
            array (
                'id' => 29,
                'pch_purchase_quotation_id' => 29,
                'wh_product_id' => 29,
                'quantity' => '21.41',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '75.91',
                'flag_delete' => false,
            ),
            29 => 
            array (
                'id' => 30,
                'pch_purchase_quotation_id' => 30,
                'wh_product_id' => 30,
                'quantity' => '115.36',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '25.83',
                'flag_delete' => false,
            ),
            30 => 
            array (
                'id' => 31,
                'pch_purchase_quotation_id' => 31,
                'wh_product_id' => 31,
                'quantity' => '265.74',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '46.68',
                'flag_delete' => false,
            ),
            31 => 
            array (
                'id' => 32,
                'pch_purchase_quotation_id' => 32,
                'wh_product_id' => 32,
                'quantity' => '23.49',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '66.36',
                'flag_delete' => false,
            ),
            32 => 
            array (
                'id' => 33,
                'pch_purchase_quotation_id' => 33,
                'wh_product_id' => 33,
                'quantity' => '32.46',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '26.78',
                'flag_delete' => false,
            ),
            33 => 
            array (
                'id' => 34,
                'pch_purchase_quotation_id' => 34,
                'wh_product_id' => 34,
                'quantity' => '15.74',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '40.26',
                'flag_delete' => false,
            ),
            34 => 
            array (
                'id' => 35,
                'pch_purchase_quotation_id' => 35,
                'wh_product_id' => 35,
                'quantity' => '17.48',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '33.11',
                'flag_delete' => false,
            ),
            35 => 
            array (
                'id' => 36,
                'pch_purchase_quotation_id' => 36,
                'wh_product_id' => 36,
                'quantity' => '59.79',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '15.69',
                'flag_delete' => false,
            ),
            36 => 
            array (
                'id' => 37,
                'pch_purchase_quotation_id' => 37,
                'wh_product_id' => 37,
                'quantity' => '35.84',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '15.87',
                'flag_delete' => false,
            ),
            37 => 
            array (
                'id' => 38,
                'pch_purchase_quotation_id' => 38,
                'wh_product_id' => 38,
                'quantity' => '391.90',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '25.93',
                'flag_delete' => true,
            ),
            38 => 
            array (
                'id' => 39,
                'pch_purchase_quotation_id' => 39,
                'wh_product_id' => 39,
                'quantity' => '33.35',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '24.48',
                'flag_delete' => true,
            ),
            39 => 
            array (
                'id' => 40,
                'pch_purchase_quotation_id' => 40,
                'wh_product_id' => 40,
                'quantity' => '208.52',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '19.31',
                'flag_delete' => true,
            ),
            40 => 
            array (
                'id' => 41,
                'pch_purchase_quotation_id' => 41,
                'wh_product_id' => 41,
                'quantity' => '18.23',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '55.61',
                'flag_delete' => false,
            ),
            41 => 
            array (
                'id' => 42,
                'pch_purchase_quotation_id' => 42,
                'wh_product_id' => 42,
                'quantity' => '34.33',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '18.66',
                'flag_delete' => true,
            ),
            42 => 
            array (
                'id' => 43,
                'pch_purchase_quotation_id' => 43,
                'wh_product_id' => 43,
                'quantity' => '10.88',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '23.28',
                'flag_delete' => true,
            ),
            43 => 
            array (
                'id' => 44,
                'pch_purchase_quotation_id' => 44,
                'wh_product_id' => 44,
                'quantity' => '13.94',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '318.41',
                'flag_delete' => true,
            ),
            44 => 
            array (
                'id' => 45,
                'pch_purchase_quotation_id' => 45,
                'wh_product_id' => 45,
                'quantity' => '26.50',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '20.84',
                'flag_delete' => true,
            ),
            45 => 
            array (
                'id' => 46,
                'pch_purchase_quotation_id' => 46,
                'wh_product_id' => 46,
                'quantity' => '133.05',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '70.00',
                'flag_delete' => false,
            ),
            46 => 
            array (
                'id' => 47,
                'pch_purchase_quotation_id' => 47,
                'wh_product_id' => 47,
                'quantity' => '32.71',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '36.53',
                'flag_delete' => true,
            ),
            47 => 
            array (
                'id' => 48,
                'pch_purchase_quotation_id' => 48,
                'wh_product_id' => 48,
                'quantity' => '24.09',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '28.73',
                'flag_delete' => false,
            ),
            48 => 
            array (
                'id' => 49,
                'pch_purchase_quotation_id' => 49,
                'wh_product_id' => 49,
                'quantity' => '42.79',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '33.55',
                'flag_delete' => false,
            ),
            49 => 
            array (
                'id' => 50,
                'pch_purchase_quotation_id' => 50,
                'wh_product_id' => 50,
                'quantity' => '22.38',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '15.67',
                'flag_delete' => true,
            ),
            50 => 
            array (
                'id' => 51,
                'pch_purchase_quotation_id' => 51,
                'wh_product_id' => 51,
                'quantity' => '83.95',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '22.51',
                'flag_delete' => true,
            ),
            51 => 
            array (
                'id' => 52,
                'pch_purchase_quotation_id' => 52,
                'wh_product_id' => 52,
                'quantity' => '11.37',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '16.91',
                'flag_delete' => false,
            ),
            52 => 
            array (
                'id' => 53,
                'pch_purchase_quotation_id' => 53,
                'wh_product_id' => 53,
                'quantity' => '18.21',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '14.41',
                'flag_delete' => false,
            ),
            53 => 
            array (
                'id' => 54,
                'pch_purchase_quotation_id' => 54,
                'wh_product_id' => 54,
                'quantity' => '25.56',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '37.94',
                'flag_delete' => false,
            ),
            54 => 
            array (
                'id' => 55,
                'pch_purchase_quotation_id' => 55,
                'wh_product_id' => 55,
                'quantity' => '11.75',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '23.95',
                'flag_delete' => false,
            ),
            55 => 
            array (
                'id' => 56,
                'pch_purchase_quotation_id' => 56,
                'wh_product_id' => 56,
                'quantity' => '33.93',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '12.31',
                'flag_delete' => true,
            ),
            56 => 
            array (
                'id' => 57,
                'pch_purchase_quotation_id' => 57,
                'wh_product_id' => 57,
                'quantity' => '20.68',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '21.70',
                'flag_delete' => false,
            ),
            57 => 
            array (
                'id' => 58,
                'pch_purchase_quotation_id' => 58,
                'wh_product_id' => 58,
                'quantity' => '19.16',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '30.18',
                'flag_delete' => false,
            ),
            58 => 
            array (
                'id' => 59,
                'pch_purchase_quotation_id' => 59,
                'wh_product_id' => 59,
                'quantity' => '60.45',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '38.03',
                'flag_delete' => true,
            ),
            59 => 
            array (
                'id' => 60,
                'pch_purchase_quotation_id' => 60,
                'wh_product_id' => 60,
                'quantity' => '30.43',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '48.06',
                'flag_delete' => false,
            ),
            60 => 
            array (
                'id' => 61,
                'pch_purchase_quotation_id' => 61,
                'wh_product_id' => 61,
                'quantity' => '34.05',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '17.43',
                'flag_delete' => false,
            ),
            61 => 
            array (
                'id' => 62,
                'pch_purchase_quotation_id' => 62,
                'wh_product_id' => 62,
                'quantity' => '54.28',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '13.34',
                'flag_delete' => true,
            ),
            62 => 
            array (
                'id' => 63,
                'pch_purchase_quotation_id' => 63,
                'wh_product_id' => 63,
                'quantity' => '17.18',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '37.04',
                'flag_delete' => false,
            ),
            63 => 
            array (
                'id' => 64,
                'pch_purchase_quotation_id' => 64,
                'wh_product_id' => 64,
                'quantity' => '4472.58',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '22.02',
                'flag_delete' => true,
            ),
            64 => 
            array (
                'id' => 65,
                'pch_purchase_quotation_id' => 65,
                'wh_product_id' => 65,
                'quantity' => '33.24',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '138.41',
                'flag_delete' => false,
            ),
            65 => 
            array (
                'id' => 66,
                'pch_purchase_quotation_id' => 66,
                'wh_product_id' => 66,
                'quantity' => '53.27',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '16.80',
                'flag_delete' => false,
            ),
            66 => 
            array (
                'id' => 67,
                'pch_purchase_quotation_id' => 67,
                'wh_product_id' => 67,
                'quantity' => '14.77',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '32.43',
                'flag_delete' => false,
            ),
            67 => 
            array (
                'id' => 68,
                'pch_purchase_quotation_id' => 68,
                'wh_product_id' => 68,
                'quantity' => '2258.93',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '17.15',
                'flag_delete' => false,
            ),
            68 => 
            array (
                'id' => 69,
                'pch_purchase_quotation_id' => 69,
                'wh_product_id' => 69,
                'quantity' => '39.25',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '83.34',
                'flag_delete' => false,
            ),
            69 => 
            array (
                'id' => 70,
                'pch_purchase_quotation_id' => 70,
                'wh_product_id' => 70,
                'quantity' => '405.28',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '24.88',
                'flag_delete' => true,
            ),
            70 => 
            array (
                'id' => 71,
                'pch_purchase_quotation_id' => 71,
                'wh_product_id' => 71,
                'quantity' => '38.33',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '13.43',
                'flag_delete' => false,
            ),
            71 => 
            array (
                'id' => 72,
                'pch_purchase_quotation_id' => 72,
                'wh_product_id' => 72,
                'quantity' => '171.07',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '13.08',
                'flag_delete' => true,
            ),
            72 => 
            array (
                'id' => 73,
                'pch_purchase_quotation_id' => 73,
                'wh_product_id' => 73,
                'quantity' => '13.01',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '14.20',
                'flag_delete' => false,
            ),
            73 => 
            array (
                'id' => 74,
                'pch_purchase_quotation_id' => 74,
                'wh_product_id' => 74,
                'quantity' => '84.31',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '33.85',
                'flag_delete' => false,
            ),
            74 => 
            array (
                'id' => 75,
                'pch_purchase_quotation_id' => 75,
                'wh_product_id' => 75,
                'quantity' => '560.67',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '19.47',
                'flag_delete' => false,
            ),
            75 => 
            array (
                'id' => 76,
                'pch_purchase_quotation_id' => 76,
                'wh_product_id' => 76,
                'quantity' => '12.05',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '21.18',
                'flag_delete' => false,
            ),
            76 => 
            array (
                'id' => 77,
                'pch_purchase_quotation_id' => 77,
                'wh_product_id' => 77,
                'quantity' => '62.38',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '35.52',
                'flag_delete' => false,
            ),
            77 => 
            array (
                'id' => 78,
                'pch_purchase_quotation_id' => 78,
                'wh_product_id' => 78,
                'quantity' => '51.46',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '3791.82',
                'flag_delete' => false,
            ),
            78 => 
            array (
                'id' => 79,
                'pch_purchase_quotation_id' => 79,
                'wh_product_id' => 79,
                'quantity' => '28.48',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '407.20',
                'flag_delete' => false,
            ),
            79 => 
            array (
                'id' => 80,
                'pch_purchase_quotation_id' => 80,
                'wh_product_id' => 80,
                'quantity' => '63.09',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '23.88',
                'flag_delete' => true,
            ),
            80 => 
            array (
                'id' => 81,
                'pch_purchase_quotation_id' => 81,
                'wh_product_id' => 81,
                'quantity' => '25.77',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '27.71',
                'flag_delete' => false,
            ),
            81 => 
            array (
                'id' => 82,
                'pch_purchase_quotation_id' => 82,
                'wh_product_id' => 82,
                'quantity' => '24.41',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '135.28',
                'flag_delete' => true,
            ),
            82 => 
            array (
                'id' => 83,
                'pch_purchase_quotation_id' => 83,
                'wh_product_id' => 83,
                'quantity' => '15.30',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '160.17',
                'flag_delete' => true,
            ),
            83 => 
            array (
                'id' => 84,
                'pch_purchase_quotation_id' => 84,
                'wh_product_id' => 84,
                'quantity' => '46.85',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '144.62',
                'flag_delete' => true,
            ),
            84 => 
            array (
                'id' => 85,
                'pch_purchase_quotation_id' => 85,
                'wh_product_id' => 85,
                'quantity' => '53.93',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '42.24',
                'flag_delete' => true,
            ),
            85 => 
            array (
                'id' => 86,
                'pch_purchase_quotation_id' => 86,
                'wh_product_id' => 86,
                'quantity' => '49.58',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '12.32',
                'flag_delete' => true,
            ),
            86 => 
            array (
                'id' => 87,
                'pch_purchase_quotation_id' => 87,
                'wh_product_id' => 87,
                'quantity' => '48.18',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '17.08',
                'flag_delete' => true,
            ),
            87 => 
            array (
                'id' => 88,
                'pch_purchase_quotation_id' => 88,
                'wh_product_id' => 88,
                'quantity' => '27.38',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '23.34',
                'flag_delete' => false,
            ),
            88 => 
            array (
                'id' => 89,
                'pch_purchase_quotation_id' => 89,
                'wh_product_id' => 89,
                'quantity' => '4481.46',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '32.22',
                'flag_delete' => true,
            ),
            89 => 
            array (
                'id' => 90,
                'pch_purchase_quotation_id' => 90,
                'wh_product_id' => 90,
                'quantity' => '31.33',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '25.43',
                'flag_delete' => true,
            ),
            90 => 
            array (
                'id' => 91,
                'pch_purchase_quotation_id' => 91,
                'wh_product_id' => 91,
                'quantity' => '114.41',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '26.59',
                'flag_delete' => false,
            ),
            91 => 
            array (
                'id' => 92,
                'pch_purchase_quotation_id' => 92,
                'wh_product_id' => 92,
                'quantity' => '12.41',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '2034.70',
                'flag_delete' => true,
            ),
            92 => 
            array (
                'id' => 93,
                'pch_purchase_quotation_id' => 93,
                'wh_product_id' => 93,
                'quantity' => '20.91',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '294.14',
                'flag_delete' => false,
            ),
            93 => 
            array (
                'id' => 94,
                'pch_purchase_quotation_id' => 94,
                'wh_product_id' => 94,
                'quantity' => '15.18',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '91.02',
                'flag_delete' => false,
            ),
            94 => 
            array (
                'id' => 95,
                'pch_purchase_quotation_id' => 95,
                'wh_product_id' => 95,
                'quantity' => '15.08',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '32.45',
                'flag_delete' => true,
            ),
            95 => 
            array (
                'id' => 96,
                'pch_purchase_quotation_id' => 96,
                'wh_product_id' => 96,
                'quantity' => '30.99',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '17.55',
                'flag_delete' => false,
            ),
            96 => 
            array (
                'id' => 97,
                'pch_purchase_quotation_id' => 97,
                'wh_product_id' => 97,
                'quantity' => '24.51',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '13.98',
                'flag_delete' => false,
            ),
            97 => 
            array (
                'id' => 98,
                'pch_purchase_quotation_id' => 98,
                'wh_product_id' => 98,
                'quantity' => '35.09',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '169.13',
                'flag_delete' => true,
            ),
            98 => 
            array (
                'id' => 99,
                'pch_purchase_quotation_id' => 99,
                'wh_product_id' => 99,
                'quantity' => '16.47',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '61.57',
                'flag_delete' => true,
            ),
            99 => 
            array (
                'id' => 100,
                'pch_purchase_quotation_id' => 100,
                'wh_product_id' => 100,
                'quantity' => '31.39',
                'detail' => $faker->sentence(8),
                'discount_or_charge' => $faker->numberBetween(0, 100),
                'subtotal' => '4848.24',
                'flag_delete' => true,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_detail_purchase_quotation')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}