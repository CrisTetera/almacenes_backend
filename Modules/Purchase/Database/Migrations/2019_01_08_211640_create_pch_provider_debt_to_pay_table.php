<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchProviderDebtToPayTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_provider_debt_to_pay', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_purchase_invoice_id')->index('pch_provider_debt_to_pay_pch_purchase_invoice_fk');
			$table->integer('pch_provider_account_id')->index('pch_provider_account_pch_provider_debt_to_pay_fk');
			$table->date('date_to_pay');
			$table->integer('fee_number');
			$table->decimal('total_paid', 10);
			$table->boolean('flag_paid');
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
		Schema::drop('pch_provider_debt_to_pay');
	}

}
