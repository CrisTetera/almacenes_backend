<?php

namespace Modules\Warehouse\Database\Seeders\Production;

use Illuminate\Database\Seeder;

class WhTagWhProductPosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('wh_tag_wh_product_pos')->delete();
        
        \DB::table('wh_tag_wh_product_pos')->insert(array (
            
        ));        
        
    }
}