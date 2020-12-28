<?php

namespace Modules\Warehouse\Database\Seeders\local;

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
            0 => 
            array (
                'wh_product_id' => 1,
                'wh_tag_id' => 1,
            ),
            1 => 
            array (
                'wh_product_id' => 3,
                'wh_tag_id' => 2,
            ),
            2 => 
            array (
                'wh_product_id' => 5,
                'wh_tag_id' => 3,
            ),
            3 => 
            array (
                'wh_product_id' => 7,
                'wh_tag_id' => 4,
            ),
            4 => 
            array (
                'wh_product_id' => 9,
                'wh_tag_id' => 5,
            ),
            5 => 
            array (
                'wh_product_id' => 11,
                'wh_tag_id' => 6,
            ),
            6 => 
            array (
                'wh_product_id' => 13,
                'wh_tag_id' => 7,
            ),
            7 => 
            array (
                'wh_product_id' => 1,
                'wh_tag_id' => 2,
            ),
            8 => 
            array (
                'wh_product_id' => 1,
                'wh_tag_id' => 3,
            ),
            9 => 
            array (
                'wh_product_id' => 1,
                'wh_tag_id' => 4,
            ),
            10 => 
            array (
                'wh_product_id' => 1,
                'wh_tag_id' => 5,
            ),
        ));        
        
    }
}