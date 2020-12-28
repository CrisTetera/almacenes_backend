<?php

namespace Modules\Warehouse\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class WhProductPosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('wh_product_pos')->delete();

        /**
         * 12 productos,
         * 
         */

        $productArray = array();
        $productLength = 12;
        // Test Product 1.
        $id = 1;
        array_push($productArray, array(
            'wh_item_id' => $id ,
            'wh_pack_id' => null,
            'wh_promo_id' => null,
            'wh_subfamily_id' => 1,
            'upc' => $faker->ean8,
            'name' => 'Bebida Coca Cola Retornable 2 LT',
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => $faker->boolean,
            'is_tax_free' => false,
            // => true,
            // => true,
            // => $faker->boolean(20),
            'flag_delete' => false,
        ));
        // Test Product 2.
        $id = 2;
        array_push($productArray, array(
            'wh_item_id' => $id,
            'wh_pack_id' => null,
            'wh_promo_id' => null,
            'wh_subfamily_id' => 1,
            'upc' => $faker->ean8,
            'name' => 'Some Product',
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => $faker->boolean,
            'is_tax_free' => false,
            // => true,
            // => true,
            // => $faker->boolean(20),
            'flag_delete' => false,
        ));
        // Test Product 3.
        $id = 3;
        array_push($productArray, array(
            'wh_item_id' => $id ,
            'wh_pack_id' => null,
            'wh_promo_id' => null,
            'wh_subfamily_id' => 1,
            'upc' => "002001MANJ001",
            'name' => $faker->sentence(2),
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => $faker->boolean,
            'is_tax_free' => false,
            // => false,
            // => $faker->boolean(20),
            'flag_delete' => false,
        ));
        // Test Product 4. => Baltiloca
        $id = 4;
        array_push($productArray, array(
            'wh_item_id' => $id,
            'wh_pack_id' => null,
            'wh_promo_id' => null,
            'wh_subfamily_id' => 1,
            'upc' => "002001MANJ002",
            'name' => 'Baltiloca',
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => $faker->boolean,
            'is_tax_free' => false,
            // => true,
            // => true,
            // => $faker->boolean(20),
            'flag_delete' => false,
        ));
        // Test Product 5. => Pack de Baltilocas
        $id = 5;
        array_push($productArray, array(
            'wh_item_id' => null,
            'wh_pack_id' => 1,
            'wh_promo_id' => null,
            'wh_subfamily_id' => 1,
            'upc' => $faker->ean8,
            'name' => 'Pack de Baltilocas',
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => $faker->boolean,
            'is_tax_free' => false,
            // => true,
            // => true,
            // => $faker->boolean(20),
            'flag_delete' => false,
        ));
        // Test Product 6. => Papas Kryspo
        $id = 6;
        array_push($productArray, array(
            'wh_item_id' => 5,
            'wh_pack_id' => null,
            'wh_promo_id' => null,
            'wh_subfamily_id' => 2,
            'upc' => $faker->ean8,
            'name' => 'Papitas Kryspo',
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => false,
            'is_tax_free' => false,
            // => true,
            // => true,
            // => false,
            'flag_delete' => false,
        ));
        // Test Product 6. => Promo de Baltiloca + Papas Kryspo
        $id = 7;
        array_push($productArray, array(
            'wh_item_id' => null,
            'wh_pack_id' => null,
            'wh_promo_id' => 1,
            'wh_subfamily_id' => 2,
            'upc' => $faker->ean8,
            'name' => 'Promo Baltiloca + Papas Kryspo',
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => $faker->boolean,
            'is_tax_free' => false,
            // => true,
            // => true,
            // => $faker->boolean(20),
            'flag_delete' => false,
        ));
        // Test Product 7. => Pack Papas Kryspo
        $id = 8;
        array_push($productArray, array(
            'wh_item_id' => null,
            'wh_pack_id' => 2,
            'wh_promo_id' => null,
            'wh_subfamily_id' => 2,
            'upc' => $faker->ean8,
            'name' => 'Pack Papas Kryspo',
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => $faker->boolean,
            'is_tax_free' => false,
            // => true,
            // => false,
            // => $faker->boolean(20),
            'flag_delete' => false,
        ));
        
        // HARINA 1 KG
        $id = 9;
        array_push($productArray, array(
            'wh_item_id' => 6,
            'wh_pack_id' => null,
            'wh_promo_id' => null,
            'wh_subfamily_id' => 2,
            'upc' => $faker->ean8,
            'name' => 'Harina 1Kg',
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => false,
            'is_tax_free' => false,
            // => true,
            // => true,
            // => false,
            'flag_delete' => false,
        ));
        // (10) Test Generate Internal Consumption
        $id = 10;
        array_push($productArray, array(
            'wh_item_id' => 7,
            'wh_pack_id' => null,
            // null,
            'wh_promo_id' => null,
            'wh_subfamily_id' => 2,
            'upc' => $faker->ean8,
            'name' => 'Avena 1Kg',
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => false,
            'is_tax_free' => false,
            // => true,
            // => true,
            // => false,
            'flag_delete' => false,
        ));
        // (11) Promo Harina 1kg + Avena 1kg
        $id = 11;
        array_push($productArray, array(
            'wh_item_id' => null,
            'wh_pack_id' => null,
            // null,
            'wh_promo_id' => 2,
            'wh_subfamily_id' => 2,
            'upc' => $faker->ean8,
            'name' => 'PROMO HARINA + AVENA',
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => false,
            'is_tax_free' => false,
            // => true,
            // => true,
            // => false,
            'flag_delete' => false,
        ));

        // (12) Test Product, Hyper Promo Baltilocas + Papas Kryspo
        $id = 12;
        array_push($productArray, array(
            'wh_item_id' => null,
            'wh_pack_id' => null,
            'wh_promo_id' => 3,
            'wh_subfamily_id' => 4,
            'upc' => $faker->ean8,
            'name' => 'HYPER PROMO BALTILOCA + PAPAS KRYSPO',
            // => $faker->sentence(3),
            'description' => $faker->sentence(8),
            'path_logo' => '/path/logo.png', 'cost_price' => 100,  'gains_margin' => 10,
            // => $faker->randomElement(array(0, 365, 730)),
            // => false,
            'is_tax_free' => false,
            // => true,
            // => true,
            // => false,
            'flag_delete' => false,
        ));

        \DB::table('wh_product_pos')->insert($productArray);

        $now = \Carbon\Carbon::now();
        \DB::table('wh_product_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
