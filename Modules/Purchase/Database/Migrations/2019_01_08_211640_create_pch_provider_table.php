<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchProviderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_provider', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_provider_account_id')->nullable()->index('pch_provider_pch_provider_account_fk');
			$table->string('rut', 10);
			$table->string('business_name');
			$table->string('alias_name');
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
		Schema::drop('pch_provider');
	}

}
