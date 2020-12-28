<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlServiceOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_service_order', function(Blueprint $table)
		{
			$table->foreign('g_seller_user_id', 'fk_sl_service_order_g_user_seller')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_supervisor_user_id', 'fk_sl_service_order_g_user_supervisor')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_credit_note_id', 'fk_sl_service_order_sl_sale_credit_note')->references('id')->on('sl_sale_credit_note')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_invoice_id', 'fk_sl_service_order_sl_sale_invoice_1')->references('id')->on('sl_sale_invoice')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_invoice_id2', 'fk_sl_service_order_sl_sale_invoice_2')->references('id')->on('sl_sale_invoice')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_ticket_id', 'fk_sl_service_order_sl_sale_ticket_1')->references('id')->on('sl_sale_ticket')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_ticket_id2', 'fk_sl_service_order_sl_sale_ticket_2')->references('id')->on('sl_sale_ticket')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_service_order_type_id', 'fk_sl_service_order_sl_service_order_type')->references('id')->on('sl_service_order_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_service_order', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_service_order_g_user_seller');
			$table->dropForeign('fk_sl_service_order_g_user_supervisor');
			$table->dropForeign('fk_sl_service_order_sl_sale_credit_note');
			$table->dropForeign('fk_sl_service_order_sl_sale_invoice_1');
			$table->dropForeign('fk_sl_service_order_sl_sale_invoice_2');
			$table->dropForeign('fk_sl_service_order_sl_sale_ticket_1');
			$table->dropForeign('fk_sl_service_order_sl_sale_ticket_2');
			$table->dropForeign('fk_sl_service_order_sl_service_order_type');
		});
	}

}
