<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhStockMovementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_stock_movement', function(Blueprint $table)
		{
			$table->foreign('wh_item_id', 'fk_wh_stock_movement_wh_item')->references('id')->on('wh_item')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_wh_stock_movement_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_warehouse_id', 'fk_wh_stock_movement_wh_warehouse')->references('id')->on('wh_warehouse')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_warehouse_movement_id', 'fk_wh_stock_movement_wh_warehouse_movement')->references('id')->on('wh_warehouse_movement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_stock_movement', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_stock_movement_wh_item');
			$table->dropForeign('fk_wh_stock_movement_wh_product');
			$table->dropForeign('fk_wh_stock_movement_wh_warehouse');
			$table->dropForeign('fk_wh_stock_movement_wh_warehouse_movement');
		});
	}

}
