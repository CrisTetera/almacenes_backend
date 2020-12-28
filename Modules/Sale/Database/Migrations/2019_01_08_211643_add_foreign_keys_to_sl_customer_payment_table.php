<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlCustomerPaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_customer_payment', function(Blueprint $table)
		{
			$table->foreign('sl_customer_account_movement_id', 'fk_sl_customer_account_movement_sl_customer_payment2')->references('id')->on('sl_customer_account_movement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_detail_customer_charge_sheet_id', 'fk_sl_customer_payment_sl_detail_customer_change_sheet')->references('id')->on('sl_detail_customer_charge_sheet')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_electronic_transfer_payment_id', 'fk_sl_customer_payment_sl_electronic_transer_payment')->references('id')->on('sl_electronic_transfer_payment')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_customer_payment', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_customer_account_movement_sl_customer_payment2');
			$table->dropForeign('fk_sl_customer_payment_sl_detail_customer_change_sheet');
			$table->dropForeign('fk_sl_customer_payment_sl_electronic_transer_payment');
		});
	}

}
