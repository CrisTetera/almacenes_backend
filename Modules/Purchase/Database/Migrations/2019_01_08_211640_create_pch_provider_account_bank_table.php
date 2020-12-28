<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchProviderAccountBankTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_provider_account_bank', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_provider_id')->index('pch_provider_pch_provider_account_bank_fk');
			$table->integer('g_bank_id')->index('pch_provider_account_bank_g_bank_fk');
			$table->integer('g_type_account_bank_id')->index('pch_provider_account_bank_g_type_account_bank_fk');
			$table->string('account_number', 30);
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
		Schema::drop('pch_provider_account_bank');
	}

}
