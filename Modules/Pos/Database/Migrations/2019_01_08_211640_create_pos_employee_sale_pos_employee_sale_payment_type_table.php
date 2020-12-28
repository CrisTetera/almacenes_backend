<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosEmployeeSalePosEmployeeSalePaymentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_employee_sale_pos_employee_sale_payment_type', function (Blueprint $table) {
            $table->integer('pos_employee_sale_payment_type_id')->index('pos_employee_sale_pos_employee_sale_payment_type_fk');
			$table->integer('pos_employee_sale_id')->index('pos_employee_sale_pos_payment_type_fk');
            $table->integer('amount');
            // Commented because you can pay two or more time with same payment type
			// $table->primary(['pos_employee_sale_payment_type_id','pos_employee_sale_id'], 'pk_pos_employee_sale_pos_employee_sale_payment_type');
			// $table->unique(['pos_employee_sale_payment_type_id','pos_employee_sale_id'], 'pos_employee_sale_pos_employee_sale_payment_type_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_employee_sale_pos_employee_sale_payment_type');
    }
}
