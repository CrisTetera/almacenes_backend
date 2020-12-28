<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlElectronicTransferPaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_electronic_transfer_payment', function(Blueprint $table)
		{
			$table->foreign('sl_customer_account_bank_id', 'fk_sl_customer_account_bank_sl_electronic_transfer_payment')->references('id')->on('sl_customer_account_bank')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_payment_id', 'fk_sl_customer_payment_sl_electronic_transer_payment2')->references('id')->on('sl_customer_payment')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_electronic_transfer_payment', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_customer_account_bank_sl_electronic_transfer_payment');
			$table->dropForeign('fk_sl_customer_payment_sl_electronic_transer_payment2');
		});
	}

}
