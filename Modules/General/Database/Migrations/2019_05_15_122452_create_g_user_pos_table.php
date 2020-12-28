<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGUserPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_user_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hr_employee_id')->nullable()->unique()->index('g_user_pos_children_hr_employee_pos_fk');
			$table->string('password')->default('');
			$table->string('auth_code', 5)->default('');
			$table->string('bar_auth_code', 12)->default('');
			$table->string('remember_token')->nullable();
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
        Schema::dropIfExists('g_user_pos');
    }
}
