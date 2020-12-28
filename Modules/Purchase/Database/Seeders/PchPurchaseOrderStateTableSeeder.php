<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;

class PchPurchaseOrderStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pch_purchase_order_state')->delete();

        \DB::table('pch_purchase_order_state')->insert(array (
            0 =>
            array (
                'state' => 'Creada',
                'flag_delete' => false,
            ),
            1 =>
            array (
                'state' => 'Autorizada',
                'flag_delete' => false,
            ),
            2 =>
            array (
                'state' => 'Pendiente a Enviar Correo',
                'flag_delete' => false,
            ),
            3 =>
            array (
                'state' => 'En Trámite',
                'flag_delete' => false,
            ),
            4 =>
            array (
                'state' => 'Recepcionado',
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_purchase_order_state')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
