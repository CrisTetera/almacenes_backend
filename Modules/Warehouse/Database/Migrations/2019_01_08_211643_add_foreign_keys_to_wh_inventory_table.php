<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhInventoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_inventory', function(Blueprint $table)
		{
			$table->foreign('g_user_id', 'fk_wh_inventory_g_user_create')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_user_id2', 'fk_wh_inventory_g_user_cronfirm')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_warehouse_id', 'fk_wh_inventory_wh_warehouse')->references('id')->on('wh_warehouse')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_state_id', 'fk_wh_inventory_g_state')->references('id')->on('g_state')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_stock_adjust_id', 'fk_wh_stock_adjust_wh_inventory2')->references('id')->on('wh_stock_adjust')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_inventory', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_inventory_g_user_create');
			$table->dropForeign('fk_wh_inventory_g_user_cronfirm');
			$table->dropForeign('fk_wh_inventory_wh_warehouse');
			$table->dropForeign('fk_wh_inventory_g_state');
			$table->dropForeign('fk_wh_stock_adjust_wh_inventory2');
		});
	}

}
