<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGBranchOfficeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('g_branch_office', function(Blueprint $table)
		{
			$table->foreign('g_company_id', 'fk_g_branch_office_g_company')->references('id')->on('g_company')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_commune_id', 'fk_g_branch_office_g_commune')->references('id')->on('g_commune')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('g_branch_office', function(Blueprint $table)
		{
			$table->dropForeign('fk_g_branch_office_g_company');
			$table->dropForeign('fk_g_branch_office_g_commune');
		});
	}

}
