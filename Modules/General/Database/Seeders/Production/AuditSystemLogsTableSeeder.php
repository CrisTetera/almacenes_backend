<?php

namespace Modules\General\Database\Seeders\Production;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AuditSystemLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('audit_system_logs')->delete();
        

        
        $now = \Carbon\Carbon::now();
        \DB::table('audit_system_logs')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}