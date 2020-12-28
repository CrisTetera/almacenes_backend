<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosSaleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_sale', function(Blueprint $table)
		{
			$table->foreign('pos_customer_credit_option_id', 'fk_pos_customer_cedit_option_pos_sale')->references('id')->on('pos_customer_credit_option')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_cash_desk_id', 'fk_pos_sale_g_cash_desk')->references('id')->on('pos_cash_desk')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_seller_user_id', 'fk_pos_sale_g_seller_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_supervisor_user_id', 'fk_pos_sale_g_supervisor_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_cashier_user_id', 'fk_pos_sale_g_cashier_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_state_id', 'fk_pos_sale_g_state')->references('id')->on('g_state')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_branch_office_id', 'fk_pos_sale_g_branch_office')->references('id')->on('g_branch_office')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_sale_note_id', 'fk_pos_sale_note_pos_sale2')->references('id')->on('pos_sale_note')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_manual_discount_id', 'fk_pos_sale_pos_manual_discount')->references('id')->on('pos_manual_discount')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_sale_type_id', 'fk_pos_sale_pos_sale_type')->references('id')->on('pos_sale_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_id', 'fk_sl_customer_pos_sale')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_branch_offices_id', 'fk_sl_customer_branch_offices_pos_sale')->references('id')->on('sl_customer_branch_offices')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_sale_note_id', 'fk_wh_sale_note__pos_sale2')->references('id')->on('wh_sale_note')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_ticket_id', 'pos_sale_note_sl_sale_ticket_fk')->references('id')->on('sl_sale_ticket')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_invoice_id', 'pos_sale_note_sl_sale_invoice_fk')->references('id')->on('sl_sale_invoice')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_origin_sale_id', 'pos_sale_pos_origin_sale_fk')->references('id')->on('pos_origin_sale')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_sale', function(Blueprint $table)
		{
			$table->dropForeign('fk_pos_customer_cedit_option_pos_sale');
			$table->dropForeign('fk_pos_sale_g_cash_desk');
			$table->dropForeign('fk_pos_sale_g_seller_user');
			$table->dropForeign('fk_pos_sale_g_supervisor_user');
			$table->dropForeign('fk_pos_sale_g_cashier_user');
			$table->dropForeign('fk_pos_sale_g_state');
			$table->dropForeign('fk_pos_sale_g_branch_office');
			$table->dropForeign('fk_pos_sale_note_pos_sale2');
			$table->dropForeign('fk_pos_sale_pos_manual_discount');
			$table->dropForeign('fk_pos_sale_pos_sale_type');
			$table->dropForeign('fk_sl_customer_pos_sale');
			$table->dropForeign('fk_sl_customer_branch_offices_pos_sale');
			$table->dropForeign('fk_wh_sale_note__pos_sale2');
			$table->dropForeign('pos_sale_pos_origin_sale_fk');
		});
	}

}
