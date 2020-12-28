<?php

namespace Modules\General\Database\Seeders\Production;
use Illuminate\Database\Seeder;

class AuditHistoricPriceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('audit_historic_price')->delete();
        

        $now = \Carbon\Carbon::now();
        \DB::table('audit_historic_price')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        
    }
}