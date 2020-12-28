<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhStockAdjustTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_stock_adjust', function(Blueprint $table)
		{
			$table->foreign('g_user_id', 'fk_wh_stock_adjust_g_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_inventory_id', 'fk_wh_stock_adjust_wh_inventory')->references('id')->on('wh_inventory')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_warehouse_id', 'fk_wh_warehouse_wh_stock_adjust')->references('id')->on('wh_warehouse')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_stock_adjust_type_id', 'fk_wh_stock_adjust_type_wh_stock_adjust')->references('id')->on('wh_stock_adjust_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_stock_adjust', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_stock_adjust_g_user');
			$table->dropForeign('fk_wh_stock_adjust_wh_inventory');
			$table->dropForeign('fk_wh_warehouse_wh_stock_adjust');
			$table->dropForeign('fk_wh_stock_adjust_type_wh_stock_adjust');
		});
	}

}
