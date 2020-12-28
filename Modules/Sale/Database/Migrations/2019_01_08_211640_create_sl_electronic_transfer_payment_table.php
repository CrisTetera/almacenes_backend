<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlElectronicTransferPaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_electronic_transfer_payment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_customer_account_bank_id')->index('sl_customer_account_bank_sl_electronic_transfer_payment_fk');
			$table->integer('sl_customer_payment_id')->index('sl_customer_payment_sl_electronic_transer_payment2_fk');
			$table->string('number', 20);
			$table->decimal('amount', 10);
			$table->date('transfer_date');
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
		Schema::drop('sl_electronic_transfer_payment');
	}

}
