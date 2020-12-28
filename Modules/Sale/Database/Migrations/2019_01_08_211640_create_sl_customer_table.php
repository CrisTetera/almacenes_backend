<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlCustomerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_customer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_customer_account_id')->nullable()->index('sl_customer_sl_customer_account_fk');
			$table->string('rut', 10);
			$table->string('business_name');
			$table->string('alias_name');
			$table->string('core_business', 500);
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
		Schema::drop('sl_customer');
	}

}
