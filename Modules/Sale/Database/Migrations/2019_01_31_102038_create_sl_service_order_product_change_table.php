<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlServiceOrderProductChangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_service_order_product_change', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sl_service_order_id')->index('sl_service_order_pruduct_change_sl_service_order_fk');
            $table->integer('wh_product_id')->index('sl_service_order_pruduct_change_wh_product_fk');
            $table->integer('quantity');
            $table->string('movement_type', 3);
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
        Schema::dropIfExists('sl_service_order_product_change');
    }
}
