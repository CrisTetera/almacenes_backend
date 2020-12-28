<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlCustomerChargeSheetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_customer_charge_sheet', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('amount', 10);
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
		Schema::drop('sl_customer_charge_sheet');
	}

}
