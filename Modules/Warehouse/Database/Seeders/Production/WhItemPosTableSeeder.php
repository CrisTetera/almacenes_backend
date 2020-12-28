<?php

namespace Modules\Warehouse\Database\Seeders\Production;

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
            
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('wh_item_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
