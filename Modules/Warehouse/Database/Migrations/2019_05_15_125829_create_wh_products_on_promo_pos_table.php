<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhProductsOnPromoPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_products_on_promo_pos', function (Blueprint $table) 
        {
            $table->integer('wh_product_id')->index('wh_products_on_promo_pos_children_wh_product_pos_fk');
			$table->integer('wh_promo_id')->index('wh_products_on_promo_pos_children_wh_promo_pos_fk');
			$table->integer('quantity')->default(1);
			$table->unique(['wh_product_id','wh_promo_id'], 'wh_products_on_promo_pos_pk');
			$table->primary(['wh_product_id','wh_promo_id'], 'pk_wh_products_on_promo_pos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wh_products_on_promo_pos');
    }
}
