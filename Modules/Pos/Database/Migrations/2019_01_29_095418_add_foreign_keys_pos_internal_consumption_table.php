<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysPosInternalConsumptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_internal_consumption', function (Blueprint $table) {
            $table->foreign('hr_requester_employee_id', 'fk_pos_internal_consumption_hr_employee')->references('id')->on('hr_employee')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('g_seller_user_id', 'fk_pos_internal_consumption_g_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('g_branch_office_id', 'fk_pos_internal_consumption_g_branch_office')->references('id')->on('g_branch_office')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_internal_consumption', function (Blueprint $table) {
            $table->dropForeign('fk_pos_internal_consumption_g_user');
            $table->dropForeign('fk_pos_internal_consumption_hr_employee');
            $table->dropForeign('fk_pos_internal_consumption_g_branch_office');
        });
    }
}
