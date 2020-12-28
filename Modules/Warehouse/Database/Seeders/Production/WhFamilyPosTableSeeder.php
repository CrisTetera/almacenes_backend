<?php

namespace Modules\Warehouse\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

class WhFamilyPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('wh_family_pos')->delete();

        \DB::table('wh_family_pos')->insert(array (
            
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('wh_family_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
