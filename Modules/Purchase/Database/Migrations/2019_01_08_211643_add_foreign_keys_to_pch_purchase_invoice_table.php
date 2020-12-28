<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchPurchaseInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_purchase_invoice', function(Blueprint $table)
		{
			$table->foreign('pch_provider_account_movement_id', 'fk_pch_provider_account_movement_pch_purchase_invoice2')->references('id')->on('pch_provider_account_movement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_provider_id', 'fk_pch_provider_pch_purchase_invoice')->references('id')->on('pch_provider')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_commune_id', 'fk_pch_purchase_invoice_g_commune')->references('id')->on('g_commune')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_purchase_invoice', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_provider_account_movement_pch_purchase_invoice2');
			$table->dropForeign('fk_pch_provider_pch_purchase_invoice');
			$table->dropForeign('fk_pch_purchase_invoice_g_commune');
		});
	}

}
