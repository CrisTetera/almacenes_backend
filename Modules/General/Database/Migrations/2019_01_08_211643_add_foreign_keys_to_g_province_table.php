<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGProvinceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('g_province', function(Blueprint $table)
		{
			$table->foreign('g_region_id', 'fk_g_province_g_region')->references('id')->on('g_region')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('g_province', function(Blueprint $table)
		{
			$table->dropForeign('fk_g_province_g_region');
		});
	}

}
