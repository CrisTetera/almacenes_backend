<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::table('g_menu', function(Blueprint $table)
		{
			$table->foreign('g_module_id', 'fk_g_menu_g_module')->references('id')->on('g_module')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('g_menu', function(Blueprint $table)
		{
			$table->dropForeign('fk_g_menu_g_module');
		});
	}
}
