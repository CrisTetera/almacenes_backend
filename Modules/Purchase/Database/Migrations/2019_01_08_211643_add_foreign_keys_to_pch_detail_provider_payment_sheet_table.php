<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchDetailProviderPaymentSheetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_detail_provider_payment_sheet', function(Blueprint $table)
		{
			$table->foreign('pch_provider_account_bank_id', 'fk_pch_detail_provider_payment_sheet_pch_provider_account_bank')->references('id')->on('pch_provider_account_bank')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_provider_payment_id', 'fk_pch_detail_provider_payment_sheet_pch_provider_payment')->references('id')->on('pch_provider_payment')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_provider_account_id', 'fk_pch_provider_account_pch_detail_provider_payment_sheet')->references('id')->on('pch_provider_account')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_provider_payment_sheet_id', 'fk_pch_prvdr_payment_sheet_pch_detail_provider_payment_sheet')->references('id')->on('pch_provider_payment_sheet')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_detail_provider_payment_sheet', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_detail_provider_payment_sheet_pch_provider_account_bank');
			$table->dropForeign('fk_pch_detail_provider_payment_sheet_pch_provider_payment');
			$table->dropForeign('fk_pch_provider_account_pch_detail_provider_payment_sheet');
			$table->dropForeign('fk_pch_prvdr_payment_sheet_pch_detail_provider_payment_sheet');
		});
	}

}
