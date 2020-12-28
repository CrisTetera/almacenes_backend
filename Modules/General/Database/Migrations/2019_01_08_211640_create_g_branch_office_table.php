<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGBranchOfficeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('g_branch_office', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_company_id')->index('g_branch_office_g_company_fk');
			$table->integer('g_commune_id')->index('g_branch_office_g_commune_fk');
			$table->string('name', 100);
			$table->string('address', 500);
			$table->string('phone', 500);
			$table->string('email', 500);
			$table->string('sii_barnch_office_sii', 20)->default('81303347');
			$table->boolean('flag_delete')->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('g_branch_office');
	}

}
