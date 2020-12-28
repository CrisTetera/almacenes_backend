<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlSaleInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_sale_invoice', function(Blueprint $table)
		{
			$table->foreign('sl_customer_account_movement_id', 'fk_sl_customer_account_movement_sl_sale_invoice2')->references('id')->on('sl_customer_account_movement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_service_order_id', 'sl_service_order_sl_sale_invoice_3_fk')->references('id')->on('sl_service_order')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_service_order_id2', 'sl_service_order_sl_sale_invoice_4_fk')->references('id')->on('sl_service_order')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_id', 'fk_sl_sale_invoice_sl_customer')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_branch_offices_id', 'fk_sl_sale_invoice_sl_customer_branch_offices')->references('id')->on('sl_customer_branch_offices')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_company_id', 'sl_sale_invoice_g_company_fk')->references('id')->on('g_company')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_state_id', 'sl_sale_invoice_g_state_fk')->references('id')->on('g_state')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_sale_invoice', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_customer_account_movement_sl_sale_invoice2');
			$table->dropForeign('sl_service_order_sl_sale_invoice_3_fk');
			$table->dropForeign('sl_service_order_sl_sale_invoice_4_fk');
			$table->dropForeign('fk_sl_sale_invoice_sl_customer');
			$table->dropForeign('fk_sl_sale_invoice_sl_customer_branch_offices');
			$table->dropForeign('sl_sale_invoice_g_company_fk');
			$table->dropForeign('sl_sale_invoice_g_state_fk');
		});
	}

}
