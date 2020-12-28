<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosSaleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_sale', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('net_subtotal');
			$table->integer('discount_or_charge_amount')->default(0);
			$table->integer('discount_or_charge_percentage')->default(0);
			$table->integer('new_net_subtotal');
			$table->integer('exent_total');
			$table->integer('iva');
			$table->integer('ticket_total');
			$table->integer('invoice_total');
			$table->datetime('close_sale_datetime')->nullable();
			$table->integer('pos_customer_credit_option_id')->nullable()->index('pos_customer_cedit_option_pos_sale_fk');
			$table->integer('pos_sale_type_id')->nullable()->index('pos_sale_pos_sale_type_fk');
			$table->integer('g_seller_user_id')->nullable()->index('pos_sale_g_seller_user_fk');
			$table->integer('g_supervisor_user_id')->nullable()->index('pos_sale_g_supervisor_user_fk');
			$table->integer('g_cashier_user_id')->nullable()->index('pos_sale_g_cashier_user_fk');
			$table->integer('g_state_id')->nullable()->index('pos_sale_g_state_fk');
			$table->integer('pos_cash_desk_id')->nullable()->index('pos_sale_g_cash_desk_fk');
			$table->integer('g_branch_office_id')->nullable()->index('pos_sale_g_branch_office_fk');
			$table->integer('pos_manual_discount_id')->nullable()->index('pos_sale_pos_manual_discount_fk');
			$table->integer('wh_sale_note_id')->nullable()->index('wh_sale_note__pos_sale2_fk');
			$table->integer('sl_customer_id')->nullable()->index('sl_customer_pos_sale_fk');
			$table->integer('sl_customer_branch_offices_id')->nullable()->index('sl_customer_branch_offices_pos_sale_fk');
			$table->integer('pos_sale_note_id')->nullable()->index('pos_sale_note_pos_sale2_fk');
			$table->integer('sl_sale_ticket_id')->nullable()->index('pos_sale_note_sl_sale_ticket_fk');
			$table->integer('sl_sale_invoice_id')->nullable()->index('pos_sale_note_sl_sale_invoice_fk');
			$table->integer('pos_origin_sale_id')->index('pos_sale_pos_origin_sale_fk')->default(1); //default venta en sala
			$table->boolean('flag_delete')->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pos_sale');
	}

}
