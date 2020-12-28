<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlSchemeDiscountPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_scheme_discount_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_product_id')->index('sl_scheme_discount_pos_children_wh_product_pos_fk');
            $table->integer('quantity_discount');
            $table->integer('unit_price_discount');
            $table->integer('percentage_discount');
            $table->boolean('flag_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sl_scheme_discount_pos');
    }
}
