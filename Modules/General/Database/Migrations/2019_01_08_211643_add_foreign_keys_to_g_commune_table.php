<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGCommuneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('g_commune', function(Blueprint $table)
		{
			$table->foreign('g_province_id', 'fk_g_commune_g_province')->references('id')->on('g_province')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('g_commune', function(Blueprint $table)
		{
			$table->dropForeign('fk_g_commune_g_province');
		});
	}

}
