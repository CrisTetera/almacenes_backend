<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_warehouse', function(Blueprint $table)
		{
			$table->foreign('g_branch_office_id', 'fk_wh_warehouse_g_branch_office')->references('id')->on('g_branch_office')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_warehouse_type_id', 'fk_wh_warehouse_wh_warehouse_type')->references('id')->on('wh_warehouse_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_warehouse', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_warehouse_g_branch_office');
			$table->dropForeign('fk_wh_warehouse_wh_warehouse_type');
		});
	}

}
