<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('g_company', function(Blueprint $table)
		{
			$table->foreign('commune_id', 'g_company_g_commune_fk')->references('id')->on('g_commune')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('g_company', function(Blueprint $table)
		{
			$table->dropForeign('g_company_g_commune_fk');
		});
	}

}