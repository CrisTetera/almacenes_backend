<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeePresetsDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_presets_discount', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hr_employee_id')->index('hr_employee_hr_employee_presets_discount_fk');
			$table->decimal('discount_percentage', 10);
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
        Schema::dropIfExists('hr_employee_presets_discount');
    }
}
