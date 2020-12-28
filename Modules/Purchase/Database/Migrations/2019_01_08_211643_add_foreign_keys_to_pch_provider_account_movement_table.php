<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchProviderAccountMovementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_provider_account_movement', function(Blueprint $table)
		{
			$table->foreign('pch_provider_account_id', 'fk_pch_provider_account_movement_pch_provider_account')->references('id')->on('pch_provider_account')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_purchase_credit_note_id', 'fk_pch_provider_account_movement_pch_purchase_credit_note')->references('id')->on('pch_purchase_credit_note')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_purchase_debit_note_id', 'fk_pch_provider_account_movement_pch_purchase_debit_note')->references('id')->on('pch_purchase_debit_note')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_purchase_invoice_id', 'fk_pch_provider_account_movement_pch_purchase_invoice')->references('id')->on('pch_purchase_invoice')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_type_provider_account_movement_id', 'fk_pch_provider_account_movement_pch_type_account_movement')->references('id')->on('pch_type_provider_account_movement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_provider_payment_id', 'fk_pch_provider_payment_pch_provider_accouint_movement2')->references('id')->on('pch_provider_payment')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_provider_account_movement', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_provider_account_movement_pch_provider_account');
			$table->dropForeign('fk_pch_provider_account_movement_pch_purchase_credit_note');
			$table->dropForeign('fk_pch_provider_account_movement_pch_purchase_debit_note');
			$table->dropForeign('fk_pch_provider_account_movement_pch_purchase_invoice');
			$table->dropForeign('fk_pch_provider_account_movement_pch_type_account_movement');
			$table->dropForeign('fk_pch_provider_payment_pch_provider_accouint_movement2');
		});
	}

}
