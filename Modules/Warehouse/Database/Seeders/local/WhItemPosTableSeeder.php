<?php

namespace Modules\Warehouse\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WhItemPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('wh_item_pos')->delete();

        \DB::table('wh_item_pos')->insert(array (
            //COCA-COLA
            0 =>
            array (
                'wh_product_id' => 1,
                'have_decimal_quantity' => false,
                'flag_delete' => false,
            ),
            1 =>
            array (
                'wh_product_id' => 2,
                'have_decimal_quantity' => false,
                'flag_delete' => false,
            ),
            2 =>
            array (
                'wh_product_id' => 3,
                'have_decimal_quantity' => false,
                'flag_delete' => false,
            ),
            // BALTILOCA
            3 =>
            array (
                'wh_product_id' => 4,
                'have_decimal_quantity' => false,
                'flag_delete' => false,
            ),
            // PAPAS KRYSPO
            4 =>
            array (
                'wh_product_id' => 6,
                'have_decimal_quantity' => false,
                'flag_delete' => false,
            ),
            // HARINA 1KG
            5 =>
            array (
                'wh_product_id' => 9,
                'have_decimal_quantity' => true,
                'flag_delete' => false,
            ),
            // AVENA 1 KG
            6 =>
            array (
                'wh_product_id' => 10,
                'have_decimal_quantity' => false,
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('wh_item_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
