<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchProviderPaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_provider_payment', function(Blueprint $table)
		{
			$table->foreign('pch_detail_provider_payment_sheet_id', 'fk_pch_provider_payment_pch_detail_provider_payment_sheet')->references('id')->on('pch_detail_provider_payment_sheet')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_provider_account_movement_id', 'fk_pch_provider_payment_pch_provider_accouint_movement')->references('id')->on('pch_provider_account_movement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_provider_payment', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_provider_payment_pch_detail_provider_payment_sheet');
			$table->dropForeign('fk_pch_provider_payment_pch_provider_accouint_movement');
		});
	}

}
