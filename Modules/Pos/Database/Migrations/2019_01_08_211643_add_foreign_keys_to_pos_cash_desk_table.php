<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosCashDeskTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_cash_desk', function(Blueprint $table)
		{
			$table->foreign('g_branch_office_id', 'fk_pos_cash_desk_g_branch_office')->references('id')->on('g_branch_office')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_cash_desk', function(Blueprint $table)
		{
			$table->dropForeign('fk_pos_cash_desk_g_branch_office');
		});
	}

}
