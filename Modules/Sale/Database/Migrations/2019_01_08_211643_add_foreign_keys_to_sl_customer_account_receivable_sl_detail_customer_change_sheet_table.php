<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlCustomerAccountReceivableSlDetailCustomerChangeSheetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_customer_account_receivable_sl_detail_customer_change_sheet', function(Blueprint $table)
		{
			$table->foreign('sl_customer_account_receivable_id', 'fk_sl_cstmr_accnt_receivable_sl_detail_customer_change_sheet')->references('id')->on('sl_customer_account_receivable')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_detail_customer_charge_sheet_id', 'fk_sl_cstmr_accnt_receivable_sl_detail_customer_change_sheet2')->references('id')->on('sl_detail_customer_charge_sheet')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_customer_account_receivable_sl_detail_customer_change_sheet', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_cstmr_accnt_receivable_sl_detail_customer_change_sheet');
			$table->dropForeign('fk_sl_cstmr_accnt_receivable_sl_detail_customer_change_sheet2');
		});
	}

}
