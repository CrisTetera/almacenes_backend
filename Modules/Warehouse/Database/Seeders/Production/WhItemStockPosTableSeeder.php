<?php

namespace Modules\Warehouse\Database\Seeders\Production;

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
            
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('wh_item_stock_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
