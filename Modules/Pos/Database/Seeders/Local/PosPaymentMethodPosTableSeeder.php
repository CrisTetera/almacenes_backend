<?php

namespace Modules\Pos\Database\Seeders\local;

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
            0 =>
            array (
                'pos_type_payment_method_id' => SaleConstant::PAYMENT_TYPE_EFECTIVO,
                'pos_sale_id' => 1,
                'amount_payment' => 17500,
            ),
        ));
        $now = \Carbon\Carbon::now();
        \DB::table('pos_payment_method_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);

    }
}
