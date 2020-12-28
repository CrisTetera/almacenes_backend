<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchProviderDebtToPayTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_provider_debt_to_pay', function(Blueprint $table)
		{
			$table->foreign('pch_provider_account_id', 'fk_pch_provider_account_pch_provider_debt_to_pay')->references('id')->on('pch_provider_account')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_purchase_invoice_id', 'fk_pch_provider_debt_to_pay_pch_purchase_invoice')->references('id')->on('pch_purchase_invoice')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_provider_debt_to_pay', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_provider_account_pch_provider_debt_to_pay');
			$table->dropForeign('fk_pch_provider_debt_to_pay_pch_purchase_invoice');
		});
	}

}
