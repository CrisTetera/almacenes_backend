<?php

namespace Modules\Pos\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PosSaleStockReservationPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pos_sale_stock_reservation_pos')->delete();

        \DB::table('pos_sale_stock_reservation_pos')->insert(array(
            array(
                'pos_sale_id' => 1,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 4,
                'stock' => 30,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 1,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 5,
                'stock' => 8,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 2,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 4,
                'stock' => 30,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 2,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 5,
                'stock' => 8,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 3,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 4,
                'stock' => 30,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 3,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 5,
                'stock' => 8,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 4,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 4,
                'stock' => 30,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 4,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 5,
                'stock' => 8,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 5,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 4,
                'stock' => 30,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 5,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 5,
                'stock' => 8,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 6,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 4,
                'stock' => 30,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 6,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 5,
                'stock' => 8,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 7,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 4,
                'stock' => 30,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 7,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 5,
                'stock' => 8,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 8,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 4,
                'stock' => 30,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 8,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 5,
                'stock' => 8,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 9,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 4,
                'stock' => 30,
                'flag_delete' => false
            ),
            array(
                'pos_sale_id' => 9,
                'wh_warehouse_id' => 1,
                'wh_item_id' => 5,
                'stock' => 8,
                'flag_delete' => false
            ),
        ));
    }
}
