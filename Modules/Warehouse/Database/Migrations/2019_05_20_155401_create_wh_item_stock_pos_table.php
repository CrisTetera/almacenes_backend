<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhItemStockPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_item_stock_pos', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('wh_warehouse_id')->index('wh_item_stock_children_wh_warehouse_pos_fk');
			$table->integer('wh_item_id')->index('wh_item_stock_children_wh_item_pos_fk');
			$table->decimal('stock', 10)->nullable();
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
        Schema::dropIfExists('wh_item_stock_pos');
    }
}
