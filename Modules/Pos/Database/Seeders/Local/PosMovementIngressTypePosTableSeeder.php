<?php

namespace Modules\Pos\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;

class PosMovementIngressTypePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pos_movement_ingress_type_pos')->delete();
        
        \DB::table('pos_movement_ingress_type_pos')->insert(array (
            0 => 
            array (
                // 'id' => 1,
                'type' => 'Apertura de Caja',
            ),
            1 => 
            array (
                // 'id' => 2,
                'type' => 'Pago de Fiado',
            ),
            2 => 
            array (
                // 'id' => 3,
                'type' => $faker->word,
            ),
            3 => 
            array (
                // 'id' => 4,
                'type' => $faker->word,
            ),
            4 => 
            array (
                // 'id' => 5,
                'type' => $faker->word,
            ),
            5 => 
            array (
                // 'id' => 6,
                'type' => $faker->word,
            ),
            6 => 
            array (
                // 'id' => 7,
                'type' => $faker->word,
            ),
            7 => 
            array (
                // 'id' => 8,
                'type' => $faker->word,
            ),
            8 => 
            array (
                // 'id' => 9,
                'type' => $faker->word,
            ),
            9 => 
            array (
                // 'id' => 10,
                'type' => $faker->word,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pos_movement_ingress_type_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
    }
}
