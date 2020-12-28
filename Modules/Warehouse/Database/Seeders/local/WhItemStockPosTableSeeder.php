<?php

namespace Modules\Warehouse\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WhItemStockPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('wh_item_stock_pos')->delete();

        \DB::table('wh_item_stock_pos')->insert(array (
            
            // Warehouse 1 => Coca-Cola[id=1]: 1000
            0 =>
            array ('wh_warehouse_id' => 1, 'wh_item_id' => 1, 'stock' => 1000),
            
            // Warehouse 1 => Some Product[id=2]: 500
            1 =>
            array ('wh_warehouse_id' => 1,'wh_item_id' => 2,'stock' => 500),
            
            // Warehouse 5 => Product 3[id=4]: 1000
            2 =>
            array ('wh_warehouse_id' => 1, 'wh_item_id' => 3, 'stock' => 1000),
            
            // Warehouse 10 => Baltiloca[id=4]: 1000,
            3 =>
            array ('wh_warehouse_id' => 1,'wh_item_id' => 4,'stock' => 1000),
            
            // Warehouse 10 => Papas Kryspo[id=8]: 1300
            4 =>
            array ('wh_warehouse_id' => 1, 'wh_item_id' => 5, 'stock' => 1300),
            
            // Warehouse 10 => Harina[id=6]: 300
            5 =>
            array ('wh_warehouse_id' => 1,'wh_item_id' => 6,'stock' => 300),
            
            // Warehouse 15 => Avena[id=7]: 200
            6 =>
            array ('wh_warehouse_id' => 1, 'wh_item_id' => 7, 'stock' => 200),
            
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('wh_item_stock_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
