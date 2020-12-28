<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchPurchaseQuotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_purchase_quotation', function(Blueprint $table)
		{
			$table->foreign('pch_provider_id', 'fk_pch_provider_pch_purchase_quotation')->references('id')->on('pch_provider')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_state_id', 'fk_pch_purchase_quotation_g_state')->references('id')->on('g_state')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_purchase_quotation', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_provider_pch_purchase_quotation');
			$table->dropForeign('fk_pch_purchase_quotation_g_state');
		});
	}

}
