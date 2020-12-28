<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosEmployeeSaleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_employee_sale', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_seller_user_id')->nullable()->index('pos_employee_sale_seller_user_fk');
			$table->integer('g_cashier_user_id')->nullable()->index('pos_employee_sale_cashier_user_fk');
			$table->integer('g_supervisor_user_id')->nullable()->index('pos_employee_sale_supervisor_user_fk');
			$table->integer('pos_cash_desk_id')->nullable()->index('pos_employee_sale_g_cash_desk_fk');
            $table->integer('g_branch_office_id')->nullable()->index('pos_employee_sale_g_branch_office_fk');
            $table->integer('g_state_id')->nullable()->index('pos_employee_sale_g_state_fk');
            $table->integer('pos_sale_type_id')->nullable()->index('pos_employee_sale_pos_sale_type_fk');
            $table->integer('net_subtotal');
			$table->integer('discount_or_charge_percentage');
			$table->integer('discount_or_charge_amount')->default(0);
			$table->integer('new_net_subtotal');
			$table->integer('exent_total');
			$table->integer('iva');
			$table->integer('ticket_total');
            $table->integer('invoice_total');
            $table->integer('sl_sale_ticket_id')->nullable()->index('pos_employee_sale_sl_sale_ticket_fk');
			$table->datetime('close_sale_datetime')->nullable();
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
		Schema::drop('pos_employee_sale');
	}

}
