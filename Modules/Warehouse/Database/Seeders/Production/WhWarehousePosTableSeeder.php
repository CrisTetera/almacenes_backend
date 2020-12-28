<?php

namespace Modules\Warehouse\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class WhWarehousePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('wh_warehouse_pos')->delete();

        \DB::table('wh_warehouse_pos')->insert(array (
            0 =>
            array (
                'name' => 'BOD-001',
                'description' => $faker->realText(),
                'address' => 'Avenida Siempre Viva #742',
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('wh_warehouse_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
