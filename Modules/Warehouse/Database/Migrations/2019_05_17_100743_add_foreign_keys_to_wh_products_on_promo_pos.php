<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToWhProductsOnPromoPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_products_on_promo_pos', function (Blueprint $table) {
            $table->foreign('wh_product_id', 'wh_products_on_promo_pos_children_wh_product_pos_fk')->references('id')->on('wh_product_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_promo_id', 'wh_products_on_promo_pos_children_wh_promo_pos_fk')->references('id')->on('wh_promo_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_products_on_promo_pos', function (Blueprint $table) {
            $table->dropForeign('wh_products_on_promo_pos_children_wh_product_pos_fk');
            $table->dropForeign('wh_products_on_promo_pos_children_wh_promo_pos_fk');
        });
    }
}
