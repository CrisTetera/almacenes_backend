<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGStateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('g_state', function(Blueprint $table)
		{
			$table->foreign('g_state_type_id', 'fk_g_state_g_state_type')->references('id')->on('g_state_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('g_state', function(Blueprint $table)
		{
			$table->dropForeign('fk_g_state_g_state_type');
		});
	}

}
