<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlWholesaleDiscountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_wholesale_discount', function(Blueprint $table)
		{
			$table->foreign('g_branch_office_id', 'fk_sl_wholesale_discount_g_branch_office')->references('id')->on('g_branch_office')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_sl_wholesale_discount_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_wholesale_discount', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_wholesale_discount_g_branch_office');
			$table->dropForeign('fk_sl_wholesale_discount_wh_product');
		});
	}

}
