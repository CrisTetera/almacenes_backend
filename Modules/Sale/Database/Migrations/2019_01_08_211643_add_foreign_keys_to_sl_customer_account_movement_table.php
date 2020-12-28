<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlCustomerAccountMovementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_customer_account_movement', function(Blueprint $table)
		{
			$table->foreign('sl_customer_payment_id', 'fk_sl_customer_account_movement_sl_customer_payment')->references('id')->on('sl_customer_payment')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_credit_note_id', 'fk_sl_customer_account_movement_sl_sale_credit_note')->references('id')->on('sl_sale_credit_note')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_debit_note_id', 'fk_sl_customer_account_movement_sl_sale_debit_note')->references('id')->on('sl_sale_debit_note')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_invoice_id', 'fk_sl_customer_account_movement_sl_sale_invoice')->references('id')->on('sl_sale_invoice')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_type_customer_account_movement_id', 'fk_sl_cstmr_accnt_movement_sl_type_customer_account_movement')->references('id')->on('sl_type_customer_account_movement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_account_id', 'fk_sl_customer_account_sl_customer_account_movement')->references('id')->on('sl_customer_account')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_customer_account_movement', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_customer_account_movement_sl_customer_payment');
			$table->dropForeign('fk_sl_customer_account_movement_sl_sale_credit_note');
			$table->dropForeign('fk_sl_customer_account_movement_sl_sale_debit_note');
			$table->dropForeign('fk_sl_customer_account_movement_sl_sale_invoice');
			$table->dropForeign('fk_sl_cstmr_accnt_movement_sl_type_customer_account_movement');
			$table->dropForeign('fk_sl_customer_account_sl_customer_account_movement');
		});
	}

}
