<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlCommissionHrEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_commission_hr_employee', function (Blueprint $table) {
            $table->integer('sl_commission_id')->index('sl_commission_hr_employee_sl_commission_fk');
			$table->integer('hr_employee_id')->index('sl_commission_hr_employee_hr_employee_fk');
			$table->primary(['sl_commission_id','hr_employee_id'], 'pk_sl_commission_hr_employee');
			$table->unique(['sl_commission_id','hr_employee_id'], 'sl_commission_hr_employee_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sl_commission_hr_employee');
    }
}
