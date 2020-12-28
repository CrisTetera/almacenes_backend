<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchProviderDebtToPayPchDetailProviderPaymentSheetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_provider_debt_to_pay_pch_detail_provider_payment_sheet', function(Blueprint $table)
		{
			$table->integer('pch_detail_provider_payment_sheet_id')->index('pch_provider_debt_to_pay_pch_detail_provider_payment_sheet2_fk');
			$table->integer('pch_provider_debt_to_pay_id')->index('pch_provider_debt_to_pay_pch_detail_provider_payment_sheet_fk');
			$table->primary(['pch_detail_provider_payment_sheet_id','pch_provider_debt_to_pay_id'], 'pk_pch_provider_debt_to_pay_pch_detail_provider_payment_sheet');
			$table->unique(['pch_detail_provider_payment_sheet_id','pch_provider_debt_to_pay_id'], 'pch_provider_debt_to_pay_pch_detail_provider_payment_sheet_pk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pch_provider_debt_to_pay_pch_detail_provider_payment_sheet');
	}

}
