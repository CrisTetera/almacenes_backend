<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlSaleCreditNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_sale_credit_note', function(Blueprint $table)
		{
			$table->foreign('sl_customer_account_movement_id', 'fk_sl_customer_account_movement_sl_sale_credit_note2')->references('id')->on('sl_customer_account_movement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_id', 'fk_sl_sale_credit_note_sl_customer')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_service_order_id', 'fk_sl_service_order_sl_sale_credit_note2')->references('id')->on('sl_service_order')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_service_order_id2', 'fk_sl_service_order2_sl_sale_credit_note2')->references('id')->on('sl_service_order')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_sale_credit_note', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_customer_account_movement_sl_sale_credit_note2');
			$table->dropForeign('fk_sl_sale_credit_note_sl_customer');
			$table->dropForeign('fk_sl_service_order_sl_sale_credit_note2');
			$table->dropForeign('fk_sl_service_order2_sl_sale_credit_note2');
		});
	}

}
