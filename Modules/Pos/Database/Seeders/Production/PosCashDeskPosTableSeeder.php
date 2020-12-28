<?php

namespace Modules\Pos\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;

class PosCashDeskPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pos_cash_desk_pos')->delete();
        
        \DB::table('pos_cash_desk_pos')->insert(array (
            0 => 
            array (
                'number' => '001',
                'flag_delete' => false,
            ),
            1 => 
            array (
                'number' => '002',
                'flag_delete' => false,
            ),
            2 => 
            array (
                'number' => '003',
                'flag_delete' => true,
            ),
            3 => 
            array (
                'number' => '004',
                'flag_delete' => true,
            ),
            4 => 
            array (
                'number' => '005',
                'flag_delete' => true,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pos_cash_desk_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
