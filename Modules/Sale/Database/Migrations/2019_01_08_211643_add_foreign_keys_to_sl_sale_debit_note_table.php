<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlSaleDebitNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_sale_debit_note', function(Blueprint $table)
		{
			$table->foreign('sl_customer_account_movement_id', 'fk_sl_customer_account_movement_sl_sale_debit_note2')->references('id')->on('sl_customer_account_movement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_id', 'fk_sl_sale_debit_note_sl_customer')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_sale_debit_note', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_customer_account_movement_sl_sale_debit_note2');
			$table->dropForeign('fk_sl_sale_debit_note_sl_customer');
		});
	}

}
