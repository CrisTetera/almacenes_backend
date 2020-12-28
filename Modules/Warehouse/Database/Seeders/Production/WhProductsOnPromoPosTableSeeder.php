<?php

namespace Modules\Warehouse\Database\Seeders\Production;

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
            
        ));

    }
}
