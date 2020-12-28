<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlPriceListPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_price_list_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_product_id')->index('sl_price_list_pos_children_wh_product_pos_fk');
            $table->decimal('sale_price',10);
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
        Schema::dropIfExists('sl_price_list_pos');
    }
}
