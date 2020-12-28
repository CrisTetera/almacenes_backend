<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhInventoryPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_inventory_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_stock_adjust_id')->index('wh_inventory_pos_children_pos_wh_stock_adjust_pos_fk');
            $table->integer('g_user_id')->index('wh_inventory_pos_children_g_user_pos_fk');
            $table->integer('wh_warehouse_id')->index('wh_inventory_pos_children_wh_warehouse_pos_fk');
            $table->integer('g_user_id2')->index('wh_inventory_pos_children_g_user2_pos_fk');
            $table->integer('g_state_id')->index('wh_inventory_pos_children_g_state_pos_fk');
            $table->string('description',50);
            $table->date('inventory_date');
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
        Schema::dropIfExists('wh_inventory_pos');
    }
}
