<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;

class PchPurchaseOrderWhOrdererTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('pch_purchase_order_wh_orderer')->delete();

        \DB::table('pch_purchase_order_wh_orderer')->insert(array (
            0 =>
            array (
                'wh_orderer_id' => 1,
                'pch_purchase_order_id' => 1,
            ),
            1 =>
            array (
                'wh_orderer_id' => 2,
                'pch_purchase_order_id' => 2,
            ),
            2 =>
            array (
                'wh_orderer_id' => 3,
                'pch_purchase_order_id' => 3,
            ),
            3 =>
            array (
                'wh_orderer_id' => 4,
                'pch_purchase_order_id' => 4,
            ),
            4 =>
            array (
                'wh_orderer_id' => 5,
                'pch_purchase_order_id' => 5,
            ),
        ));

    }
}
