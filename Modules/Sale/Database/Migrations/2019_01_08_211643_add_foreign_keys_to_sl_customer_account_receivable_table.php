<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlCustomerAccountReceivableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_customer_account_receivable', function(Blueprint $table)
		{
			$table->foreign('sl_customer_account_id', 'fk_sl_customer_account_sl_customer_account_receivable')->references('id')->on('sl_customer_account')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_invoice_id', 'fk_sl_sale_invoice_sl_customer_account_receivable')->references('id')->on('sl_sale_invoice')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_customer_account_receivable', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_customer_account_sl_customer_account_receivable');
			$table->dropForeign('fk_sl_sale_invoice_sl_customer_account_receivable');
		});
	}

}
