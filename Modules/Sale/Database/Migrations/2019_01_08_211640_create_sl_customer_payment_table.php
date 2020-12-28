<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlCustomerPaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_customer_payment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_customer_account_movement_id')->index('sl_customer_account_movement_sl_customer_payment2_fk');
			$table->integer('sl_detail_customer_charge_sheet_id')->index('sl_customer_payment_sl_detail_customer_change_sheet_fk');
			$table->integer('sl_electronic_transfer_payment_id')->index('sl_customer_payment_sl_electronic_transer_payment_fk');
			$table->decimal('amount', 10);
			$table->date('pay_date');
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
		Schema::drop('sl_customer_payment');
	}

}
