<?php

namespace Modules\General\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GStateTypePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('g_state_type_pos')->delete();

        \DB::table('g_state_type_pos')->insert(array (
            
            0 =>
            array (
                'id' => 1,
                'state_type' => 'Caja Diaria',
            ),
            1 =>
            array (
                'id' => 2,
                'state_type' => 'Pedido',
            ),
            2 =>
            array (
                'id' => 3,
                'state_type' => 'Inventario',
            ),
            3 =>
            array (
                'id' => 4,
                'state_type' => 'Venta',
            ),
            4 =>
            array (
                'id' => 5,
                'state_type' => 'Factura de venta',
            ),
            5 =>
            array (
                'id' => 6,
                'state_type' => 'Boleta de venta',
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('g_state_type')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
