<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('g_company', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('rut');
			$table->string('business_name');
			$table->string('state', 100);
			$table->string('commercial_business', 500);
			$table->integer('commercial_activity_code');
			$table->string('address', 500);
			$table->integer('commune_id')->index('g_company_g_commune_fk');
			$table->string('api_key_open_factura', 500)->default('928e15a2d14d4a6292345f04960f4bd3');
			$table->string('path_icon', 1000)->nullable();
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
		Schema::drop('g_company');
	}

}
