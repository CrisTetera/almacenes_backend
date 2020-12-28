<?php

namespace Modules\General\Database\Seeders\local;
use Illuminate\Database\Seeder;

class GBankTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('g_bank')->delete();
        
        \DB::table('g_bank')->insert(array (
            0 => 
            array (
                'id' => 1,
                'bank' => 'Banco de Chile',
                'flag_delete' => false,
            ),
            1 => 
            array (
                'id' => 2,
                'bank' => 'Banco Internacional',
                'flag_delete' => false,
            ),
            2 => 
            array (
                'id' => 3,
                'bank' => 'ScotiaBank Chile',
                'flag_delete' => false,
            ),
            3 => 
            array (
                'id' => 4,
                'bank' => 'Banco de Créditos e Inversiones',
                'flag_delete' => false,
            ),
            4 => 
            array (
                'id' => 5,
                'bank' => 'Banco Bice',
                'flag_delete' => false,
            ),
            5 => 
            array (
                'id' => 6,
                'bank' => 'HSBC Bank',
                'flag_delete' => false,
            ),
            6 => 
            array (
                'id' => 7,
                'bank' => 'Banco Santander',
                'flag_delete' => false,
            ),
            7 => 
            array (
                'id' => 8,
                'bank' => 'Itaú-Corpbanca',
                'flag_delete' => false,
            ),
            8 => 
            array (
                'id' => 9,
                'bank' => 'Banco Security',
                'flag_delete' => false,
            ),
            9 => 
            array (
                'id' => 10,
                'bank' => 'Banco Falabella',
                'flag_delete' => false,
            ),
            10 => 
            array (
                'id' => 11,
                'bank' => 'Banco Ripley',
                'flag_delete' => false,
            ),
            11 => 
            array (
                'id' => 12,
                'bank' => 'Banco Consorcio',
                'flag_delete' => false,
            ),
            12 => 
            array (
                'id' => 13,
                'bank' => 'BBVA',
                'flag_delete' => false,
            ),
            13 => 
            array (
                'id' => 14,
                'bank' => 'Banco BTG Pactual',
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('g_bank')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}