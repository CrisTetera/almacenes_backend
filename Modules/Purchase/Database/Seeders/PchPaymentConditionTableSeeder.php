<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;

class PchPaymentConditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pch_payment_condition')->delete();

        \DB::table('pch_payment_condition')->insert(array (
            0 =>
            array (
                'type' => '30 días',
                'flag_delete' => false,
            ),
            1 =>
            array (
                'type' => '60 días',
                'flag_delete' => false,
            ),
            2 =>
            array (
                'type' => '90 días',
                'flag_delete' => false,
            ),
            3 =>
            array (
                'type' => 'Anticipado',
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_payment_condition')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
