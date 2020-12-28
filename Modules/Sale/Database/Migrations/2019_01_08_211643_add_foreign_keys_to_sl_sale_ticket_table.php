<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlSaleTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_sale_ticket', function(Blueprint $table)
		{
			$table->foreign('sl_customer_id', 'fk_sl_sale_ticket_sl_customer')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_service_order_id', 'fk_sl_service_order_sl_sale_ticket_3')->references('id')->on('sl_service_order')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_service_order_id2', 'fk_sl_service_order_sl_sale_ticket_4')->references('id')->on('sl_service_order')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_company_id', 'sl_sale_ticket_g_company_fk')->references('id')->on('g_company')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_sale_ticket', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_sale_ticket_sl_customer');
			$table->dropForeign('fk_sl_service_order_sl_sale_ticket_3');
			$table->dropForeign('fk_sl_service_order_sl_sale_ticket_4');
			$table->dropForeign('sl_sale_ticket_g_company_fk');
		});
	}

}
