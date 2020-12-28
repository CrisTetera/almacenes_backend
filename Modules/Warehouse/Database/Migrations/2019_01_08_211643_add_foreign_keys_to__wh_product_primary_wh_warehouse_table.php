<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhProductPrimaryWhWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_product_primary_wh_warehouse', function(Blueprint $table)
		{
			$table->foreign('wh_product_id', 'wh_product_primary_wh_product_fk')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_warehouse_id', 'wh_product_primary_wh_warehouse_fk')->references('id')->on('wh_warehouse')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_branch_office_id', 'wh_product_primary_g_branch_office')->references('id')->on('g_branch_office')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_product_primary_wh_warehouse', function(Blueprint $table)
		{
			$table->dropForeign('wh_product_primary_wh_product_fk');
			$table->dropForeign('wh_product_primary_wh_warehouse_fk');
			$table->dropForeign('wh_product_primary_g_branch_office');
		});
	}

}
