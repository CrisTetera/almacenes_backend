<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlCustomerAccountMovementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_customer_account_movement', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_customer_account_id')->index('sl_customer_account_sl_customer_account_movement_fk');
			$table->integer('sl_type_customer_account_movement_id')->index('sl_cstmer_accnt_movement_sl_type_customer_account_movement_fk');
			$table->integer('sl_customer_payment_id')->nullable()->index('sl_customer_account_movement_sl_customer_payment_fk');
			$table->integer('sl_sale_invoice_id')->nullable()->index('sl_customer_account_movement_sl_sale_invoice_fk');
			$table->integer('sl_sale_credit_note_id')->nullable()->index('sl_customer_account_movement_sl_sale_credit_note_fk');
			$table->integer('sl_sale_debit_note_id')->nullable()->index('sl_customer_account_movement_sl_sale_debit_note_fk');
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
		Schema::drop('sl_customer_account_movement');
	}

}
