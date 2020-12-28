<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchProviderPaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_provider_payment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_detail_provider_payment_sheet_id')->index('pch_provider_payment_pch_detail_provider_payment_sheet_fk');
			$table->integer('pch_provider_account_movement_id')->index('pch_provider_payment_pch_provider_accouint_movement_fk');
			$table->date('date_payment');
			$table->decimal('amount_paid', 10);
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
		Schema::drop('pch_provider_payment');
	}

}
