<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlCheckTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_check', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_bank_id')->index('sl_check_g_bank_fk');
			$table->integer('sl_customer_id')->index('sl_check_sl_customer_fk');
			$table->string('number', 20);
			$table->decimal('amount', 10);
			$table->string('place', 500);
			$table->date('date');
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
		Schema::drop('sl_check');
	}

}
