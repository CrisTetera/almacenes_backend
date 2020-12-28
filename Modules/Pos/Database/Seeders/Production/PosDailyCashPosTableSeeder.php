<?php

namespace Modules\Pos\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class PosDailyCashPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pos_daily_cash_pos')->delete();
        
        \DB::table('pos_daily_cash_pos')->insert(array (
            
        ));
        
        $now = \Carbon\Carbon::now();
        \DB::table('pos_daily_cash_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
