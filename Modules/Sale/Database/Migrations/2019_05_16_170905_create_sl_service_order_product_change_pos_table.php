<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlServiceOrderProductChangePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_service_order_product_change_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sl_service_order_id')->index('sl_service_order_product_change_pos_children_sl_service_order_pos_fk');
            $table->integer('wh_product_id')->index('sl_service_order_product_change_pos_children_wh_product_pos_fk');
            $table->integer('quantity');
            $table->string('movement_type',50);
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
        Schema::dropIfExists('sl_service_order_product_change_pos');
    }
}
