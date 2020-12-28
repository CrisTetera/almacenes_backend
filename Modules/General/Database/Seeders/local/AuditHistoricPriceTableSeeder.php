<?php

namespace Modules\General\Database\Seeders\local;
use Illuminate\Database\Seeder;

class AuditHistoricPriceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('audit_historic_price')->delete();
        
        \DB::table('audit_historic_price')->insert(array (
            0 => 
            array (
                'id' => 1,
                'wh_product_id' => 1,
                'g_user_id' => 1,
                'sl_list_price_id' => 1,
                'init_datetime' => '2020-10-27',
                'finish_datetime' => '2016-04-23',
            ),
            1 => 
            array (
                'id' => 2,
                'wh_product_id' => 2,
                'g_user_id' => 2,
                'sl_list_price_id' => 2,
                'init_datetime' => '2011-10-01',
                'finish_datetime' => '2028-08-09',
            ),
            2 => 
            array (
                'id' => 3,
                'wh_product_id' => 3,
                'g_user_id' => 3,
                'sl_list_price_id' => 3,
                'init_datetime' => '2015-09-26',
                'finish_datetime' => '2020-08-25',
            ),
            3 => 
            array (
                'id' => 4,
                'wh_product_id' => 4,
                'g_user_id' => 4,
                'sl_list_price_id' => 4,
                'init_datetime' => '2009-06-25',
                'finish_datetime' => '2020-04-12',
            ),
            4 => 
            array (
                'id' => 5,
                'wh_product_id' => 5,
                'g_user_id' => 5,
                'sl_list_price_id' => 5,
                'init_datetime' => '2022-03-12',
                'finish_datetime' => '2017-09-23',
            ),
            5 => 
            array (
                'id' => 6,
                'wh_product_id' => 6,
                'g_user_id' => 6,
                'sl_list_price_id' => 6,
                'init_datetime' => '2014-07-12',
                'finish_datetime' => '2017-03-23',
            ),
            6 => 
            array (
                'id' => 7,
                'wh_product_id' => 7,
                'g_user_id' => 7,
                'sl_list_price_id' => 7,
                'init_datetime' => '2023-10-26',
                'finish_datetime' => '2010-10-23',
            ),
            7 => 
            array (
                'id' => 8,
                'wh_product_id' => 8,
                'g_user_id' => 8,
                'sl_list_price_id' => 8,
                'init_datetime' => '2012-05-22',
                'finish_datetime' => '2014-01-11',
            ),
            8 => 
            array (
                'id' => 9,
                'wh_product_id' => 9,
                'g_user_id' => 9,
                'sl_list_price_id' => 9,
                'init_datetime' => '2021-11-02',
                'finish_datetime' => '2027-07-30',
            ),
            9 => 
            array (
                'id' => 10,
                'wh_product_id' => 10,
                'g_user_id' => 10,
                'sl_list_price_id' => 10,
                'init_datetime' => '2025-05-24',
                'finish_datetime' => '2012-08-13',
            ),
            10 => 
            array (
                'id' => 11,
                'wh_product_id' => 11,
                'g_user_id' => 11,
                'sl_list_price_id' => 11,
                'init_datetime' => '2027-06-03',
                'finish_datetime' => '2023-03-13',
            ),
            11 => 
            array (
                'id' => 12,
                'wh_product_id' => 12,
                'g_user_id' => 12,
                'sl_list_price_id' => 12,
                'init_datetime' => '2025-10-16',
                'finish_datetime' => '2012-10-09',
            ),
            12 => 
            array (
                'id' => 13,
                'wh_product_id' => 13,
                'g_user_id' => 13,
                'sl_list_price_id' => 13,
                'init_datetime' => '2011-02-22',
                'finish_datetime' => '2012-12-04',
            ),
            13 => 
            array (
                'id' => 14,
                'wh_product_id' => 14,
                'g_user_id' => 14,
                'sl_list_price_id' => 14,
                'init_datetime' => '2019-09-02',
                'finish_datetime' => '2013-08-25',
            ),
            14 => 
            array (
                'id' => 15,
                'wh_product_id' => 15,
                'g_user_id' => 15,
                'sl_list_price_id' => 15,
                'init_datetime' => '2021-10-15',
                'finish_datetime' => '2015-06-09',
            ),
            15 => 
            array (
                'id' => 16,
                'wh_product_id' => 16,
                'g_user_id' => 16,
                'sl_list_price_id' => 16,
                'init_datetime' => '2025-06-25',
                'finish_datetime' => '2012-05-05',
            ),
            16 => 
            array (
                'id' => 17,
                'wh_product_id' => 17,
                'g_user_id' => 17,
                'sl_list_price_id' => 17,
                'init_datetime' => '2017-09-28',
                'finish_datetime' => '2009-01-20',
            ),
            17 => 
            array (
                'id' => 18,
                'wh_product_id' => 18,
                'g_user_id' => 18,
                'sl_list_price_id' => 18,
                'init_datetime' => '2026-12-28',
                'finish_datetime' => '2020-04-09',
            ),
            18 => 
            array (
                'id' => 19,
                'wh_product_id' => 19,
                'g_user_id' => 19,
                'sl_list_price_id' => 19,
                'init_datetime' => '2019-12-08',
                'finish_datetime' => '2016-05-01',
            ),
            19 => 
            array (
                'id' => 20,
                'wh_product_id' => 20,
                'g_user_id' => 20,
                'sl_list_price_id' => 20,
                'init_datetime' => '2016-03-22',
                'finish_datetime' => '2020-12-01',
            ),
            20 => 
            array (
                'id' => 21,
                'wh_product_id' => 21,
                'g_user_id' => 21,
                'sl_list_price_id' => 21,
                'init_datetime' => '2021-05-27',
                'finish_datetime' => '2013-04-15',
            ),
            21 => 
            array (
                'id' => 22,
                'wh_product_id' => 22,
                'g_user_id' => 22,
                'sl_list_price_id' => 22,
                'init_datetime' => '2021-07-24',
                'finish_datetime' => '2020-07-26',
            ),
            22 => 
            array (
                'id' => 23,
                'wh_product_id' => 23,
                'g_user_id' => 23,
                'sl_list_price_id' => 23,
                'init_datetime' => '2021-06-23',
                'finish_datetime' => '2017-08-20',
            ),
            23 => 
            array (
                'id' => 24,
                'wh_product_id' => 24,
                'g_user_id' => 24,
                'sl_list_price_id' => 24,
                'init_datetime' => '2015-12-07',
                'finish_datetime' => '2025-07-26',
            ),
            24 => 
            array (
                'id' => 25,
                'wh_product_id' => 25,
                'g_user_id' => 25,
                'sl_list_price_id' => 25,
                'init_datetime' => '2017-08-13',
                'finish_datetime' => '2015-07-28',
            ),
            25 => 
            array (
                'id' => 26,
                'wh_product_id' => 26,
                'g_user_id' => 26,
                'sl_list_price_id' => 26,
                'init_datetime' => '2014-09-07',
                'finish_datetime' => '2028-12-08',
            ),
            26 => 
            array (
                'id' => 27,
                'wh_product_id' => 27,
                'g_user_id' => 27,
                'sl_list_price_id' => 27,
                'init_datetime' => '2028-11-17',
                'finish_datetime' => '2014-07-06',
            ),
            27 => 
            array (
                'id' => 28,
                'wh_product_id' => 28,
                'g_user_id' => 28,
                'sl_list_price_id' => 28,
                'init_datetime' => '2028-11-04',
                'finish_datetime' => '2011-03-20',
            ),
            28 => 
            array (
                'id' => 29,
                'wh_product_id' => 29,
                'g_user_id' => 29,
                'sl_list_price_id' => 29,
                'init_datetime' => '2015-01-07',
                'finish_datetime' => '2012-04-06',
            ),
            29 => 
            array (
                'id' => 30,
                'wh_product_id' => 30,
                'g_user_id' => 30,
                'sl_list_price_id' => 30,
                'init_datetime' => '2026-01-26',
                'finish_datetime' => '2023-02-11',
            ),
            30 => 
            array (
                'id' => 31,
                'wh_product_id' => 31,
                'g_user_id' => 31,
                'sl_list_price_id' => 31,
                'init_datetime' => '2018-12-17',
                'finish_datetime' => '2024-10-05',
            ),
            31 => 
            array (
                'id' => 32,
                'wh_product_id' => 32,
                'g_user_id' => 32,
                'sl_list_price_id' => 32,
                'init_datetime' => '2020-10-14',
                'finish_datetime' => '2024-04-13',
            ),
            32 => 
            array (
                'id' => 33,
                'wh_product_id' => 33,
                'g_user_id' => 33,
                'sl_list_price_id' => 33,
                'init_datetime' => '2014-07-26',
                'finish_datetime' => '2011-08-16',
            ),
            33 => 
            array (
                'id' => 34,
                'wh_product_id' => 34,
                'g_user_id' => 34,
                'sl_list_price_id' => 34,
                'init_datetime' => '2025-02-18',
                'finish_datetime' => '2019-03-21',
            ),
            34 => 
            array (
                'id' => 35,
                'wh_product_id' => 35,
                'g_user_id' => 35,
                'sl_list_price_id' => 35,
                'init_datetime' => '2018-07-07',
                'finish_datetime' => '2022-04-12',
            ),
            35 => 
            array (
                'id' => 36,
                'wh_product_id' => 36,
                'g_user_id' => 36,
                'sl_list_price_id' => 36,
                'init_datetime' => '2010-10-02',
                'finish_datetime' => '2016-02-29',
            ),
            36 => 
            array (
                'id' => 37,
                'wh_product_id' => 37,
                'g_user_id' => 37,
                'sl_list_price_id' => 37,
                'init_datetime' => '2016-06-10',
                'finish_datetime' => '2010-10-28',
            ),
            37 => 
            array (
                'id' => 38,
                'wh_product_id' => 38,
                'g_user_id' => 38,
                'sl_list_price_id' => 38,
                'init_datetime' => '2017-02-17',
                'finish_datetime' => '2020-01-23',
            ),
            38 => 
            array (
                'id' => 39,
                'wh_product_id' => 39,
                'g_user_id' => 39,
                'sl_list_price_id' => 39,
                'init_datetime' => '2013-02-02',
                'finish_datetime' => '2020-08-01',
            ),
            39 => 
            array (
                'id' => 40,
                'wh_product_id' => 40,
                'g_user_id' => 40,
                'sl_list_price_id' => 40,
                'init_datetime' => '2013-01-04',
                'finish_datetime' => '2020-03-30',
            ),
            40 => 
            array (
                'id' => 41,
                'wh_product_id' => 41,
                'g_user_id' => 41,
                'sl_list_price_id' => 41,
                'init_datetime' => '2014-11-16',
                'finish_datetime' => '2018-07-15',
            ),
            41 => 
            array (
                'id' => 42,
                'wh_product_id' => 42,
                'g_user_id' => 42,
                'sl_list_price_id' => 42,
                'init_datetime' => '2021-09-08',
                'finish_datetime' => '2017-04-05',
            ),
            42 => 
            array (
                'id' => 43,
                'wh_product_id' => 43,
                'g_user_id' => 43,
                'sl_list_price_id' => 43,
                'init_datetime' => '2017-07-26',
                'finish_datetime' => '2020-10-04',
            ),
            43 => 
            array (
                'id' => 44,
                'wh_product_id' => 44,
                'g_user_id' => 44,
                'sl_list_price_id' => 44,
                'init_datetime' => '2010-11-02',
                'finish_datetime' => '2013-03-04',
            ),
            44 => 
            array (
                'id' => 45,
                'wh_product_id' => 45,
                'g_user_id' => 45,
                'sl_list_price_id' => 45,
                'init_datetime' => '2009-08-11',
                'finish_datetime' => '2023-05-23',
            ),
            45 => 
            array (
                'id' => 46,
                'wh_product_id' => 46,
                'g_user_id' => 46,
                'sl_list_price_id' => 46,
                'init_datetime' => '2019-03-10',
                'finish_datetime' => '2009-05-24',
            ),
            46 => 
            array (
                'id' => 47,
                'wh_product_id' => 47,
                'g_user_id' => 47,
                'sl_list_price_id' => 47,
                'init_datetime' => '2023-10-25',
                'finish_datetime' => '2011-04-16',
            ),
            47 => 
            array (
                'id' => 48,
                'wh_product_id' => 48,
                'g_user_id' => 48,
                'sl_list_price_id' => 48,
                'init_datetime' => '2013-01-05',
                'finish_datetime' => '2009-07-09',
            ),
            48 => 
            array (
                'id' => 49,
                'wh_product_id' => 49,
                'g_user_id' => 49,
                'sl_list_price_id' => 49,
                'init_datetime' => '2023-03-30',
                'finish_datetime' => '2028-03-10',
            ),
            49 => 
            array (
                'id' => 50,
                'wh_product_id' => 50,
                'g_user_id' => 50,
                'sl_list_price_id' => 50,
                'init_datetime' => '2026-01-19',
                'finish_datetime' => '2017-04-14',
            ),
            50 => 
            array (
                'id' => 51,
                'wh_product_id' => 51,
                'g_user_id' => 51,
                'sl_list_price_id' => 51,
                'init_datetime' => '2015-05-22',
                'finish_datetime' => '2017-12-17',
            ),
            51 => 
            array (
                'id' => 52,
                'wh_product_id' => 52,
                'g_user_id' => 52,
                'sl_list_price_id' => 52,
                'init_datetime' => '2027-07-25',
                'finish_datetime' => '2012-01-31',
            ),
            52 => 
            array (
                'id' => 53,
                'wh_product_id' => 53,
                'g_user_id' => 53,
                'sl_list_price_id' => 53,
                'init_datetime' => '2021-10-05',
                'finish_datetime' => '2021-11-11',
            ),
            53 => 
            array (
                'id' => 54,
                'wh_product_id' => 54,
                'g_user_id' => 54,
                'sl_list_price_id' => 54,
                'init_datetime' => '2022-11-18',
                'finish_datetime' => '2014-07-16',
            ),
            54 => 
            array (
                'id' => 55,
                'wh_product_id' => 55,
                'g_user_id' => 55,
                'sl_list_price_id' => 55,
                'init_datetime' => '2009-09-05',
                'finish_datetime' => '2027-02-23',
            ),
            55 => 
            array (
                'id' => 56,
                'wh_product_id' => 56,
                'g_user_id' => 56,
                'sl_list_price_id' => 56,
                'init_datetime' => '2021-01-16',
                'finish_datetime' => '2009-12-01',
            ),
            56 => 
            array (
                'id' => 57,
                'wh_product_id' => 57,
                'g_user_id' => 57,
                'sl_list_price_id' => 57,
                'init_datetime' => '2018-12-29',
                'finish_datetime' => '2014-04-20',
            ),
            57 => 
            array (
                'id' => 58,
                'wh_product_id' => 58,
                'g_user_id' => 58,
                'sl_list_price_id' => 58,
                'init_datetime' => '2020-09-06',
                'finish_datetime' => '2009-03-10',
            ),
            58 => 
            array (
                'id' => 59,
                'wh_product_id' => 59,
                'g_user_id' => 59,
                'sl_list_price_id' => 59,
                'init_datetime' => '2024-05-18',
                'finish_datetime' => '2012-11-01',
            ),
            59 => 
            array (
                'id' => 60,
                'wh_product_id' => 60,
                'g_user_id' => 60,
                'sl_list_price_id' => 60,
                'init_datetime' => '2025-08-10',
                'finish_datetime' => '2024-11-20',
            ),
            60 => 
            array (
                'id' => 61,
                'wh_product_id' => 61,
                'g_user_id' => 61,
                'sl_list_price_id' => 61,
                'init_datetime' => '2012-12-29',
                'finish_datetime' => '2014-01-24',
            ),
            61 => 
            array (
                'id' => 62,
                'wh_product_id' => 62,
                'g_user_id' => 62,
                'sl_list_price_id' => 62,
                'init_datetime' => '2010-02-11',
                'finish_datetime' => '2017-10-09',
            ),
            62 => 
            array (
                'id' => 63,
                'wh_product_id' => 63,
                'g_user_id' => 63,
                'sl_list_price_id' => 63,
                'init_datetime' => '2013-11-02',
                'finish_datetime' => '2026-07-30',
            ),
            63 => 
            array (
                'id' => 64,
                'wh_product_id' => 64,
                'g_user_id' => 64,
                'sl_list_price_id' => 64,
                'init_datetime' => '2025-03-23',
                'finish_datetime' => '2028-04-19',
            ),
            64 => 
            array (
                'id' => 65,
                'wh_product_id' => 65,
                'g_user_id' => 65,
                'sl_list_price_id' => 65,
                'init_datetime' => '2011-07-21',
                'finish_datetime' => '2013-06-01',
            ),
            65 => 
            array (
                'id' => 66,
                'wh_product_id' => 66,
                'g_user_id' => 66,
                'sl_list_price_id' => 66,
                'init_datetime' => '2021-05-27',
                'finish_datetime' => '2022-09-09',
            ),
            66 => 
            array (
                'id' => 67,
                'wh_product_id' => 67,
                'g_user_id' => 67,
                'sl_list_price_id' => 67,
                'init_datetime' => '2021-04-15',
                'finish_datetime' => '2018-04-11',
            ),
            67 => 
            array (
                'id' => 68,
                'wh_product_id' => 68,
                'g_user_id' => 68,
                'sl_list_price_id' => 68,
                'init_datetime' => '2027-08-16',
                'finish_datetime' => '2009-10-31',
            ),
            68 => 
            array (
                'id' => 69,
                'wh_product_id' => 69,
                'g_user_id' => 69,
                'sl_list_price_id' => 69,
                'init_datetime' => '2026-12-08',
                'finish_datetime' => '2023-11-26',
            ),
            69 => 
            array (
                'id' => 70,
                'wh_product_id' => 70,
                'g_user_id' => 70,
                'sl_list_price_id' => 70,
                'init_datetime' => '2021-09-27',
                'finish_datetime' => '2017-12-30',
            ),
            70 => 
            array (
                'id' => 71,
                'wh_product_id' => 71,
                'g_user_id' => 71,
                'sl_list_price_id' => 71,
                'init_datetime' => '2015-05-22',
                'finish_datetime' => '2009-06-24',
            ),
            71 => 
            array (
                'id' => 72,
                'wh_product_id' => 72,
                'g_user_id' => 72,
                'sl_list_price_id' => 72,
                'init_datetime' => '2010-02-22',
                'finish_datetime' => '2016-07-26',
            ),
            72 => 
            array (
                'id' => 73,
                'wh_product_id' => 73,
                'g_user_id' => 73,
                'sl_list_price_id' => 73,
                'init_datetime' => '2014-07-14',
                'finish_datetime' => '2018-08-14',
            ),
            73 => 
            array (
                'id' => 74,
                'wh_product_id' => 74,
                'g_user_id' => 74,
                'sl_list_price_id' => 74,
                'init_datetime' => '2015-10-12',
                'finish_datetime' => '2012-11-02',
            ),
            74 => 
            array (
                'id' => 75,
                'wh_product_id' => 75,
                'g_user_id' => 75,
                'sl_list_price_id' => 75,
                'init_datetime' => '2021-11-17',
                'finish_datetime' => '2009-12-06',
            ),
            75 => 
            array (
                'id' => 76,
                'wh_product_id' => 76,
                'g_user_id' => 76,
                'sl_list_price_id' => 76,
                'init_datetime' => '2021-03-12',
                'finish_datetime' => '2021-08-30',
            ),
            76 => 
            array (
                'id' => 77,
                'wh_product_id' => 77,
                'g_user_id' => 77,
                'sl_list_price_id' => 77,
                'init_datetime' => '2017-01-05',
                'finish_datetime' => '2012-12-08',
            ),
            77 => 
            array (
                'id' => 78,
                'wh_product_id' => 78,
                'g_user_id' => 78,
                'sl_list_price_id' => 78,
                'init_datetime' => '2011-12-07',
                'finish_datetime' => '2018-07-05',
            ),
            78 => 
            array (
                'id' => 79,
                'wh_product_id' => 79,
                'g_user_id' => 79,
                'sl_list_price_id' => 79,
                'init_datetime' => '2027-10-10',
                'finish_datetime' => '2012-07-20',
            ),
            79 => 
            array (
                'id' => 80,
                'wh_product_id' => 80,
                'g_user_id' => 80,
                'sl_list_price_id' => 80,
                'init_datetime' => '2023-04-13',
                'finish_datetime' => '2023-09-19',
            ),
            80 => 
            array (
                'id' => 81,
                'wh_product_id' => 81,
                'g_user_id' => 81,
                'sl_list_price_id' => 81,
                'init_datetime' => '2016-09-16',
                'finish_datetime' => '2028-03-10',
            ),
            81 => 
            array (
                'id' => 82,
                'wh_product_id' => 82,
                'g_user_id' => 82,
                'sl_list_price_id' => 82,
                'init_datetime' => '2020-11-16',
                'finish_datetime' => '2012-11-13',
            ),
            82 => 
            array (
                'id' => 83,
                'wh_product_id' => 83,
                'g_user_id' => 83,
                'sl_list_price_id' => 83,
                'init_datetime' => '2016-10-31',
                'finish_datetime' => '2022-06-06',
            ),
            83 => 
            array (
                'id' => 84,
                'wh_product_id' => 84,
                'g_user_id' => 84,
                'sl_list_price_id' => 84,
                'init_datetime' => '2015-12-03',
                'finish_datetime' => '2015-12-07',
            ),
            84 => 
            array (
                'id' => 85,
                'wh_product_id' => 85,
                'g_user_id' => 85,
                'sl_list_price_id' => 85,
                'init_datetime' => '2019-03-04',
                'finish_datetime' => '2022-02-06',
            ),
            85 => 
            array (
                'id' => 86,
                'wh_product_id' => 86,
                'g_user_id' => 86,
                'sl_list_price_id' => 86,
                'init_datetime' => '2017-08-27',
                'finish_datetime' => '2016-09-05',
            ),
            86 => 
            array (
                'id' => 87,
                'wh_product_id' => 87,
                'g_user_id' => 87,
                'sl_list_price_id' => 87,
                'init_datetime' => '2020-06-08',
                'finish_datetime' => '2017-10-29',
            ),
            87 => 
            array (
                'id' => 88,
                'wh_product_id' => 88,
                'g_user_id' => 88,
                'sl_list_price_id' => 88,
                'init_datetime' => '2022-07-22',
                'finish_datetime' => '2015-06-27',
            ),
            88 => 
            array (
                'id' => 89,
                'wh_product_id' => 89,
                'g_user_id' => 89,
                'sl_list_price_id' => 89,
                'init_datetime' => '2022-06-13',
                'finish_datetime' => '2010-03-19',
            ),
            89 => 
            array (
                'id' => 90,
                'wh_product_id' => 90,
                'g_user_id' => 90,
                'sl_list_price_id' => 90,
                'init_datetime' => '2018-07-01',
                'finish_datetime' => '2018-02-18',
            ),
            90 => 
            array (
                'id' => 91,
                'wh_product_id' => 91,
                'g_user_id' => 91,
                'sl_list_price_id' => 91,
                'init_datetime' => '2025-07-22',
                'finish_datetime' => '2027-12-08',
            ),
            91 => 
            array (
                'id' => 92,
                'wh_product_id' => 92,
                'g_user_id' => 92,
                'sl_list_price_id' => 92,
                'init_datetime' => '2017-03-28',
                'finish_datetime' => '2022-09-02',
            ),
            92 => 
            array (
                'id' => 93,
                'wh_product_id' => 93,
                'g_user_id' => 93,
                'sl_list_price_id' => 93,
                'init_datetime' => '2023-05-25',
                'finish_datetime' => '2010-09-08',
            ),
            93 => 
            array (
                'id' => 94,
                'wh_product_id' => 94,
                'g_user_id' => 94,
                'sl_list_price_id' => 94,
                'init_datetime' => '2015-03-01',
                'finish_datetime' => '2020-05-19',
            ),
            94 => 
            array (
                'id' => 95,
                'wh_product_id' => 95,
                'g_user_id' => 95,
                'sl_list_price_id' => 95,
                'init_datetime' => '2016-09-18',
                'finish_datetime' => '2019-12-13',
            ),
            95 => 
            array (
                'id' => 96,
                'wh_product_id' => 96,
                'g_user_id' => 96,
                'sl_list_price_id' => 96,
                'init_datetime' => '2018-08-21',
                'finish_datetime' => '2015-04-21',
            ),
            96 => 
            array (
                'id' => 97,
                'wh_product_id' => 97,
                'g_user_id' => 97,
                'sl_list_price_id' => 97,
                'init_datetime' => '2017-08-03',
                'finish_datetime' => '2028-08-08',
            ),
            97 => 
            array (
                'id' => 98,
                'wh_product_id' => 98,
                'g_user_id' => 98,
                'sl_list_price_id' => 98,
                'init_datetime' => '2024-07-25',
                'finish_datetime' => '2027-12-27',
            ),
            98 => 
            array (
                'id' => 99,
                'wh_product_id' => 99,
                'g_user_id' => 99,
                'sl_list_price_id' => 99,
                'init_datetime' => '2025-02-24',
                'finish_datetime' => '2021-04-18',
            ),
            99 => 
            array (
                'id' => 100,
                'wh_product_id' => 100,
                'g_user_id' => 100,
                'sl_list_price_id' => 100,
                'init_datetime' => '2016-09-21',
                'finish_datetime' => '2016-12-09',
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('audit_historic_price')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}