<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlCheckTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_check', function(Blueprint $table)
		{
			$table->foreign('g_bank_id', 'fk_sl_check_g_bank')->references('id')->on('g_bank')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_id', 'fk_sl_check_sl_customer')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_check', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_check_g_bank');
			$table->dropForeign('fk_sl_check_sl_customer');
		});
	}

}
