<?php

namespace Modules\Sale\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SlPriceListPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sl_price_list_pos')->delete();

        \DB::table('sl_price_list_pos')->insert(array (
            // COCA-COLA
            0 =>
            array (
                
                'wh_product_id' => 1,
                'sale_price' => 1000,
            ),
            1 =>
            array (
                
                'wh_product_id' => 2,
                'sale_price' => 200,
            ),
            2 =>
            array (
                
                'wh_product_id' => 3,
                'sale_price' => 1200,
            ),
            // BALTILOCA
            3 =>
            array (
                
                'wh_product_id' => 4,
                'sale_price' => 400,
            ),
            // PACK BALTILOCAS
            4 =>
            array (
                
                'wh_product_id' => 5,
                'sale_price' => 2200,
            ),
            // PAPAS KRYSPO
            5 =>
            array (
                
                'wh_product_id' => 6,
                'sale_price' => 1000,
            ),
            // PROMO DE BALTILOCAS + PAPAS KRYSPO
            5 =>
            array (
                
                'wh_product_id' => 7,
                'sale_price' => 3000,
            ),
            
            // PACK PAPAS KRYSPO
            7 =>
            array (
                
                'wh_product_id' => 8,
                'sale_price' => 1900,
            ),
            
            // HARINA 1KG
            8 =>
            array (
                
                'wh_product_id' => 9,
                'sale_price' => 900,
            ),

            // AVENA 1KG
            9 =>
            array (
                
                'wh_product_id' => 10,
                'sale_price' => 1200,
            ),

            // PROMO HARINA 1KG + AVENA 1KG
            10 =>
            array (
                
                'wh_product_id' => 11,
                'sale_price' => 2090,
            ),

            // HYPER PROMO BALTILOCA + PAPAS KRYSPO
            11 =>
            array (
                
                'wh_product_id' => 12,
                'sale_price' => 17500,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('sl_price_list_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);

    }
}
