<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGUserPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_user_pos', function (Blueprint $table) {
            $table->foreign('hr_employee_id' , 'g_user_pos_children_hr_employee_pos_fk')->references('id')->on('hr_employee_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('g_user_pos', function (Blueprint $table) {
            $table->dropForeign('g_user_pos_children_hr_employee_pos_fk');
        });
    }
}
