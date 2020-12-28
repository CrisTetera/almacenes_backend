<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchPurchaseCreditNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_purchase_credit_note', function(Blueprint $table)
		{
			$table->foreign('pch_provider_account_movement_id', 'fk_pch_provider_account_movement_pch_purchase_credit_note2')->references('id')->on('pch_provider_account_movement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_commune_id', 'fk_pch_purchase_credit_note_g_commune')->references('id')->on('g_commune')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_purchase_invoice_id', 'fk_pch_purchase_credit_note_pch_purchase_invoice')->references('id')->on('pch_purchase_invoice')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_purchase_credit_note', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_provider_account_movement_pch_purchase_credit_note2');
			$table->dropForeign('fk_pch_purchase_credit_note_g_commune');
			$table->dropForeign('fk_pch_purchase_credit_note_pch_purchase_invoice');
		});
	}

}
