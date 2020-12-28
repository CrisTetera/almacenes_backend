<?php

namespace Modules\General\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GStatePosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('g_state_pos')->delete();

        \DB::table('g_state_pos')->insert(array (
            // Daily Cash
            1 =>
            array (
                'id' => 1,
                'g_state_type_id' => 1,
                'state' => 'Realizada',
            ),
            2 =>
            array (
                'id' => 2,
                'g_state_type_id' => 1,
                'state' => 'Confirmada',
            ),
            3 =>
            array (
                'id' => 3,
                'g_state_type_id' => 5,
                'state' => 'Realizado',
            ),
            4 =>
            array (
                'id' => 4,
                'g_state_type_id' => 5,
                'state' => 'Liberado',
            ),
            5 =>
            array (
                'id' => 5,
                'g_state_type_id' => 5,
                'state' => 'Completado', // O Recibido
            ),
            // Inventario
            6=> array (
                'id' => 6,
                'g_state_type_id' => 3,
                'state' => 'Pendiente',
            ),
            array (
                'id' => 7,
                'g_state_type_id' => 3,
                'state' => 'Realizado',
            ),
            array (
                'id' => 8,
                'g_state_type_id' => 3,
                'state' => 'Confirmado',
            ),
            // Venta y Venta Empleado
            array (
                'id' => 9,
                'g_state_type_id' => 4,
                'state' => 'Vale Venta', // Vendedora genera vale venta
                //'state_sequence' => 0,
            ),
            array (
                'id' => 10,
                'g_state_type_id' => 4,
                'state' => 'Anulada', // Se anula la venta
                //'state_sequence' => 1,
            ),
            array (
                'id' => 11,
                'g_state_type_id' => 4,
                'state' => 'Realizada', // Cliente paga (está todo OK)
                //'state_sequence' => 2,
            ),
            // Daily Cash (continuation)
            array (
                'id' => 12,
                'g_state_type_id' => 1,
                'state' => 'Abierta',
                //'state_sequence' => 0,
            ),
            // Sale Invoice
            array (
                'id' => 13,
                'g_state_type_id' => 5,
                'state' => 'No Pagada',
               // 'state_sequence' => 1,
            ),
            array (
                'id' => 14,
                'g_state_type_id' => 5,
                'state' => 'Pagada',
                //'state_sequence' => 2,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('g_state_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
