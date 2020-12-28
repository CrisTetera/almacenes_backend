<?php

namespace Modules\Pos\Database\Seeders\local;

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
            0 =>
            array (
                'wh_warehouse_id' => 1,
                'wh_product_id' => 12,
                'line_number' => 1,
                'pos_sale_id' => 1,
                'quantity' => 1,
                'price' => 17500,
                'net_price' => 14705.88,
                'net_subtotal' => 14706,
                'discount_percentage' => 0,
                'discount_amount' => 0,
                'new_net_subtotal' => 14706,
                'total' => 17500,
                'flag_delete' => false,
            ),
            1 =>
            array (
                'wh_warehouse_id' => 1,
                'wh_product_id' => 12,
                'line_number' => 1,
                'pos_sale_id' => 2,
                'quantity' => 1,
                'price' => 17500,
                'net_price' => 14705.88,
                'net_subtotal' => 14706,
                'discount_percentage' => 0,
                'discount_amount' => 0,
                'new_net_subtotal' => 14706,
                'total' => 17500,
                'flag_delete' => false,
            ),
            2 =>
            array (
                'wh_warehouse_id' => 1,
                'wh_product_id' => 12,
                'line_number' => 1,
                'pos_sale_id' => 3,
                'quantity' => 1,
                'price' => 17500,
                'net_price' => 14705.88,
                'net_subtotal' => 14706,
                'discount_percentage' => 0,
                'discount_amount' => 0,
                'new_net_subtotal' => 14706,
                'total' => 17500,
                'flag_delete' => false,
            ),
            3 =>
            array (
                'wh_warehouse_id' => 1,
                'wh_product_id' => 12,
                'line_number' => 1,
                'pos_sale_id' => 4,
                'quantity' => 1,
                'price' => 17500,
                'net_price' => 14705.88,
                'net_subtotal' => 14706,
                'discount_percentage' => 0,
                'discount_amount' => 0,
                'new_net_subtotal' => 14706,
                'total' => 17500,
                'flag_delete' => false,
            ),
            4 =>
            array (
                'wh_warehouse_id' => 1,
                'wh_product_id' => 12,
                'line_number' => 1,
                'pos_sale_id' => 5,
                'quantity' => 1,
                'price' => 17500,
                'net_price' => 14705.88,
                'net_subtotal' => 14706,
                'discount_percentage' => 0,
                'discount_amount' => 0,
                'new_net_subtotal' => 14706,
                'total' => 17500,
                'flag_delete' => false,
            ),
            5 =>
            array (
                'wh_warehouse_id' => 1,
                'wh_product_id' => 12,
                'line_number' => 1,
                'pos_sale_id' => 6,
                'quantity' => 1,
                'price' => 17500,
                'net_price' => 14705.88,
                'net_subtotal' => 14706,
                'discount_percentage' => 0,
                'discount_amount' => 0,
                'new_net_subtotal' => 14706,
                'total' => 17500,
                'flag_delete' => false,
            ),
            6 =>
            array (
                'wh_warehouse_id' => 1,
                'wh_product_id' => 12,
                'line_number' => 1,
                'pos_sale_id' => 7,
                'quantity' => 1,
                'price' => 17500,
                'net_price' => 14705.88,
                'net_subtotal' => 14706,
                'discount_percentage' => 0,
                'discount_amount' => 0,
                'new_net_subtotal' => 14706,
                'total' => 17500,
                'flag_delete' => false,
            ),
            7 =>
            array (
                'wh_warehouse_id' => 1,
                'wh_product_id' => 12,
                'line_number' => 1,
                'pos_sale_id' => 8,
                'quantity' => 1,
                'price' => 17500,
                'net_price' => 14705.88,
                'net_subtotal' => 14706,
                'discount_percentage' => 0,
                'discount_amount' => 0,
                'new_net_subtotal' => 14706,
                'total' => 17500,
                'flag_delete' => false,
            ),
            8 =>
            array (
                'wh_warehouse_id' => 1,
                'wh_product_id' => 12,
                'line_number' => 1,
                'pos_sale_id' => 9,
                'quantity' => 1,
                'price' => 17500,
                'net_price' => 14705.88,
                'net_subtotal' => 14706,
                'discount_percentage' => 0,
                'discount_amount' => 0,
                'new_net_subtotal' => 14706,
                'total' => 17500,
                'flag_delete' => false,
            ),
            9 =>
            array (
                'wh_warehouse_id' => 1,
                'wh_product_id' => 12,
                'line_number' => 1,
                'pos_sale_id' => 10,
                'quantity' => 1,
                'price' => 17500,
                'net_price' => 14705.88,
                'net_subtotal' => 14706,
                'discount_percentage' => 0,
                'discount_amount' => 0,
                'new_net_subtotal' => 14706,
                'total' => 17500,
                'flag_delete' => false,
            ),
            10 =>
            array (
                'wh_warehouse_id' => 1,
                'wh_product_id' => 12,
                'line_number' => 1,
                'pos_sale_id' => 11,
                'quantity' => 1,
                'price' => 17500,
                'net_price' => 14705.88,
                'net_subtotal' => 14706,
                'discount_percentage' => 0,
                'discount_amount' => 0,
                'new_net_subtotal' => 14706,
                'total' => 17500,
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pos_detail_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);


    }
}
