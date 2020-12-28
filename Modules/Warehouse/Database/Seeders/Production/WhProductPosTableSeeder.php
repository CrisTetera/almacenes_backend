<?php

namespace Modules\Warehouse\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class WhProductPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('wh_product_pos')->delete();

        /**
         * 12 productos,
         * 
         */

        $productArray = array();
        
        \DB::table('wh_product_pos')->insert($productArray);

        $now = \Carbon\Carbon::now();
        \DB::table('wh_product_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
