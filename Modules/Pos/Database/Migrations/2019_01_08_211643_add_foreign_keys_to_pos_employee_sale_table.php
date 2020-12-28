<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosEmployeeSaleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_employee_sale', function(Blueprint $table)
		{
			$table->foreign('g_seller_user_id', 'fk_pos_employee_sale_seller_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_cashier_user_id', 'fk_pos_employee_sale_cashier_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_supervisor_user_id', 'fk_pos_employee_sale_supervisor_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_cash_desk_id', 'fk_pos_employee_sale_g_cash_desk')->references('id')->on('pos_cash_desk')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_state_id', 'fk_pos_employee_sale_g_state')->references('id')->on('g_state')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_branch_office_id', 'fk_pos_employee_sale_g_branch_office')->references('id')->on('g_state')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('pos_sale_type_id', 'fk_pos_employeesale_pos_sale_type')->references('id')->on('pos_sale_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_ticket_id', 'fk_pos_employee_sale_sl_sale_ticket')->references('id')->on('sl_sale_ticket')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_employee_sale', function(Blueprint $table)
		{
			$table->dropForeign('fk_pos_employee_sale_seller_user');
			$table->dropForeign('fk_pos_employee_sale_cashier_user');
			$table->dropForeign('fk_pos_employee_sale_supervisor_user');
            $table->dropForeign('fk_pos_employee_sale_g_cash_desk');
			$table->dropForeign('fk_pos_employee_sale_g_state');
			$table->dropForeign('fk_pos_employee_sale_g_branch_office');
			$table->dropForeign('fk_pos_employeesale_pos_sale_type');
			$table->dropForeign('fk_pos_employee_sale_sl_sale_ticket');
		});
	}

}
