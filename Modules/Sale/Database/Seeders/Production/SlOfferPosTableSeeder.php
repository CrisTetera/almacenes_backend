<?php

namespace Modules\Sale\Database\Seeders\Production;

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
           
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('sl_offer_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);


    }
}
