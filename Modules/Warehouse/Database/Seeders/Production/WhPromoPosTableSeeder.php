<?php

namespace Modules\Warehouse\Database\Seeders\Production;

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
            
            
        ));
        
        $now = \Carbon\Carbon::now();
        \DB::table('wh_promo_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
