<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosDailyCashTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_daily_cash', function(Blueprint $table)
		{
			$table->foreign('g_state_id', 'fk_post_daily_cash_g_state')->references('id')->on('g_state')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_cashier_opening_user_id', 'fk_pos_daily_cash_cashier_opening_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_cashier_closure_user_id', 'fk_pos_daily_cash_cashier_closure_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_cash_desk_id', 'fk_pos_daily_cash_pos_cash_desk')->references('id')->on('pos_cash_desk')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_cash_supervisor_user_id', 'fk_pos_daily_cash_supervisor_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_daily_cash', function(Blueprint $table)
		{
			$table->dropForeign('fk_post_daily_cash_g_state');
			$table->dropForeign('fk_pos_daily_cash_cashier_opening_user');
			$table->dropForeign('fk_pos_daily_cash_cashier_closure_user');
			$table->dropForeign('fk_pos_daily_cash_pos_cash_desk');
			$table->dropForeign('fk_pos_daily_cash_supervisor_user');
		});
	}

}
