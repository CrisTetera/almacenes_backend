<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhDetailStockAdjustPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_detail_stock_adjust_pos', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('wh_stock_adjust_id')->index('wh_detail_stock_adjust_pos_children_wh_stock_adjust_pos_fk');
			$table->integer('wh_item_id')->index('wh_detail_stock_adjust_children_wh_item_pos_fk');
			$table->decimal('quantity_adjust', 10);
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
        Schema::dropIfExists('wh_detail_stock_adjust_pos');
    }
}
