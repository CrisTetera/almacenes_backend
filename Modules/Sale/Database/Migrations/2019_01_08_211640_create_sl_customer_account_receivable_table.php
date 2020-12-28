<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlCustomerAccountReceivableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_customer_account_receivable', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_customer_account_id')->index('sl_customer_account_sl_customer_account_receivable_fk');
			$table->integer('sl_sale_invoice_id')->index('sl_sale_invoice_sl_customer_account_receivable_fk');
			$table->decimal('amount', 10);
			$table->date('pay_date');
			$table->date('real_pay_date')->nullable();
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
		Schema::drop('sl_customer_account_receivable');
	}

}
