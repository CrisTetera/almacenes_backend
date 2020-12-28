<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosDailyCashTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_daily_cash', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pos_cash_desk_id')->index('pos_daily_cash_pos_cash_desk_fk');
			$table->integer('g_cashier_opening_user_id')->index('pos_daily_cash_cashier_opening_user_fk');
			$table->integer('g_cashier_closure_user_id')->nullable()->index('pos_daily_cash_cashier_closure_user_fk');
			$table->integer('g_cash_supervisor_user_id')->nullable()->index('pos_daily_cash_supervisor_user_fk');
			$table->integer('g_state_id')->index('post_daily_cash_g_state_fk'); //5 => Realizada / 6 => Confirmada / 20=> abierta
			
			$table->datetime('opening_timestamp');
			$table->datetime('closure_timestamp')->nullable();
			
			$table->decimal('ingress_total', 10)->nullable();
			
			$table->decimal('initial_amount_cash', 10)->nullable();
			
			$table->decimal('customer_sales_total', 10)->nullable();
			$table->decimal('customer_sales_with_cash_total', 10)->nullable();
			$table->decimal('customer_sales_with_credit_card_total', 10)->nullable();
			$table->decimal('customer_sales_with_debit_card_total', 10)->nullable();
			$table->decimal('customer_sales_with_check_total', 10)->nullable();
			$table->decimal('customer_sales_with_customer_credit_total', 10)->nullable();
			
			$table->decimal('employe_sales_total', 10)->nullable();
			$table->decimal('employe_sales_with_cash_total', 10)->nullable();
			$table->decimal('employe_sales_with_credit_card_total', 10)->nullable();
			$table->decimal('employe_sales_with_debit_card_total', 10)->nullable();
			$table->decimal('employe_sales_with_check_total', 10)->nullable();
			$table->decimal('employe_sales_with_employee_credit_total', 10)->nullable();

			$table->decimal('ingress_cash_movement_total', 10)->nullable();

			$table->decimal('egress_total', 10)->nullable();
			$table->decimal('egress_cash_movement_total', 10)->nullable();

			$table->decimal('estimated_cash_total', 10)->nullable();
			$table->decimal('real_cash_total', 10)->nullable();
			$table->decimal('difference', 10)->nullable();
			
			$table->string('opening_observation', 500)->nullable();
			$table->string('closure_observation', 500)->nullable();

			$table->boolean('flag_open_daily_cash')->default(1);
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
		Schema::drop('pos_daily_cash');
	}

}
