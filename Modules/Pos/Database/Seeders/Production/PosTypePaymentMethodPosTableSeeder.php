<?php

namespace Modules\Pos\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PosTypePaymentMethodPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pos_type_payment_method_pos')->delete();

        \DB::table('pos_type_payment_method_pos')->insert(array (
            0 =>
            array (
                'id' => 1,
                'type' => 'Efectivo',
            ),
            1 =>
            array (
                'id' => 2,
                'type' => 'Débito',
            ),
            2 =>
            array (
                'id' => 3,
                'type' => 'Crédito',
            ),
            3 =>
            array (
                'id' => 4,
                'type' => 'Fiado',
            ),
            4 =>
            array (
                'id' => 5,
                'type' => 'Transferencia Electrónica',
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pos_type_payment_method_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
