<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlCustomerAccountBankTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_customer_account_bank', function(Blueprint $table)
		{
			$table->foreign('g_bank_id', 'fk_sl_customer_account_bank_g_bank')->references('id')->on('g_bank')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_type_account_bank_id', 'fk_sl_customer_account_bank_g_type_account_bank')->references('id')->on('g_type_account_bank')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_id', 'fk_sl_customer_sl_customer_account_bank')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_customer_account_bank', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_customer_account_bank_g_bank');
			$table->dropForeign('fk_sl_customer_account_bank_g_type_account_bank');
			$table->dropForeign('fk_sl_customer_sl_customer_account_bank');
		});
	}

}
