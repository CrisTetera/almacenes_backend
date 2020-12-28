<?php

namespace Modules\Warehouse\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WhPackPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('wh_pack_pos')->delete();
        
        \DB::table('wh_pack_pos')->insert(array (
            // PACK DE BALTILOCAS
            0 => 
            array (
                'wh_product_id' => 5,
                'wh_item_id' => 4, // BALTILOCAS
                'item_quantity' => 6,
                'flag_delete' => false,
            ),
            // PACK PAPAS KRYSPO
            1 => 
            array (
                'wh_product_id' => 8,
                'wh_item_id' => 5, // PAPAS KRYSPO
                'item_quantity' => '2',
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('wh_pack_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
