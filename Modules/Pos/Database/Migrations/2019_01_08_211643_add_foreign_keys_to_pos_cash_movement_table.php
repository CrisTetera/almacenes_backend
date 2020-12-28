<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosCashMovementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_cash_movement', function(Blueprint $table)
		{
			$table->foreign('pos_cash_desk_id', 'fk_pos_cash_movement_g_cash_desk')->references('id')->on('pos_cash_desk')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_user_id', 'fk_pos_cash_movement_g_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_cash_movement_egress_type_id', 'fk_pos_cash_movement_pos_cash_movement_egress_type')->references('id')->on('pos_cash_movement_egress_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_cash_movement_ingress_type_id', 'fk_pos_cash_movement_pos_cash_movement_ingress_type')->references('id')->on('pos_cash_movement_ingress_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_cash_movement', function(Blueprint $table)
		{
			$table->dropForeign('fk_pos_cash_movement_g_cash_desk');
			$table->dropForeign('fk_pos_cash_movement_g_user');
			$table->dropForeign('fk_pos_cash_movement_pos_cash_movement_egress_type');
			$table->dropForeign('fk_pos_cash_movement_pos_cash_movement_ingress_type');
		});
	}

}
