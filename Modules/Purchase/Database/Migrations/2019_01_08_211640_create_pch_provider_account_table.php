<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchProviderAccountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_provider_account', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_provider_id')->nullable()->index('pch_provider_pch_provider_account2_fk');
			$table->decimal('debt_to_pay', 10);
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
		Schema::drop('pch_provider_account');
	}

}
