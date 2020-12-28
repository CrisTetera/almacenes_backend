<?php

namespace Modules\Pos\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PosSaleStockReservationPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pos_sale_stock_reservation_pos')->delete();

        \DB::table('pos_sale_stock_reservation_pos')->insert(array(
            
        ));
    }
}
