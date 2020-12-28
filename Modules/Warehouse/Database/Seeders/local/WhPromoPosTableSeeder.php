<?php

namespace Modules\Warehouse\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WhPromoPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('wh_promo_pos')->delete();
        
        \DB::table('wh_promo_pos')->insert(array (
            // PROMO DE BALTILOCAS + PAPAS KRYSPO
            0 => 
            array (
                'wh_product_id' => 7,
                'flag_delete' => false,
            ),
            // PROMO HARINA + AVENA
            1 => 
            array (
                'wh_product_id' => 11,
                'flag_delete' => false,
            ),
            // HYPER PROMO BALTILOCA + PAPAS KRYSPO
            2 => 
            array (
                'wh_product_id' => 12,
                'flag_delete' => false,
            ),
            
        ));
        
        $now = \Carbon\Carbon::now();
        \DB::table('wh_promo_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
