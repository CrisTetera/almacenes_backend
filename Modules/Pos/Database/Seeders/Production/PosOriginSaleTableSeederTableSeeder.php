<?php

namespace Modules\Pos\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PosOriginSaleTableSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \DB::table('pos_origin_sale')->delete();
        
        \DB::table('pos_origin_sale')->insert(array (
            0 => 
            array (
                'id' => 1,
                'origin_sale' => 'En Sala',
                'flag_delete' => false,
            ),
            1 => 
            array (
                'id' => 2,
                'origin_sale' => 'En Terreno',
                'flag_delete' => false,
            ),
            2 => array (
                'id' => 3,
                'origin_sale' => 'Call Center',
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pos_origin_sale')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
