<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhStockMovementPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_stock_movement_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_warehouse_id')->index('wh_stock_movement_pos_wh_warehouse_pos_fk');
			$table->integer('wh_item_id')->index('wh_stock_movement_pos_wh_item_pos_fk');
			$table->integer('wh_product_id')->index('wh_stock_movement_pos_wh_product_pos_fk');
			$table->decimal('quantity', 10, 2);
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
        Schema::dropIfExists('wh_stock_movement_pos');
    }
}
