<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlDetailCustomerChargeSheetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_detail_customer_charge_sheet', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_customer_charge_sheet_id')->index('sl_customer_charge_sheet_sl_detail_customer_charge_sheet_fk');
			$table->integer('sl_customer_account_id')->index('sl_customer_account_sl_detail_customer_change_sheet_fk');
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
		Schema::drop('sl_detail_customer_charge_sheet');
	}

}
