<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhStockAdjustPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_stock_adjust_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_inventory_id')->index('wh_stock_adjust_pos_children_pos_wh_inventory_pos_fk');
            $table->integer('g_user_id')->index('wh_stock_adjust_pos_children_pos_g_user_pos_fk');
            $table->integer('wh_warehouse_id')->index('wh_stock_adjust_pos_children_pos_wh_warehouse_pos_fk');
            $table->integer('wh_stock_adjust_type_id')->index('wh_stock_adjust_pos_children_pos_wh_stock_adjust_type_pos_fk');
            $table->string('description',50);
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
        Schema::dropIfExists('wh_stock_adjust_pos');
    }
}
