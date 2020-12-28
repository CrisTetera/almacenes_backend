<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_pos', function (Blueprint $table) {
            $table->increments('id');
			$table->string('rut', 10)->unique();
            $table->string('first_names');
			$table->string('last_name1');
			$table->string('last_name2');
            $table->string('email', 100)->unique();
            $table->string('type',50)->nullable();
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
        Schema::dropIfExists('hr_employee_pos');
    }
}
