<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosEmployeePaymentCashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_employee_payment_cash', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pos_employee_sale_payment_type_id')->nullable()->index('pos_employee_payment_cash_pos_employee_sale_payment_type_fk');
            $table->integer('pos_employee_sale_id')->nullable()->index('pos_employee_payment_cash_pos_employee_sale_pos_payment_type_fk');
            $table->integer('rounding_law');
            $table->boolean('flag_delete', false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_employee_payment_cash');
    }
}
