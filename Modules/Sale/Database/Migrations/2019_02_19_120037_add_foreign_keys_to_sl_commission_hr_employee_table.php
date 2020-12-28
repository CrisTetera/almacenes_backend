<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlCommissionHrEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_commission_hr_employee', function (Blueprint $table) {
            $table->foreign('sl_commission_id', 'fk_sl_commission_hr_employee_sl_commission')->references('id')->on('sl_commission')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('hr_employee_id', 'fk_sl_commission_hr_employee_hr_employee')->references('id')->on('hr_employee')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_commission_hr_employee', function (Blueprint $table) {
            $table->dropForeign('fk_sl_commission_hr_employee_sl_commission');
            $table->dropForeign('fk_sl_commission_hr_employee_hr_employee');
        });
    }
}
