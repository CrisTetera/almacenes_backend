<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToHrEmployeePresetsDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_employee_presets_discount', function (Blueprint $table) {
            $table->foreign('hr_employee_id', 'fk_hr_employee_hr_employee_presets_discount')->references('id')->on('hr_employee')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_employee_presets_discount', function (Blueprint $table) {
            $table->dropForeign('fk_hr_employee_hr_employee_presets_discount');
        });
    }
}
