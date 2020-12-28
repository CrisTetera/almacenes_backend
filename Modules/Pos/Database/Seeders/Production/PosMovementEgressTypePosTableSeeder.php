<?php

namespace Modules\Pos\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class PosMovementEgressTypePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pos_movement_egress_type_pos')->delete();
        
        \DB::table('pos_movement_egress_type_pos')->insert(array (
            
            // 0=> 
            // array (
            //     'type' => $faker->word,
            // ),
        ));
        
        $now = \Carbon\Carbon::now();
        \DB::table('pos_movement_egress_type_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
