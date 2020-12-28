<?php

namespace Modules\Sale\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SlPriceListPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sl_price_list_pos')->delete();

        \DB::table('sl_price_list_pos')->insert(array (
            // COCA-COLA
            
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('sl_price_list_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);

    }
}
