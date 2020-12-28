<?php

namespace Modules\Pos\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PosDetailPosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pos_detail_pos')->delete();

        \DB::table('pos_detail_pos')->insert(array (
            // (1) Sale Test
            
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pos_detail_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);


    }
}
