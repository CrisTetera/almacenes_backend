<?php

namespace Modules\Sale\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SlOfferPosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('sl_offer_pos')->delete();

        \DB::table('sl_offer_pos')->insert(array (
            0 =>
            array (
                'wh_product_id' => 1,
                'name' => 'offer from Seed',
                'offer_price' => 800,
                'init_datetime' => date('Y-m-d', strtotime('-2 days')),
                'finish_datetime' => date('Y-m-d', strtotime('+9 days')),
                'flag_delete' => false,
            ),
            1 =>
            array (
                'wh_product_id' => 2,
                'name' => 'offer from Seed',
                'offer_price' => 150,
                'init_datetime' => date('Y-m-d'),
                'finish_datetime' => date('Y-m-d'),
                'flag_delete' => false,
            ),
            2 =>
            array (
                'wh_product_id' => 3,
                'name' => 'offer from Seed',
                'offer_price' => 900,
                'init_datetime' => '2019-06-09',
                'finish_datetime' => '2029-01-08',
                'flag_delete' => false,
            ),
            3 =>
            array (
                'wh_product_id' => 4,
                'name' => 'offer from Seed',
                'offer_price' => 200,
                'init_datetime' => '2013-10-19',
                'finish_datetime' => '2027-06-22',
                'flag_delete' => true,
            ),
            4 =>
            array (
                'wh_product_id' => 5,
                'name' => 'offer from Seed',
                'offer_price' => 2000,
                'init_datetime' => '2016-09-07',
                'finish_datetime' => '2015-05-26',
                'flag_delete' => false,
            ),
            5 =>
            array (
                'wh_product_id' => 6,
                'name' => 'offer from Seed',
                'offer_price' => 800,
                'init_datetime' => '2026-04-21',
                'finish_datetime' => '2017-02-23',
                'flag_delete' => true,
            ),
            6 =>
            array (
                'wh_product_id' => 7,
                'name' => 'offer from Seed',
                'offer_price' => 2500,
                'init_datetime' => '2014-10-25',
                'finish_datetime' => '2017-03-10',
                'flag_delete' => false,
            ),
            7 =>
            array (
                'name' => 'offer from Seed',
                'wh_product_id' => 8,
                'offer_price' => 1500,
                'init_datetime' => '2025-02-11',
                'finish_datetime' => '2013-04-21',
                'flag_delete' => true,
            ),
            8 =>
            array (
                'name' => 'offer from Seed',
                'wh_product_id' => 9,
                'offer_price' => 800,
                'init_datetime' => '2013-04-30',
                'finish_datetime' => '2019-02-19',
                'flag_delete' => true,
            ),
            9 =>
            array (
                'name' => 'offer from Seed',
                'wh_product_id' => 10,
                'offer_price' => 1000,
                'init_datetime' => '2015-10-13',
                'finish_datetime' => '2017-08-03',
                'flag_delete' => false,
            ),
            10 =>
            array (
                'name' => 'offer from Seed',
                'wh_product_id' => 11,
                'offer_price' => 1800,
                'init_datetime' => '2014-03-22',
                'finish_datetime' => '2017-05-28',
                'flag_delete' => true,
            ),
            11 =>
            array (
                'name' => 'offer from Seed',
                'wh_product_id' => 12,
                'offer_price' => 15000,
                'init_datetime' => '2011-06-15',
                'finish_datetime' => '2014-04-08',
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('sl_offer_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);


    }
}
