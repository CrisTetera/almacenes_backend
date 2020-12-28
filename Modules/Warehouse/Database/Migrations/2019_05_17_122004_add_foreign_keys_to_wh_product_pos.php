<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToWhProductPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_product_pos', function (Blueprint $table) {
            $table->foreign('wh_item_id' , 'wh_product_pos_children_wh_item_pos_fk')->references('id')->on('wh_item_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_promo_id' , 'wh_product_pos_children_wh_promo_pos_fk')->references('id')->on('wh_promo_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_pack_id' , 'wh_product_pos_children_wh_pack_pos_fk')->references('id')->on('wh_pack_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_subfamily_id' , 'wh_product_pos_children_wh_subfamily_pos_fk')->references('id')->on('wh_subfamily_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_product_pos', function (Blueprint $table) {
            $table->dropForeign('wh_product_pos_children_wh_item_pos_fk');
            $table->dropForeign('wh_product_pos_children_wh_promo_pos_fk');
            $table->dropForeign('wh_product_pos_children_wh_pack_pos_fk');
            $table->dropForeign('wh_product_pos_children_wh_subfamily_pos_fk');
        });
    }
}
