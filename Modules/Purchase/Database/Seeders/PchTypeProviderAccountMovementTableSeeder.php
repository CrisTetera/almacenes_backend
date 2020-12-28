<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;

class PchTypeProviderAccountMovementTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pch_type_provider_account_movement')->delete();
        
        \DB::table('pch_type_provider_account_movement')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type' => 'Entrada',
            ),
            1 => 
            array (
                'id' => 2,
                'type' => 'Salida',
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_type_provider_account_movement')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}