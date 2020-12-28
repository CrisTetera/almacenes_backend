<?php

namespace Modules\Pos\Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;

class PosPaymentMethodPosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('pos_payment_method_pos')->delete();

        \DB::table('pos_payment_method_pos')->insert(array (
            
        ));
        $now = \Carbon\Carbon::now();
        \DB::table('pos_payment_method_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);

    }
}
