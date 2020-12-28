<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlCustomerAccountReceivableSlDetailCustomerChangeSheetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_customer_account_receivable_sl_detail_customer_change_sheet', function(Blueprint $table)
		{
			$table->integer('sl_detail_customer_charge_sheet_id')->index('sl_cstmer_accnt_receivable_sl_detail_customer_change_sheet2_fk');
			$table->integer('sl_customer_account_receivable_id')->index('sl_cstmer_accnt_receivable_sl_detail_customer_change_sheet_fk');
			$table->primary(['sl_detail_customer_charge_sheet_id','sl_customer_account_receivable_id'], 'pk_sl_cstmr_accnt_receivable_sl_detail_customer_change_sheet');
			$table->unique(['sl_detail_customer_charge_sheet_id','sl_customer_account_receivable_id'], 'sl_cstmr_accnt_receivable_sl_detail_customer_change_sheet_pk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sl_customer_account_receivable_sl_detail_customer_change_sheet');
	}

}
