<?php

namespace Modules\General\Database\Seeders\Production;
use Illuminate\Database\Seeder;

class GTypeAccountBankTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('g_type_account_bank')->delete();
        
        \DB::table('g_type_account_bank')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type' => 'Cuenta Vista',
            ),
            1 => 
            array (
                'id' => 2,
                'type' => 'Cuenta Corriente',
            ),
            2 => 
            array (
                'id' => 3,
                'type' => 'Cuenta de Ahorro',
            ),
            3 => 
            array (
                'id' => 4,
                'type' => 'Cuenta Chequera Electrónica',
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('g_type_account_bank')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}