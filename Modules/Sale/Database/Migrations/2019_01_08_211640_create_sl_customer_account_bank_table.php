<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlCustomerAccountBankTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_customer_account_bank', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_customer_id')->index('sl_customer_sl_customer_account_bank_fk');
			$table->integer('g_bank_id')->index('sl_customer_account_bank_g_bank_fk');
			$table->integer('g_type_account_bank_id')->index('sl_customer_account_bank_g_type_account_bank_fk');
			$table->string('number', 20);
			$table->string('rut', 10);
			$table->string('email', 100);
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
		Schema::drop('sl_customer_account_bank');
	}

}
