<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;

class PchProviderDebtToPayTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pch_provider_debt_to_pay')->delete();
        
        \DB::table('pch_provider_debt_to_pay')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pch_purchase_invoice_id' => 1,
                'pch_provider_account_id' => 1,
                'date_to_pay' => '2023-12-15',
                'flag_delete' => true,
                'fee_number' => 19326779,
                'total_paid' => '45.56',
                'flag_paid' => true,
            ),
            1 => 
            array (
                'id' => 2,
                'pch_purchase_invoice_id' => 2,
                'pch_provider_account_id' => 2,
                'date_to_pay' => '2018-01-22',
                'flag_delete' => false,
                'fee_number' => 13410591,
                'total_paid' => '97.61',
                'flag_paid' => false,
            ),
            2 => 
            array (
                'id' => 3,
                'pch_purchase_invoice_id' => 3,
                'pch_provider_account_id' => 3,
                'date_to_pay' => '2014-04-17',
                'flag_delete' => true,
                'fee_number' => 18793187,
                'total_paid' => '36.28',
                'flag_paid' => true,
            ),
            3 => 
            array (
                'id' => 4,
                'pch_purchase_invoice_id' => 4,
                'pch_provider_account_id' => 4,
                'date_to_pay' => '2009-04-11',
                'flag_delete' => true,
                'fee_number' => 13475702,
                'total_paid' => '140.28',
                'flag_paid' => true,
            ),
            4 => 
            array (
                'id' => 5,
                'pch_purchase_invoice_id' => 5,
                'pch_provider_account_id' => 5,
                'date_to_pay' => '2009-12-28',
                'flag_delete' => true,
                'fee_number' => 12678264,
                'total_paid' => '22.28',
                'flag_paid' => true,
            ),
            5 => 
            array (
                'id' => 6,
                'pch_purchase_invoice_id' => 6,
                'pch_provider_account_id' => 6,
                'date_to_pay' => '2024-06-06',
                'flag_delete' => true,
                'fee_number' => 16433226,
                'total_paid' => '11.93',
                'flag_paid' => true,
            ),
            6 => 
            array (
                'id' => 7,
                'pch_purchase_invoice_id' => 7,
                'pch_provider_account_id' => 7,
                'date_to_pay' => '2018-05-11',
                'flag_delete' => false,
                'fee_number' => 7936098,
                'total_paid' => '366.23',
                'flag_paid' => false,
            ),
            7 => 
            array (
                'id' => 8,
                'pch_purchase_invoice_id' => 8,
                'pch_provider_account_id' => 8,
                'date_to_pay' => '2016-09-04',
                'flag_delete' => true,
                'fee_number' => 19211358,
                'total_paid' => '350.47',
                'flag_paid' => false,
            ),
            8 => 
            array (
                'id' => 9,
                'pch_purchase_invoice_id' => 9,
                'pch_provider_account_id' => 9,
                'date_to_pay' => '2018-09-06',
                'flag_delete' => true,
                'fee_number' => 19067950,
                'total_paid' => '36.88',
                'flag_paid' => true,
            ),
            9 => 
            array (
                'id' => 10,
                'pch_purchase_invoice_id' => 10,
                'pch_provider_account_id' => 10,
                'date_to_pay' => '2024-03-22',
                'flag_delete' => true,
                'fee_number' => 15638705,
                'total_paid' => '34.36',
                'flag_paid' => true,
            ),
            10 => 
            array (
                'id' => 11,
                'pch_purchase_invoice_id' => 11,
                'pch_provider_account_id' => 11,
                'date_to_pay' => '2027-09-10',
                'flag_delete' => false,
                'fee_number' => 15753190,
                'total_paid' => '148.34',
                'flag_paid' => false,
            ),
            11 => 
            array (
                'id' => 12,
                'pch_purchase_invoice_id' => 12,
                'pch_provider_account_id' => 12,
                'date_to_pay' => '2019-08-06',
                'flag_delete' => true,
                'fee_number' => 9190173,
                'total_paid' => '2174.51',
                'flag_paid' => true,
            ),
            12 => 
            array (
                'id' => 13,
                'pch_purchase_invoice_id' => 13,
                'pch_provider_account_id' => 13,
                'date_to_pay' => '2012-07-20',
                'flag_delete' => false,
                'fee_number' => 9733068,
                'total_paid' => '19.11',
                'flag_paid' => true,
            ),
            13 => 
            array (
                'id' => 14,
                'pch_purchase_invoice_id' => 14,
                'pch_provider_account_id' => 14,
                'date_to_pay' => '2019-05-23',
                'flag_delete' => false,
                'fee_number' => 8135520,
                'total_paid' => '221.88',
                'flag_paid' => true,
            ),
            14 => 
            array (
                'id' => 15,
                'pch_purchase_invoice_id' => 15,
                'pch_provider_account_id' => 15,
                'date_to_pay' => '2012-05-14',
                'flag_delete' => false,
                'fee_number' => 12757994,
                'total_paid' => '18.19',
                'flag_paid' => false,
            ),
            15 => 
            array (
                'id' => 16,
                'pch_purchase_invoice_id' => 16,
                'pch_provider_account_id' => 16,
                'date_to_pay' => '2025-09-14',
                'flag_delete' => true,
                'fee_number' => 21836303,
                'total_paid' => '2590.49',
                'flag_paid' => true,
            ),
            16 => 
            array (
                'id' => 17,
                'pch_purchase_invoice_id' => 17,
                'pch_provider_account_id' => 17,
                'date_to_pay' => '2016-12-01',
                'flag_delete' => true,
                'fee_number' => 13579018,
                'total_paid' => '42.32',
                'flag_paid' => false,
            ),
            17 => 
            array (
                'id' => 18,
                'pch_purchase_invoice_id' => 18,
                'pch_provider_account_id' => 18,
                'date_to_pay' => '2026-01-25',
                'flag_delete' => true,
                'fee_number' => 10508976,
                'total_paid' => '26.81',
                'flag_paid' => true,
            ),
            18 => 
            array (
                'id' => 19,
                'pch_purchase_invoice_id' => 19,
                'pch_provider_account_id' => 19,
                'date_to_pay' => '2026-02-22',
                'flag_delete' => true,
                'fee_number' => 15148961,
                'total_paid' => '27.67',
                'flag_paid' => false,
            ),
            19 => 
            array (
                'id' => 20,
                'pch_purchase_invoice_id' => 20,
                'pch_provider_account_id' => 20,
                'date_to_pay' => '2011-06-22',
                'flag_delete' => true,
                'fee_number' => 20407543,
                'total_paid' => '12.30',
                'flag_paid' => true,
            ),
            20 => 
            array (
                'id' => 21,
                'pch_purchase_invoice_id' => 21,
                'pch_provider_account_id' => 21,
                'date_to_pay' => '2021-07-01',
                'flag_delete' => true,
                'fee_number' => 19789822,
                'total_paid' => '51.92',
                'flag_paid' => false,
            ),
            21 => 
            array (
                'id' => 22,
                'pch_purchase_invoice_id' => 22,
                'pch_provider_account_id' => 22,
                'date_to_pay' => '2025-02-25',
                'flag_delete' => false,
                'fee_number' => 20220641,
                'total_paid' => '21.92',
                'flag_paid' => true,
            ),
            22 => 
            array (
                'id' => 23,
                'pch_purchase_invoice_id' => 23,
                'pch_provider_account_id' => 23,
                'date_to_pay' => '2025-04-04',
                'flag_delete' => false,
                'fee_number' => 19202356,
                'total_paid' => '214.14',
                'flag_paid' => false,
            ),
            23 => 
            array (
                'id' => 24,
                'pch_purchase_invoice_id' => 24,
                'pch_provider_account_id' => 24,
                'date_to_pay' => '2009-12-22',
                'flag_delete' => true,
                'fee_number' => 22002258,
                'total_paid' => '15.85',
                'flag_paid' => false,
            ),
            24 => 
            array (
                'id' => 25,
                'pch_purchase_invoice_id' => 25,
                'pch_provider_account_id' => 25,
                'date_to_pay' => '2022-08-09',
                'flag_delete' => true,
                'fee_number' => 22154889,
                'total_paid' => '12.82',
                'flag_paid' => false,
            ),
            25 => 
            array (
                'id' => 26,
                'pch_purchase_invoice_id' => 26,
                'pch_provider_account_id' => 26,
                'date_to_pay' => '2026-02-15',
                'flag_delete' => true,
                'fee_number' => 19268519,
                'total_paid' => '39.73',
                'flag_paid' => false,
            ),
            26 => 
            array (
                'id' => 27,
                'pch_purchase_invoice_id' => 27,
                'pch_provider_account_id' => 27,
                'date_to_pay' => '2026-01-20',
                'flag_delete' => false,
                'fee_number' => 11835366,
                'total_paid' => '13.00',
                'flag_paid' => false,
            ),
            27 => 
            array (
                'id' => 28,
                'pch_purchase_invoice_id' => 28,
                'pch_provider_account_id' => 28,
                'date_to_pay' => '2021-05-19',
                'flag_delete' => true,
                'fee_number' => 17250469,
                'total_paid' => '16.23',
                'flag_paid' => true,
            ),
            28 => 
            array (
                'id' => 29,
                'pch_purchase_invoice_id' => 29,
                'pch_provider_account_id' => 29,
                'date_to_pay' => '2018-08-06',
                'flag_delete' => false,
                'fee_number' => 9464022,
                'total_paid' => '17.20',
                'flag_paid' => true,
            ),
            29 => 
            array (
                'id' => 30,
                'pch_purchase_invoice_id' => 30,
                'pch_provider_account_id' => 30,
                'date_to_pay' => '2014-08-18',
                'flag_delete' => true,
                'fee_number' => 18212400,
                'total_paid' => '18.20',
                'flag_paid' => false,
            ),
            30 => 
            array (
                'id' => 31,
                'pch_purchase_invoice_id' => 31,
                'pch_provider_account_id' => 31,
                'date_to_pay' => '2015-11-14',
                'flag_delete' => true,
                'fee_number' => 9859598,
                'total_paid' => '13.74',
                'flag_paid' => true,
            ),
            31 => 
            array (
                'id' => 32,
                'pch_purchase_invoice_id' => 32,
                'pch_provider_account_id' => 32,
                'date_to_pay' => '2013-09-18',
                'flag_delete' => true,
                'fee_number' => 15838069,
                'total_paid' => '29.52',
                'flag_paid' => true,
            ),
            32 => 
            array (
                'id' => 33,
                'pch_purchase_invoice_id' => 33,
                'pch_provider_account_id' => 33,
                'date_to_pay' => '2009-03-03',
                'flag_delete' => true,
                'fee_number' => 11777441,
                'total_paid' => '135.81',
                'flag_paid' => false,
            ),
            33 => 
            array (
                'id' => 34,
                'pch_purchase_invoice_id' => 34,
                'pch_provider_account_id' => 34,
                'date_to_pay' => '2018-08-29',
                'flag_delete' => false,
                'fee_number' => 9700590,
                'total_paid' => '15.58',
                'flag_paid' => false,
            ),
            34 => 
            array (
                'id' => 35,
                'pch_purchase_invoice_id' => 35,
                'pch_provider_account_id' => 35,
                'date_to_pay' => '2011-08-31',
                'flag_delete' => true,
                'fee_number' => 8196369,
                'total_paid' => '28.66',
                'flag_paid' => false,
            ),
            35 => 
            array (
                'id' => 36,
                'pch_purchase_invoice_id' => 36,
                'pch_provider_account_id' => 36,
                'date_to_pay' => '2017-07-01',
                'flag_delete' => false,
                'fee_number' => 10316727,
                'total_paid' => '30.25',
                'flag_paid' => true,
            ),
            36 => 
            array (
                'id' => 37,
                'pch_purchase_invoice_id' => 37,
                'pch_provider_account_id' => 37,
                'date_to_pay' => '2021-08-09',
                'flag_delete' => false,
                'fee_number' => 10723744,
                'total_paid' => '25.57',
                'flag_paid' => true,
            ),
            37 => 
            array (
                'id' => 38,
                'pch_purchase_invoice_id' => 38,
                'pch_provider_account_id' => 38,
                'date_to_pay' => '2026-01-16',
                'flag_delete' => false,
                'fee_number' => 14989045,
                'total_paid' => '40.65',
                'flag_paid' => true,
            ),
            38 => 
            array (
                'id' => 39,
                'pch_purchase_invoice_id' => 39,
                'pch_provider_account_id' => 39,
                'date_to_pay' => '2015-04-01',
                'flag_delete' => false,
                'fee_number' => 17000481,
                'total_paid' => '50.59',
                'flag_paid' => true,
            ),
            39 => 
            array (
                'id' => 40,
                'pch_purchase_invoice_id' => 40,
                'pch_provider_account_id' => 40,
                'date_to_pay' => '2012-06-08',
                'flag_delete' => true,
                'fee_number' => 12335435,
                'total_paid' => '39.60',
                'flag_paid' => false,
            ),
            40 => 
            array (
                'id' => 41,
                'pch_purchase_invoice_id' => 41,
                'pch_provider_account_id' => 41,
                'date_to_pay' => '2019-10-24',
                'flag_delete' => false,
                'fee_number' => 17496196,
                'total_paid' => '20.50',
                'flag_paid' => false,
            ),
            41 => 
            array (
                'id' => 42,
                'pch_purchase_invoice_id' => 42,
                'pch_provider_account_id' => 42,
                'date_to_pay' => '2017-06-28',
                'flag_delete' => true,
                'fee_number' => 18385842,
                'total_paid' => '29.32',
                'flag_paid' => false,
            ),
            42 => 
            array (
                'id' => 43,
                'pch_purchase_invoice_id' => 43,
                'pch_provider_account_id' => 43,
                'date_to_pay' => '2018-02-25',
                'flag_delete' => true,
                'fee_number' => 12857771,
                'total_paid' => '25.81',
                'flag_paid' => true,
            ),
            43 => 
            array (
                'id' => 44,
                'pch_purchase_invoice_id' => 44,
                'pch_provider_account_id' => 44,
                'date_to_pay' => '2018-03-17',
                'flag_delete' => false,
                'fee_number' => 17358765,
                'total_paid' => '52.56',
                'flag_paid' => true,
            ),
            44 => 
            array (
                'id' => 45,
                'pch_purchase_invoice_id' => 45,
                'pch_provider_account_id' => 45,
                'date_to_pay' => '2012-11-25',
                'flag_delete' => true,
                'fee_number' => 21463411,
                'total_paid' => '17.65',
                'flag_paid' => false,
            ),
            45 => 
            array (
                'id' => 46,
                'pch_purchase_invoice_id' => 46,
                'pch_provider_account_id' => 46,
                'date_to_pay' => '2016-10-10',
                'flag_delete' => false,
                'fee_number' => 11451806,
                'total_paid' => '59.15',
                'flag_paid' => false,
            ),
            46 => 
            array (
                'id' => 47,
                'pch_purchase_invoice_id' => 47,
                'pch_provider_account_id' => 47,
                'date_to_pay' => '2014-11-14',
                'flag_delete' => true,
                'fee_number' => 9573625,
                'total_paid' => '41.23',
                'flag_paid' => false,
            ),
            47 => 
            array (
                'id' => 48,
                'pch_purchase_invoice_id' => 48,
                'pch_provider_account_id' => 48,
                'date_to_pay' => '2020-12-16',
                'flag_delete' => false,
                'fee_number' => 21006984,
                'total_paid' => '41.70',
                'flag_paid' => false,
            ),
            48 => 
            array (
                'id' => 49,
                'pch_purchase_invoice_id' => 49,
                'pch_provider_account_id' => 49,
                'date_to_pay' => '2009-05-24',
                'flag_delete' => true,
                'fee_number' => 14748229,
                'total_paid' => '19.04',
                'flag_paid' => true,
            ),
            49 => 
            array (
                'id' => 50,
                'pch_purchase_invoice_id' => 50,
                'pch_provider_account_id' => 50,
                'date_to_pay' => '2023-02-23',
                'flag_delete' => false,
                'fee_number' => 13590691,
                'total_paid' => '75.82',
                'flag_paid' => false,
            ),
            50 => 
            array (
                'id' => 51,
                'pch_purchase_invoice_id' => 51,
                'pch_provider_account_id' => 51,
                'date_to_pay' => '2022-02-27',
                'flag_delete' => true,
                'fee_number' => 9063701,
                'total_paid' => '17.37',
                'flag_paid' => true,
            ),
            51 => 
            array (
                'id' => 52,
                'pch_purchase_invoice_id' => 52,
                'pch_provider_account_id' => 52,
                'date_to_pay' => '2018-04-22',
                'flag_delete' => true,
                'fee_number' => 12575919,
                'total_paid' => '27.01',
                'flag_paid' => false,
            ),
            52 => 
            array (
                'id' => 53,
                'pch_purchase_invoice_id' => 53,
                'pch_provider_account_id' => 53,
                'date_to_pay' => '2009-06-05',
                'flag_delete' => false,
                'fee_number' => 14390174,
                'total_paid' => '3746.66',
                'flag_paid' => false,
            ),
            53 => 
            array (
                'id' => 54,
                'pch_purchase_invoice_id' => 54,
                'pch_provider_account_id' => 54,
                'date_to_pay' => '2010-10-09',
                'flag_delete' => false,
                'fee_number' => 18927561,
                'total_paid' => '95.57',
                'flag_paid' => false,
            ),
            54 => 
            array (
                'id' => 55,
                'pch_purchase_invoice_id' => 55,
                'pch_provider_account_id' => 55,
                'date_to_pay' => '2022-08-21',
                'flag_delete' => true,
                'fee_number' => 19175617,
                'total_paid' => '21.01',
                'flag_paid' => false,
            ),
            55 => 
            array (
                'id' => 56,
                'pch_purchase_invoice_id' => 56,
                'pch_provider_account_id' => 56,
                'date_to_pay' => '2015-05-06',
                'flag_delete' => false,
                'fee_number' => 13801662,
                'total_paid' => '3966.91',
                'flag_paid' => false,
            ),
            56 => 
            array (
                'id' => 57,
                'pch_purchase_invoice_id' => 57,
                'pch_provider_account_id' => 57,
                'date_to_pay' => '2024-11-22',
                'flag_delete' => true,
                'fee_number' => 13343812,
                'total_paid' => '20.36',
                'flag_paid' => false,
            ),
            57 => 
            array (
                'id' => 58,
                'pch_purchase_invoice_id' => 58,
                'pch_provider_account_id' => 58,
                'date_to_pay' => '2020-09-26',
                'flag_delete' => true,
                'fee_number' => 14048664,
                'total_paid' => '20.29',
                'flag_paid' => false,
            ),
            58 => 
            array (
                'id' => 59,
                'pch_purchase_invoice_id' => 59,
                'pch_provider_account_id' => 59,
                'date_to_pay' => '2020-02-05',
                'flag_delete' => true,
                'fee_number' => 14514200,
                'total_paid' => '16.25',
                'flag_paid' => false,
            ),
            59 => 
            array (
                'id' => 60,
                'pch_purchase_invoice_id' => 60,
                'pch_provider_account_id' => 60,
                'date_to_pay' => '2023-06-10',
                'flag_delete' => false,
                'fee_number' => 17697690,
                'total_paid' => '41.02',
                'flag_paid' => true,
            ),
            60 => 
            array (
                'id' => 61,
                'pch_purchase_invoice_id' => 61,
                'pch_provider_account_id' => 61,
                'date_to_pay' => '2028-01-05',
                'flag_delete' => false,
                'fee_number' => 12075502,
                'total_paid' => '60.43',
                'flag_paid' => true,
            ),
            61 => 
            array (
                'id' => 62,
                'pch_purchase_invoice_id' => 62,
                'pch_provider_account_id' => 62,
                'date_to_pay' => '2024-07-22',
                'flag_delete' => false,
                'fee_number' => 8075189,
                'total_paid' => '21.35',
                'flag_paid' => true,
            ),
            62 => 
            array (
                'id' => 63,
                'pch_purchase_invoice_id' => 63,
                'pch_provider_account_id' => 63,
                'date_to_pay' => '2009-06-03',
                'flag_delete' => true,
                'fee_number' => 10555943,
                'total_paid' => '15.11',
                'flag_paid' => false,
            ),
            63 => 
            array (
                'id' => 64,
                'pch_purchase_invoice_id' => 64,
                'pch_provider_account_id' => 64,
                'date_to_pay' => '2021-05-19',
                'flag_delete' => true,
                'fee_number' => 21839016,
                'total_paid' => '183.79',
                'flag_paid' => false,
            ),
            64 => 
            array (
                'id' => 65,
                'pch_purchase_invoice_id' => 65,
                'pch_provider_account_id' => 65,
                'date_to_pay' => '2027-05-20',
                'flag_delete' => false,
                'fee_number' => 9541984,
                'total_paid' => '30.33',
                'flag_paid' => false,
            ),
            65 => 
            array (
                'id' => 66,
                'pch_purchase_invoice_id' => 66,
                'pch_provider_account_id' => 66,
                'date_to_pay' => '2018-02-16',
                'flag_delete' => false,
                'fee_number' => 15015769,
                'total_paid' => '26.35',
                'flag_paid' => false,
            ),
            66 => 
            array (
                'id' => 67,
                'pch_purchase_invoice_id' => 67,
                'pch_provider_account_id' => 67,
                'date_to_pay' => '2026-07-07',
                'flag_delete' => true,
                'fee_number' => 11043647,
                'total_paid' => '3886.47',
                'flag_paid' => true,
            ),
            67 => 
            array (
                'id' => 68,
                'pch_purchase_invoice_id' => 68,
                'pch_provider_account_id' => 68,
                'date_to_pay' => '2027-04-11',
                'flag_delete' => false,
                'fee_number' => 10865487,
                'total_paid' => '27.91',
                'flag_paid' => false,
            ),
            68 => 
            array (
                'id' => 69,
                'pch_purchase_invoice_id' => 69,
                'pch_provider_account_id' => 69,
                'date_to_pay' => '2019-03-05',
                'flag_delete' => false,
                'fee_number' => 20790632,
                'total_paid' => '56.03',
                'flag_paid' => true,
            ),
            69 => 
            array (
                'id' => 70,
                'pch_purchase_invoice_id' => 70,
                'pch_provider_account_id' => 70,
                'date_to_pay' => '2021-03-11',
                'flag_delete' => false,
                'fee_number' => 9442558,
                'total_paid' => '14.10',
                'flag_paid' => true,
            ),
            70 => 
            array (
                'id' => 71,
                'pch_purchase_invoice_id' => 71,
                'pch_provider_account_id' => 71,
                'date_to_pay' => '2022-01-04',
                'flag_delete' => false,
                'fee_number' => 8341042,
                'total_paid' => '35.84',
                'flag_paid' => false,
            ),
            71 => 
            array (
                'id' => 72,
                'pch_purchase_invoice_id' => 72,
                'pch_provider_account_id' => 72,
                'date_to_pay' => '2010-06-23',
                'flag_delete' => true,
                'fee_number' => 14990131,
                'total_paid' => '16.04',
                'flag_paid' => false,
            ),
            72 => 
            array (
                'id' => 73,
                'pch_purchase_invoice_id' => 73,
                'pch_provider_account_id' => 73,
                'date_to_pay' => '2024-05-29',
                'flag_delete' => false,
                'fee_number' => 13591483,
                'total_paid' => '92.75',
                'flag_paid' => true,
            ),
            73 => 
            array (
                'id' => 74,
                'pch_purchase_invoice_id' => 74,
                'pch_provider_account_id' => 74,
                'date_to_pay' => '2023-06-30',
                'flag_delete' => false,
                'fee_number' => 16557429,
                'total_paid' => '22.62',
                'flag_paid' => true,
            ),
            74 => 
            array (
                'id' => 75,
                'pch_purchase_invoice_id' => 75,
                'pch_provider_account_id' => 75,
                'date_to_pay' => '2019-10-17',
                'flag_delete' => false,
                'fee_number' => 14650585,
                'total_paid' => '13.48',
                'flag_paid' => false,
            ),
            75 => 
            array (
                'id' => 76,
                'pch_purchase_invoice_id' => 76,
                'pch_provider_account_id' => 76,
                'date_to_pay' => '2019-09-06',
                'flag_delete' => true,
                'fee_number' => 9658501,
                'total_paid' => '20.00',
                'flag_paid' => true,
            ),
            76 => 
            array (
                'id' => 77,
                'pch_purchase_invoice_id' => 77,
                'pch_provider_account_id' => 77,
                'date_to_pay' => '2026-10-02',
                'flag_delete' => false,
                'fee_number' => 7572330,
                'total_paid' => '21.22',
                'flag_paid' => true,
            ),
            77 => 
            array (
                'id' => 78,
                'pch_purchase_invoice_id' => 78,
                'pch_provider_account_id' => 78,
                'date_to_pay' => '2017-02-22',
                'flag_delete' => false,
                'fee_number' => 16229513,
                'total_paid' => '14.62',
                'flag_paid' => false,
            ),
            78 => 
            array (
                'id' => 79,
                'pch_purchase_invoice_id' => 79,
                'pch_provider_account_id' => 79,
                'date_to_pay' => '2027-11-26',
                'flag_delete' => true,
                'fee_number' => 20550579,
                'total_paid' => '20.70',
                'flag_paid' => false,
            ),
            79 => 
            array (
                'id' => 80,
                'pch_purchase_invoice_id' => 80,
                'pch_provider_account_id' => 80,
                'date_to_pay' => '2017-08-09',
                'flag_delete' => false,
                'fee_number' => 15539790,
                'total_paid' => '55.31',
                'flag_paid' => true,
            ),
            80 => 
            array (
                'id' => 81,
                'pch_purchase_invoice_id' => 81,
                'pch_provider_account_id' => 81,
                'date_to_pay' => '2019-08-16',
                'flag_delete' => false,
                'fee_number' => 9956907,
                'total_paid' => '25.08',
                'flag_paid' => true,
            ),
            81 => 
            array (
                'id' => 82,
                'pch_purchase_invoice_id' => 82,
                'pch_provider_account_id' => 82,
                'date_to_pay' => '2010-08-26',
                'flag_delete' => true,
                'fee_number' => 11236037,
                'total_paid' => '31.83',
                'flag_paid' => true,
            ),
            82 => 
            array (
                'id' => 83,
                'pch_purchase_invoice_id' => 83,
                'pch_provider_account_id' => 83,
                'date_to_pay' => '2019-07-13',
                'flag_delete' => false,
                'fee_number' => 16613479,
                'total_paid' => '19.81',
                'flag_paid' => true,
            ),
            83 => 
            array (
                'id' => 84,
                'pch_purchase_invoice_id' => 84,
                'pch_provider_account_id' => 84,
                'date_to_pay' => '2016-02-06',
                'flag_delete' => false,
                'fee_number' => 10341147,
                'total_paid' => '26.63',
                'flag_paid' => false,
            ),
            84 => 
            array (
                'id' => 85,
                'pch_purchase_invoice_id' => 85,
                'pch_provider_account_id' => 85,
                'date_to_pay' => '2024-06-16',
                'flag_delete' => false,
                'fee_number' => 12673352,
                'total_paid' => '20.43',
                'flag_paid' => false,
            ),
            85 => 
            array (
                'id' => 86,
                'pch_purchase_invoice_id' => 86,
                'pch_provider_account_id' => 86,
                'date_to_pay' => '2011-03-26',
                'flag_delete' => true,
                'fee_number' => 22360992,
                'total_paid' => '12.08',
                'flag_paid' => false,
            ),
            86 => 
            array (
                'id' => 87,
                'pch_purchase_invoice_id' => 87,
                'pch_provider_account_id' => 87,
                'date_to_pay' => '2027-11-29',
                'flag_delete' => false,
                'fee_number' => 21485325,
                'total_paid' => '20.61',
                'flag_paid' => true,
            ),
            87 => 
            array (
                'id' => 88,
                'pch_purchase_invoice_id' => 88,
                'pch_provider_account_id' => 88,
                'date_to_pay' => '2023-08-28',
                'flag_delete' => true,
                'fee_number' => 19353158,
                'total_paid' => '21.04',
                'flag_paid' => true,
            ),
            88 => 
            array (
                'id' => 89,
                'pch_purchase_invoice_id' => 89,
                'pch_provider_account_id' => 89,
                'date_to_pay' => '2024-09-15',
                'flag_delete' => true,
                'fee_number' => 22158187,
                'total_paid' => '118.96',
                'flag_paid' => true,
            ),
            89 => 
            array (
                'id' => 90,
                'pch_purchase_invoice_id' => 90,
                'pch_provider_account_id' => 90,
                'date_to_pay' => '2018-09-27',
                'flag_delete' => false,
                'fee_number' => 11032930,
                'total_paid' => '12.40',
                'flag_paid' => false,
            ),
            90 => 
            array (
                'id' => 91,
                'pch_purchase_invoice_id' => 91,
                'pch_provider_account_id' => 91,
                'date_to_pay' => '2025-06-02',
                'flag_delete' => false,
                'fee_number' => 13838938,
                'total_paid' => '22.80',
                'flag_paid' => true,
            ),
            91 => 
            array (
                'id' => 92,
                'pch_purchase_invoice_id' => 92,
                'pch_provider_account_id' => 92,
                'date_to_pay' => '2021-05-24',
                'flag_delete' => true,
                'fee_number' => 9293335,
                'total_paid' => '32.16',
                'flag_paid' => false,
            ),
            92 => 
            array (
                'id' => 93,
                'pch_purchase_invoice_id' => 93,
                'pch_provider_account_id' => 93,
                'date_to_pay' => '2027-12-19',
                'flag_delete' => true,
                'fee_number' => 12237598,
                'total_paid' => '99.13',
                'flag_paid' => false,
            ),
            93 => 
            array (
                'id' => 94,
                'pch_purchase_invoice_id' => 94,
                'pch_provider_account_id' => 94,
                'date_to_pay' => '2028-06-21',
                'flag_delete' => false,
                'fee_number' => 15525919,
                'total_paid' => '18.66',
                'flag_paid' => true,
            ),
            94 => 
            array (
                'id' => 95,
                'pch_purchase_invoice_id' => 95,
                'pch_provider_account_id' => 95,
                'date_to_pay' => '2018-12-17',
                'flag_delete' => true,
                'fee_number' => 20636055,
                'total_paid' => '108.83',
                'flag_paid' => false,
            ),
            95 => 
            array (
                'id' => 96,
                'pch_purchase_invoice_id' => 96,
                'pch_provider_account_id' => 96,
                'date_to_pay' => '2012-08-03',
                'flag_delete' => true,
                'fee_number' => 15062193,
                'total_paid' => '29.19',
                'flag_paid' => false,
            ),
            96 => 
            array (
                'id' => 97,
                'pch_purchase_invoice_id' => 97,
                'pch_provider_account_id' => 97,
                'date_to_pay' => '2026-12-21',
                'flag_delete' => false,
                'fee_number' => 10846386,
                'total_paid' => '40.36',
                'flag_paid' => false,
            ),
            97 => 
            array (
                'id' => 98,
                'pch_purchase_invoice_id' => 98,
                'pch_provider_account_id' => 98,
                'date_to_pay' => '2023-03-05',
                'flag_delete' => false,
                'fee_number' => 18918806,
                'total_paid' => '120.34',
                'flag_paid' => true,
            ),
            98 => 
            array (
                'id' => 99,
                'pch_purchase_invoice_id' => 99,
                'pch_provider_account_id' => 99,
                'date_to_pay' => '2014-06-15',
                'flag_delete' => false,
                'fee_number' => 9477225,
                'total_paid' => '12.50',
                'flag_paid' => false,
            ),
            99 => 
            array (
                'id' => 100,
                'pch_purchase_invoice_id' => 100,
                'pch_provider_account_id' => 100,
                'date_to_pay' => '2028-05-14',
                'flag_delete' => true,
                'fee_number' => 17262436,
                'total_paid' => '31.81',
                'flag_paid' => true,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_provider_debt_to_pay')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}