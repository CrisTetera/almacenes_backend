<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsKeysToGUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_user', function (Blueprint $table) {
            $table->foreign('hr_employee_id', 'fk_g_user_hr_employee')->references('id')->on('hr_employee')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('g_user', function (Blueprint $table) {
            $table->dropForeign('fk_g_user_hr_employee');
        });
    }
}
