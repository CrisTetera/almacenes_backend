<?php

namespace Modules\Warehouse\Database\Seeders\local;

use Illuminate\Database\Seeder;

class WhProductsOnPromoPosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('wh_products_on_promo_pos')->delete();

        \DB::table('wh_products_on_promo_pos')->insert(array (
            // PROMO BALTILOCA + PAPAS KRYSPO
            0 =>
            array (
                'wh_product_id' => 5, // PACK BALTILOCAS
                'wh_promo_id' => 1,
                'quantity' => 1
            ),
            1 =>
            array (
                'wh_product_id' => 6, // PAPAS KRYSPO
                'wh_promo_id' => 1,
                'quantity' => 1
            ),
            // --------------------
            // HYPER PROMO BALTILOCA + PAPAS KRYSPO
            2 =>
            array (
                'wh_product_id' => 9, // HARINA 1 KG
                'wh_promo_id' => 2,
                'quantity' => 1
            ),
            3 =>
            array (
                'wh_product_id' => 10, // AVENA 1 KG
                'wh_promo_id' => 2,
                'quantity' => 1
            ),// --------------------
            // HYPER PROMO BALTILOCA + PAPAS KRYSPO
            4 =>
            array (
                'wh_product_id' => 5, // PACK BALTILOCAS
                'wh_promo_id' => 3,
                'quantity' => 5
            ),
            5 =>
            array (
                'wh_product_id' => 6, // PAPAS KRYSPO
                'wh_promo_id' => 3,
                'quantity' => 8
            ),
        ));

    }
}
