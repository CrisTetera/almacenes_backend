<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;

class PchDetailPurchaseOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pch_detail_purchase_order')->delete();

        \DB::table('pch_detail_purchase_order')->insert(array (
            0 =>
            array (
                'pch_purchase_order_id' => 1,
                'provider_product_code' => 'KRYS',
                'wh_product_id' => 8,
                'quantity' => 4,
                'net_price' => 500.20,
                'net_total' => 2001,
                'flag_delete' => false,
            ),
            1 =>
            array (
                'pch_purchase_order_id' => 1,
                'provider_product_code' => 'PACKBALTI',
                'wh_product_id' => 5,
                'quantity' => 5,
                'net_price' => 720.50,
                'net_total' => 3603,
                'flag_delete' => false,
            ),
            2 =>
            array (
                'pch_purchase_order_id' => 2,
                'provider_product_code' => 'KRYS',
                'wh_product_id' => 8,
                'quantity' => 4,
                'net_price' => 500.20,
                'net_total' => 2001,
                'flag_delete' => false,
            ),
            3 =>
            array (
                'pch_purchase_order_id' => 2,
                'provider_product_code' => 'PACKBALTI',
                'wh_product_id' => 5,
                'quantity' => 5,
                'net_price' => 720.50,
                'net_total' => 3603,
                'flag_delete' => false,
            ),
            4 =>
            array (
                'pch_purchase_order_id' => 3,
                'provider_product_code' => 'KRYS',
                'wh_product_id' => 8,
                'quantity' => 4,
                'net_price' => 500.20,
                'net_total' => 2001,
                'flag_delete' => false,
            ),
            5 =>
            array (
                'pch_purchase_order_id' => 3,
                'provider_product_code' => 'PACKBALTI',
                'wh_product_id' => 5,
                'quantity' => 5,
                'net_price' => 720.50,
                'net_total' => 3603,
                'flag_delete' => false,
            ),
            6 =>
            array (
                'pch_purchase_order_id' => 4,
                'provider_product_code' => 'KRYS',
                'wh_product_id' => 8,
                'quantity' => 4,
                'net_price' => 500.20,
                'net_total' => 2001,
                'flag_delete' => false,
            ),
            7 =>
            array (
                'pch_purchase_order_id' => 4,
                'provider_product_code' => 'PACKBALTI',
                'wh_product_id' => 5,
                'quantity' => 5,
                'net_price' => 720.50,
                'net_total' => 3603,
                'flag_delete' => false,
            ),
            8 =>
            array (
                'pch_purchase_order_id' => 5,
                'provider_product_code' => 'KRYS',
                'wh_product_id' => 8,
                'quantity' => 4,
                'net_price' => 500.20,
                'net_total' => 2001,
                'flag_delete' => false,
            ),
            9 =>
            array (
                'pch_purchase_order_id' => 5,
                'provider_product_code' => 'PACKBALTI',
                'wh_product_id' => 5,
                'quantity' => 5,
                'net_price' => 720.50,
                'net_total' => 3603,
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_detail_purchase_order')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
