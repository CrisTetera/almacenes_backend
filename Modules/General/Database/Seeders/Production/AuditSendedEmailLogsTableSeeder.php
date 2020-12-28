<?php

namespace Modules\General\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AuditSendedEmailLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('audit_sended_email_logs')->delete();
        
        $now = \Carbon\Carbon::now();
        \DB::table('audit_sended_email_logs')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}