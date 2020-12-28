<?php

namespace Modules\General\Database\Seeders\local;
use Illuminate\Database\Seeder;

class GSystemConfigurationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('g_system_configuration')->delete();
        
        
        // $now = \Carbon\Carbon::now();
        // \DB::table('g_system_configuration')->update([
        //     'created_at' => $now,
        //     'updated_at' => $now
        // ]);
        
    }
}