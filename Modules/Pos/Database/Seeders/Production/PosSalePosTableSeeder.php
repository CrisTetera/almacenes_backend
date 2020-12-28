<?php

namespace Modules\Pos\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Modules\Pos\Services\PosSalePos\Entities\SaleConstant;

class PosSalePosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pos_sale_pos')->delete();

        \DB::table('pos_sale_pos')->insert(array (
            
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pos_sale_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);

    }
}
