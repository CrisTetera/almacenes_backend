<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchDetailProviderPaymentSheetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_detail_provider_payment_sheet', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_provider_payment_id')->index('pch_detail_provider_payment_sheet_pch_provider_payment_fk');
			$table->integer('pch_provider_account_bank_id')->index('pch_detail_provider_payment_sheet_pch_provider_account_bank_fk');
			$table->integer('pch_provider_account_id')->nullable()->index('pch_provider_account_pch_detail_provider_payment_sheet_fk');
			$table->integer('pch_provider_payment_sheet_id')->index('pch_prvder_payment_sheet_pch_detail_provider_payment_sheet_fk');
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
		Schema::drop('pch_detail_provider_payment_sheet');
	}

}
