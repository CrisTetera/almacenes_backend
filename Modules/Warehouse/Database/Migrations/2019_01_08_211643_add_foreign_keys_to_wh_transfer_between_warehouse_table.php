<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhTransferBetweenWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_transfer_between_warehouse', function(Blueprint $table)
		{
			$table->foreign('wh_from_warehouse_id', 'fk_wh_transfer_between_warehouse_wh_warehouse_destination')->references('id')->on('wh_warehouse')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_to_supervisor_id', 'fk_wh_transfer_between_warehouse_g_to_supervisor_id')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_to_warehouse_id', 'fk_wh_transfer_between_warehouse_wh_to_warehouse_id')->references('id')->on('wh_warehouse')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_from_supervisor_id', 'fk_wh_transfer_between_warehouse_g_from_supervisor_id')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_transfer_between_warehouse_state_id', 'fk_wh_transfer_between_warehouse_wh_transfer_between_warehouse_state_id')->references('id')->on('wh_transfer_between_warehouse_state')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_transfer_between_warehouse', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_transfer_between_warehouse_wh_warehouse_destination');
			$table->dropForeign('fk_wh_transfer_between_warehouse_g_to_supervisor_id');
			$table->dropForeign('fk_wh_transfer_between_warehouse_wh_to_warehouse_id');
			$table->dropForeign('fk_wh_transfer_between_warehouse_g_from_supervisor_id');
			$table->dropForeign('fk_wh_transfer_between_warehouse_wh_transfer_between_warehouse_state_id');
		});
	}

}
