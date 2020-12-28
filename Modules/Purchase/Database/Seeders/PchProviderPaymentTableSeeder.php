<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;

class PchProviderPaymentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pch_provider_payment')->delete();
        
        \DB::table('pch_provider_payment')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pch_detail_provider_payment_sheet_id' => 1,
                'pch_provider_account_movement_id' => 1,
                'date_payment' => '2016-09-25',
                'amount_paid' => '13.56',
                'flag_delete' => false,
            ),
            1 => 
            array (
                'id' => 2,
                'pch_detail_provider_payment_sheet_id' => 2,
                'pch_provider_account_movement_id' => 2,
                'date_payment' => '2015-07-28',
                'amount_paid' => '10.82',
                'flag_delete' => false,
            ),
            2 => 
            array (
                'id' => 3,
                'pch_detail_provider_payment_sheet_id' => 3,
                'pch_provider_account_movement_id' => 3,
                'date_payment' => '2013-04-04',
                'amount_paid' => '38.57',
                'flag_delete' => false,
            ),
            3 => 
            array (
                'id' => 4,
                'pch_detail_provider_payment_sheet_id' => 4,
                'pch_provider_account_movement_id' => 4,
                'date_payment' => '2013-02-11',
                'amount_paid' => '91.57',
                'flag_delete' => false,
            ),
            4 => 
            array (
                'id' => 5,
                'pch_detail_provider_payment_sheet_id' => 5,
                'pch_provider_account_movement_id' => 5,
                'date_payment' => '2009-05-27',
                'amount_paid' => '16.26',
                'flag_delete' => true,
            ),
            5 => 
            array (
                'id' => 6,
                'pch_detail_provider_payment_sheet_id' => 6,
                'pch_provider_account_movement_id' => 6,
                'date_payment' => '2025-09-25',
                'amount_paid' => '19.87',
                'flag_delete' => true,
            ),
            6 => 
            array (
                'id' => 7,
                'pch_detail_provider_payment_sheet_id' => 7,
                'pch_provider_account_movement_id' => 7,
                'date_payment' => '2012-06-26',
                'amount_paid' => '14.11',
                'flag_delete' => true,
            ),
            7 => 
            array (
                'id' => 8,
                'pch_detail_provider_payment_sheet_id' => 8,
                'pch_provider_account_movement_id' => 8,
                'date_payment' => '2009-01-21',
                'amount_paid' => '96.74',
                'flag_delete' => true,
            ),
            8 => 
            array (
                'id' => 9,
                'pch_detail_provider_payment_sheet_id' => 9,
                'pch_provider_account_movement_id' => 9,
                'date_payment' => '2025-10-03',
                'amount_paid' => '25.69',
                'flag_delete' => false,
            ),
            9 => 
            array (
                'id' => 10,
                'pch_detail_provider_payment_sheet_id' => 10,
                'pch_provider_account_movement_id' => 10,
                'date_payment' => '2017-08-08',
                'amount_paid' => '23.68',
                'flag_delete' => true,
            ),
            10 => 
            array (
                'id' => 11,
                'pch_detail_provider_payment_sheet_id' => 11,
                'pch_provider_account_movement_id' => 11,
                'date_payment' => '2010-09-12',
                'amount_paid' => '36.43',
                'flag_delete' => true,
            ),
            11 => 
            array (
                'id' => 12,
                'pch_detail_provider_payment_sheet_id' => 12,
                'pch_provider_account_movement_id' => 12,
                'date_payment' => '2013-10-25',
                'amount_paid' => '102.11',
                'flag_delete' => false,
            ),
            12 => 
            array (
                'id' => 13,
                'pch_detail_provider_payment_sheet_id' => 13,
                'pch_provider_account_movement_id' => 13,
                'date_payment' => '2020-04-24',
                'amount_paid' => '19.20',
                'flag_delete' => false,
            ),
            13 => 
            array (
                'id' => 14,
                'pch_detail_provider_payment_sheet_id' => 14,
                'pch_provider_account_movement_id' => 14,
                'date_payment' => '2019-10-19',
                'amount_paid' => '21.51',
                'flag_delete' => true,
            ),
            14 => 
            array (
                'id' => 15,
                'pch_detail_provider_payment_sheet_id' => 15,
                'pch_provider_account_movement_id' => 15,
                'date_payment' => '2025-12-26',
                'amount_paid' => '18.70',
                'flag_delete' => false,
            ),
            15 => 
            array (
                'id' => 16,
                'pch_detail_provider_payment_sheet_id' => 16,
                'pch_provider_account_movement_id' => 16,
                'date_payment' => '2026-01-07',
                'amount_paid' => '41.92',
                'flag_delete' => false,
            ),
            16 => 
            array (
                'id' => 17,
                'pch_detail_provider_payment_sheet_id' => 17,
                'pch_provider_account_movement_id' => 17,
                'date_payment' => '2010-11-19',
                'amount_paid' => '15.04',
                'flag_delete' => false,
            ),
            17 => 
            array (
                'id' => 18,
                'pch_detail_provider_payment_sheet_id' => 18,
                'pch_provider_account_movement_id' => 18,
                'date_payment' => '2009-10-08',
                'amount_paid' => '62.09',
                'flag_delete' => false,
            ),
            18 => 
            array (
                'id' => 19,
                'pch_detail_provider_payment_sheet_id' => 19,
                'pch_provider_account_movement_id' => 19,
                'date_payment' => '2013-08-10',
                'amount_paid' => '22.71',
                'flag_delete' => true,
            ),
            19 => 
            array (
                'id' => 20,
                'pch_detail_provider_payment_sheet_id' => 20,
                'pch_provider_account_movement_id' => 20,
                'date_payment' => '2024-07-29',
                'amount_paid' => '17.58',
                'flag_delete' => true,
            ),
            20 => 
            array (
                'id' => 21,
                'pch_detail_provider_payment_sheet_id' => 21,
                'pch_provider_account_movement_id' => 21,
                'date_payment' => '2013-07-04',
                'amount_paid' => '28.58',
                'flag_delete' => false,
            ),
            21 => 
            array (
                'id' => 22,
                'pch_detail_provider_payment_sheet_id' => 22,
                'pch_provider_account_movement_id' => 22,
                'date_payment' => '2014-08-06',
                'amount_paid' => '59.42',
                'flag_delete' => true,
            ),
            22 => 
            array (
                'id' => 23,
                'pch_detail_provider_payment_sheet_id' => 23,
                'pch_provider_account_movement_id' => 23,
                'date_payment' => '2024-09-13',
                'amount_paid' => '14.16',
                'flag_delete' => true,
            ),
            23 => 
            array (
                'id' => 24,
                'pch_detail_provider_payment_sheet_id' => 24,
                'pch_provider_account_movement_id' => 24,
                'date_payment' => '2017-06-22',
                'amount_paid' => '654.28',
                'flag_delete' => false,
            ),
            24 => 
            array (
                'id' => 25,
                'pch_detail_provider_payment_sheet_id' => 25,
                'pch_provider_account_movement_id' => 25,
                'date_payment' => '2022-11-19',
                'amount_paid' => '28.37',
                'flag_delete' => true,
            ),
            25 => 
            array (
                'id' => 26,
                'pch_detail_provider_payment_sheet_id' => 26,
                'pch_provider_account_movement_id' => 26,
                'date_payment' => '2021-01-02',
                'amount_paid' => '16.43',
                'flag_delete' => false,
            ),
            26 => 
            array (
                'id' => 27,
                'pch_detail_provider_payment_sheet_id' => 27,
                'pch_provider_account_movement_id' => 27,
                'date_payment' => '2023-06-13',
                'amount_paid' => '48.94',
                'flag_delete' => true,
            ),
            27 => 
            array (
                'id' => 28,
                'pch_detail_provider_payment_sheet_id' => 28,
                'pch_provider_account_movement_id' => 28,
                'date_payment' => '2011-10-06',
                'amount_paid' => '19.59',
                'flag_delete' => true,
            ),
            28 => 
            array (
                'id' => 29,
                'pch_detail_provider_payment_sheet_id' => 29,
                'pch_provider_account_movement_id' => 29,
                'date_payment' => '2026-11-07',
                'amount_paid' => '21.48',
                'flag_delete' => false,
            ),
            29 => 
            array (
                'id' => 30,
                'pch_detail_provider_payment_sheet_id' => 30,
                'pch_provider_account_movement_id' => 30,
                'date_payment' => '2022-10-18',
                'amount_paid' => '24.88',
                'flag_delete' => false,
            ),
            30 => 
            array (
                'id' => 31,
                'pch_detail_provider_payment_sheet_id' => 31,
                'pch_provider_account_movement_id' => 31,
                'date_payment' => '2014-09-16',
                'amount_paid' => '362.51',
                'flag_delete' => true,
            ),
            31 => 
            array (
                'id' => 32,
                'pch_detail_provider_payment_sheet_id' => 32,
                'pch_provider_account_movement_id' => 32,
                'date_payment' => '2011-07-29',
                'amount_paid' => '32.85',
                'flag_delete' => false,
            ),
            32 => 
            array (
                'id' => 33,
                'pch_detail_provider_payment_sheet_id' => 33,
                'pch_provider_account_movement_id' => 33,
                'date_payment' => '2014-04-29',
                'amount_paid' => '70.25',
                'flag_delete' => true,
            ),
            33 => 
            array (
                'id' => 34,
                'pch_detail_provider_payment_sheet_id' => 34,
                'pch_provider_account_movement_id' => 34,
                'date_payment' => '2010-10-26',
                'amount_paid' => '20.33',
                'flag_delete' => true,
            ),
            34 => 
            array (
                'id' => 35,
                'pch_detail_provider_payment_sheet_id' => 35,
                'pch_provider_account_movement_id' => 35,
                'date_payment' => '2016-09-20',
                'amount_paid' => '1546.80',
                'flag_delete' => true,
            ),
            35 => 
            array (
                'id' => 36,
                'pch_detail_provider_payment_sheet_id' => 36,
                'pch_provider_account_movement_id' => 36,
                'date_payment' => '2017-04-13',
                'amount_paid' => '24.97',
                'flag_delete' => false,
            ),
            36 => 
            array (
                'id' => 37,
                'pch_detail_provider_payment_sheet_id' => 37,
                'pch_provider_account_movement_id' => 37,
                'date_payment' => '2024-05-09',
                'amount_paid' => '1114.70',
                'flag_delete' => true,
            ),
            37 => 
            array (
                'id' => 38,
                'pch_detail_provider_payment_sheet_id' => 38,
                'pch_provider_account_movement_id' => 38,
                'date_payment' => '2025-09-01',
                'amount_paid' => '163.64',
                'flag_delete' => true,
            ),
            38 => 
            array (
                'id' => 39,
                'pch_detail_provider_payment_sheet_id' => 39,
                'pch_provider_account_movement_id' => 39,
                'date_payment' => '2017-12-07',
                'amount_paid' => '23.60',
                'flag_delete' => true,
            ),
            39 => 
            array (
                'id' => 40,
                'pch_detail_provider_payment_sheet_id' => 40,
                'pch_provider_account_movement_id' => 40,
                'date_payment' => '2021-07-10',
                'amount_paid' => '27.26',
                'flag_delete' => false,
            ),
            40 => 
            array (
                'id' => 41,
                'pch_detail_provider_payment_sheet_id' => 41,
                'pch_provider_account_movement_id' => 41,
                'date_payment' => '2017-07-18',
                'amount_paid' => '19.81',
                'flag_delete' => false,
            ),
            41 => 
            array (
                'id' => 42,
                'pch_detail_provider_payment_sheet_id' => 42,
                'pch_provider_account_movement_id' => 42,
                'date_payment' => '2025-01-29',
                'amount_paid' => '21.70',
                'flag_delete' => false,
            ),
            42 => 
            array (
                'id' => 43,
                'pch_detail_provider_payment_sheet_id' => 43,
                'pch_provider_account_movement_id' => 43,
                'date_payment' => '2012-03-08',
                'amount_paid' => '161.83',
                'flag_delete' => false,
            ),
            43 => 
            array (
                'id' => 44,
                'pch_detail_provider_payment_sheet_id' => 44,
                'pch_provider_account_movement_id' => 44,
                'date_payment' => '2027-11-01',
                'amount_paid' => '15.48',
                'flag_delete' => true,
            ),
            44 => 
            array (
                'id' => 45,
                'pch_detail_provider_payment_sheet_id' => 45,
                'pch_provider_account_movement_id' => 45,
                'date_payment' => '2026-10-04',
                'amount_paid' => '413.21',
                'flag_delete' => false,
            ),
            45 => 
            array (
                'id' => 46,
                'pch_detail_provider_payment_sheet_id' => 46,
                'pch_provider_account_movement_id' => 46,
                'date_payment' => '2010-11-17',
                'amount_paid' => '10.20',
                'flag_delete' => true,
            ),
            46 => 
            array (
                'id' => 47,
                'pch_detail_provider_payment_sheet_id' => 47,
                'pch_provider_account_movement_id' => 47,
                'date_payment' => '2011-08-27',
                'amount_paid' => '39.99',
                'flag_delete' => false,
            ),
            47 => 
            array (
                'id' => 48,
                'pch_detail_provider_payment_sheet_id' => 48,
                'pch_provider_account_movement_id' => 48,
                'date_payment' => '2027-01-29',
                'amount_paid' => '32.28',
                'flag_delete' => true,
            ),
            48 => 
            array (
                'id' => 49,
                'pch_detail_provider_payment_sheet_id' => 49,
                'pch_provider_account_movement_id' => 49,
                'date_payment' => '2020-07-02',
                'amount_paid' => '54.29',
                'flag_delete' => false,
            ),
            49 => 
            array (
                'id' => 50,
                'pch_detail_provider_payment_sheet_id' => 50,
                'pch_provider_account_movement_id' => 50,
                'date_payment' => '2015-12-16',
                'amount_paid' => '23.55',
                'flag_delete' => true,
            ),
            50 => 
            array (
                'id' => 51,
                'pch_detail_provider_payment_sheet_id' => 51,
                'pch_provider_account_movement_id' => 51,
                'date_payment' => '2024-01-27',
                'amount_paid' => '447.94',
                'flag_delete' => false,
            ),
            51 => 
            array (
                'id' => 52,
                'pch_detail_provider_payment_sheet_id' => 52,
                'pch_provider_account_movement_id' => 52,
                'date_payment' => '2010-03-11',
                'amount_paid' => '31.66',
                'flag_delete' => true,
            ),
            52 => 
            array (
                'id' => 53,
                'pch_detail_provider_payment_sheet_id' => 53,
                'pch_provider_account_movement_id' => 53,
                'date_payment' => '2017-03-03',
                'amount_paid' => '14.75',
                'flag_delete' => false,
            ),
            53 => 
            array (
                'id' => 54,
                'pch_detail_provider_payment_sheet_id' => 54,
                'pch_provider_account_movement_id' => 54,
                'date_payment' => '2014-02-26',
                'amount_paid' => '28.38',
                'flag_delete' => false,
            ),
            54 => 
            array (
                'id' => 55,
                'pch_detail_provider_payment_sheet_id' => 55,
                'pch_provider_account_movement_id' => 55,
                'date_payment' => '2011-09-22',
                'amount_paid' => '99.99',
                'flag_delete' => true,
            ),
            55 => 
            array (
                'id' => 56,
                'pch_detail_provider_payment_sheet_id' => 56,
                'pch_provider_account_movement_id' => 56,
                'date_payment' => '2024-07-10',
                'amount_paid' => '15.21',
                'flag_delete' => true,
            ),
            56 => 
            array (
                'id' => 57,
                'pch_detail_provider_payment_sheet_id' => 57,
                'pch_provider_account_movement_id' => 57,
                'date_payment' => '2019-02-25',
                'amount_paid' => '12.42',
                'flag_delete' => false,
            ),
            57 => 
            array (
                'id' => 58,
                'pch_detail_provider_payment_sheet_id' => 58,
                'pch_provider_account_movement_id' => 58,
                'date_payment' => '2020-09-25',
                'amount_paid' => '182.96',
                'flag_delete' => true,
            ),
            58 => 
            array (
                'id' => 59,
                'pch_detail_provider_payment_sheet_id' => 59,
                'pch_provider_account_movement_id' => 59,
                'date_payment' => '2012-12-21',
                'amount_paid' => '328.69',
                'flag_delete' => true,
            ),
            59 => 
            array (
                'id' => 60,
                'pch_detail_provider_payment_sheet_id' => 60,
                'pch_provider_account_movement_id' => 60,
                'date_payment' => '2023-07-18',
                'amount_paid' => '17.08',
                'flag_delete' => false,
            ),
            60 => 
            array (
                'id' => 61,
                'pch_detail_provider_payment_sheet_id' => 61,
                'pch_provider_account_movement_id' => 61,
                'date_payment' => '2018-09-07',
                'amount_paid' => '36.83',
                'flag_delete' => false,
            ),
            61 => 
            array (
                'id' => 62,
                'pch_detail_provider_payment_sheet_id' => 62,
                'pch_provider_account_movement_id' => 62,
                'date_payment' => '2010-07-26',
                'amount_paid' => '19.22',
                'flag_delete' => false,
            ),
            62 => 
            array (
                'id' => 63,
                'pch_detail_provider_payment_sheet_id' => 63,
                'pch_provider_account_movement_id' => 63,
                'date_payment' => '2018-01-30',
                'amount_paid' => '153.03',
                'flag_delete' => true,
            ),
            63 => 
            array (
                'id' => 64,
                'pch_detail_provider_payment_sheet_id' => 64,
                'pch_provider_account_movement_id' => 64,
                'date_payment' => '2017-06-14',
                'amount_paid' => '272.78',
                'flag_delete' => true,
            ),
            64 => 
            array (
                'id' => 65,
                'pch_detail_provider_payment_sheet_id' => 65,
                'pch_provider_account_movement_id' => 65,
                'date_payment' => '2024-02-17',
                'amount_paid' => '16.14',
                'flag_delete' => true,
            ),
            65 => 
            array (
                'id' => 66,
                'pch_detail_provider_payment_sheet_id' => 66,
                'pch_provider_account_movement_id' => 66,
                'date_payment' => '2017-07-23',
                'amount_paid' => '22.02',
                'flag_delete' => false,
            ),
            66 => 
            array (
                'id' => 67,
                'pch_detail_provider_payment_sheet_id' => 67,
                'pch_provider_account_movement_id' => 67,
                'date_payment' => '2023-06-15',
                'amount_paid' => '72.66',
                'flag_delete' => false,
            ),
            67 => 
            array (
                'id' => 68,
                'pch_detail_provider_payment_sheet_id' => 68,
                'pch_provider_account_movement_id' => 68,
                'date_payment' => '2015-10-21',
                'amount_paid' => '174.69',
                'flag_delete' => false,
            ),
            68 => 
            array (
                'id' => 69,
                'pch_detail_provider_payment_sheet_id' => 69,
                'pch_provider_account_movement_id' => 69,
                'date_payment' => '2011-07-31',
                'amount_paid' => '30.20',
                'flag_delete' => false,
            ),
            69 => 
            array (
                'id' => 70,
                'pch_detail_provider_payment_sheet_id' => 70,
                'pch_provider_account_movement_id' => 70,
                'date_payment' => '2011-05-28',
                'amount_paid' => '16.30',
                'flag_delete' => true,
            ),
            70 => 
            array (
                'id' => 71,
                'pch_detail_provider_payment_sheet_id' => 71,
                'pch_provider_account_movement_id' => 71,
                'date_payment' => '2013-02-10',
                'amount_paid' => '63.65',
                'flag_delete' => true,
            ),
            71 => 
            array (
                'id' => 72,
                'pch_detail_provider_payment_sheet_id' => 72,
                'pch_provider_account_movement_id' => 72,
                'date_payment' => '2018-11-20',
                'amount_paid' => '83.83',
                'flag_delete' => true,
            ),
            72 => 
            array (
                'id' => 73,
                'pch_detail_provider_payment_sheet_id' => 73,
                'pch_provider_account_movement_id' => 73,
                'date_payment' => '2026-07-01',
                'amount_paid' => '14.66',
                'flag_delete' => true,
            ),
            73 => 
            array (
                'id' => 74,
                'pch_detail_provider_payment_sheet_id' => 74,
                'pch_provider_account_movement_id' => 74,
                'date_payment' => '2024-12-09',
                'amount_paid' => '80.39',
                'flag_delete' => true,
            ),
            74 => 
            array (
                'id' => 75,
                'pch_detail_provider_payment_sheet_id' => 75,
                'pch_provider_account_movement_id' => 75,
                'date_payment' => '2019-05-03',
                'amount_paid' => '14.39',
                'flag_delete' => true,
            ),
            75 => 
            array (
                'id' => 76,
                'pch_detail_provider_payment_sheet_id' => 76,
                'pch_provider_account_movement_id' => 76,
                'date_payment' => '2019-06-28',
                'amount_paid' => '29.93',
                'flag_delete' => false,
            ),
            76 => 
            array (
                'id' => 77,
                'pch_detail_provider_payment_sheet_id' => 77,
                'pch_provider_account_movement_id' => 77,
                'date_payment' => '2013-12-17',
                'amount_paid' => '98.74',
                'flag_delete' => true,
            ),
            77 => 
            array (
                'id' => 78,
                'pch_detail_provider_payment_sheet_id' => 78,
                'pch_provider_account_movement_id' => 78,
                'date_payment' => '2021-02-15',
                'amount_paid' => '217.39',
                'flag_delete' => true,
            ),
            78 => 
            array (
                'id' => 79,
                'pch_detail_provider_payment_sheet_id' => 79,
                'pch_provider_account_movement_id' => 79,
                'date_payment' => '2018-05-05',
                'amount_paid' => '66.95',
                'flag_delete' => true,
            ),
            79 => 
            array (
                'id' => 80,
                'pch_detail_provider_payment_sheet_id' => 80,
                'pch_provider_account_movement_id' => 80,
                'date_payment' => '2028-06-11',
                'amount_paid' => '23.45',
                'flag_delete' => false,
            ),
            80 => 
            array (
                'id' => 81,
                'pch_detail_provider_payment_sheet_id' => 81,
                'pch_provider_account_movement_id' => 81,
                'date_payment' => '2010-05-10',
                'amount_paid' => '16.19',
                'flag_delete' => false,
            ),
            81 => 
            array (
                'id' => 82,
                'pch_detail_provider_payment_sheet_id' => 82,
                'pch_provider_account_movement_id' => 82,
                'date_payment' => '2014-07-29',
                'amount_paid' => '299.88',
                'flag_delete' => false,
            ),
            82 => 
            array (
                'id' => 83,
                'pch_detail_provider_payment_sheet_id' => 83,
                'pch_provider_account_movement_id' => 83,
                'date_payment' => '2011-03-03',
                'amount_paid' => '24.01',
                'flag_delete' => true,
            ),
            83 => 
            array (
                'id' => 84,
                'pch_detail_provider_payment_sheet_id' => 84,
                'pch_provider_account_movement_id' => 84,
                'date_payment' => '2022-01-19',
                'amount_paid' => '31.75',
                'flag_delete' => false,
            ),
            84 => 
            array (
                'id' => 85,
                'pch_detail_provider_payment_sheet_id' => 85,
                'pch_provider_account_movement_id' => 85,
                'date_payment' => '2026-06-02',
                'amount_paid' => '12.15',
                'flag_delete' => false,
            ),
            85 => 
            array (
                'id' => 86,
                'pch_detail_provider_payment_sheet_id' => 86,
                'pch_provider_account_movement_id' => 86,
                'date_payment' => '2021-09-03',
                'amount_paid' => '74.20',
                'flag_delete' => true,
            ),
            86 => 
            array (
                'id' => 87,
                'pch_detail_provider_payment_sheet_id' => 87,
                'pch_provider_account_movement_id' => 87,
                'date_payment' => '2025-05-27',
                'amount_paid' => '12.11',
                'flag_delete' => true,
            ),
            87 => 
            array (
                'id' => 88,
                'pch_detail_provider_payment_sheet_id' => 88,
                'pch_provider_account_movement_id' => 88,
                'date_payment' => '2009-10-30',
                'amount_paid' => '41.87',
                'flag_delete' => false,
            ),
            88 => 
            array (
                'id' => 89,
                'pch_detail_provider_payment_sheet_id' => 89,
                'pch_provider_account_movement_id' => 89,
                'date_payment' => '2010-11-26',
                'amount_paid' => '61.04',
                'flag_delete' => true,
            ),
            89 => 
            array (
                'id' => 90,
                'pch_detail_provider_payment_sheet_id' => 90,
                'pch_provider_account_movement_id' => 90,
                'date_payment' => '2020-09-15',
                'amount_paid' => '25.12',
                'flag_delete' => true,
            ),
            90 => 
            array (
                'id' => 91,
                'pch_detail_provider_payment_sheet_id' => 91,
                'pch_provider_account_movement_id' => 91,
                'date_payment' => '2012-12-02',
                'amount_paid' => '23.96',
                'flag_delete' => false,
            ),
            91 => 
            array (
                'id' => 92,
                'pch_detail_provider_payment_sheet_id' => 92,
                'pch_provider_account_movement_id' => 92,
                'date_payment' => '2012-04-05',
                'amount_paid' => '18.40',
                'flag_delete' => false,
            ),
            92 => 
            array (
                'id' => 93,
                'pch_detail_provider_payment_sheet_id' => 93,
                'pch_provider_account_movement_id' => 93,
                'date_payment' => '2022-02-11',
                'amount_paid' => '21.35',
                'flag_delete' => true,
            ),
            93 => 
            array (
                'id' => 94,
                'pch_detail_provider_payment_sheet_id' => 94,
                'pch_provider_account_movement_id' => 94,
                'date_payment' => '2023-02-15',
                'amount_paid' => '56.04',
                'flag_delete' => false,
            ),
            94 => 
            array (
                'id' => 95,
                'pch_detail_provider_payment_sheet_id' => 95,
                'pch_provider_account_movement_id' => 95,
                'date_payment' => '2023-09-12',
                'amount_paid' => '28.92',
                'flag_delete' => true,
            ),
            95 => 
            array (
                'id' => 96,
                'pch_detail_provider_payment_sheet_id' => 96,
                'pch_provider_account_movement_id' => 96,
                'date_payment' => '2014-08-21',
                'amount_paid' => '48.84',
                'flag_delete' => false,
            ),
            96 => 
            array (
                'id' => 97,
                'pch_detail_provider_payment_sheet_id' => 97,
                'pch_provider_account_movement_id' => 97,
                'date_payment' => '2019-09-01',
                'amount_paid' => '27.12',
                'flag_delete' => true,
            ),
            97 => 
            array (
                'id' => 98,
                'pch_detail_provider_payment_sheet_id' => 98,
                'pch_provider_account_movement_id' => 98,
                'date_payment' => '2024-02-13',
                'amount_paid' => '161.54',
                'flag_delete' => true,
            ),
            98 => 
            array (
                'id' => 99,
                'pch_detail_provider_payment_sheet_id' => 99,
                'pch_provider_account_movement_id' => 99,
                'date_payment' => '2011-10-03',
                'amount_paid' => '22.07',
                'flag_delete' => true,
            ),
            99 => 
            array (
                'id' => 100,
                'pch_detail_provider_payment_sheet_id' => 100,
                'pch_provider_account_movement_id' => 100,
                'date_payment' => '2020-06-21',
                'amount_paid' => '12.38',
                'flag_delete' => true,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_provider_payment')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}