<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlPriceListPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_price_list_pos', function (Blueprint $table) {
            $table->foreign('wh_product_id' , 'sl_price_list_pos_children_wh_product_pos_fk')->references('id')->on('wh_product_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_price_list_pos', function (Blueprint $table) {
            $table->dropForeign('sl_price_list_pos_children_wh_product_pos_fk');
        });
    }
}
