<?php

namespace Modules\Pos\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PosSaleTypePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pos_sale_type_pos')->delete();
        
        \DB::table('pos_sale_type_pos')->insert(array (
            0 => 
            array (
                'type' => 'Boleta',
                'flag_delete' => 'false'
            ),
            1 => 
            array (
                'type' => 'Factura',
                'flag_delete' => 'false'
            ),
            2 => 
            array (
                'type' => 'Fiado',
                'flag_delete' => 'false'
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pos_sale_type_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
