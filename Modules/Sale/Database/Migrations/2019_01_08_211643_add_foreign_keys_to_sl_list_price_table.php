<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlListPriceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_list_price', function(Blueprint $table)
		{
			$table->foreign('g_branch_office_id', 'fk_sl_list_price_g_branch_office')->references('id')->on('g_branch_office')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_list_price', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_list_price_g_branch_office');
		});
	}

}
