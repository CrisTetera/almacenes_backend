<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhDispatchOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_dispatch_order', function(Blueprint $table)
		{
			$table->foreign('g_state_id', 'fk_wh_dispatch_order_g_state')->references('id')->on('g_state')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_user_id', 'fk_wh_dispatch_order_g_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_dispatch_order', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_dispatch_order_g_state');
			$table->dropForeign('fk_wh_dispatch_order_g_user');
		});
	}

}
