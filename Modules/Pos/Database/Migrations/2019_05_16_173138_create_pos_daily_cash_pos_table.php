<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosDailyCashPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_daily_cash_pos', function (Blueprint $table) {
           
            $table->increments('id');
            $table->integer('pos_cash_desk_id')->index('pos_daily_cash_pos_children_pos_cash_desk_pos_fk');
			$table->integer('g_cashier_opening_user_id')->index('pos_daily_cash_pos_children_g_user_pos_fk');
			$table->integer('g_cashier_closure_user_id')->nullable()->index('pos_daily_cash_pos_children_g_user_pos_fk2');
			$table->integer('g_state_id')->index('pos_daily_cash_pos_g_state_pos_fk'); //5 => Realizada / 6 => Confirmada / 20=> abierta

            $table->date('opening_timestamp');
            $table->date('closure_timestamp')->nullable();

            $table->decimal('ingress_total', 10)->nullable();

            $table->decimal('initial_amount_cash')->nullable();

            $table->decimal('sales_total', 10)->nullable();
            $table->decimal('sales_cash_total')->nullable();
            $table->decimal('sales_credit_total')->nullable();
            $table->decimal('sales_debit_total')->nullable();

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
        Schema::dropIfExists('pos_daily_cash_pos');
    }
}
