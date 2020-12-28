<?php

namespace Modules\Pos\Database\Seeders\Production;

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
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pos_movement_ingress_type_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
    }
}
