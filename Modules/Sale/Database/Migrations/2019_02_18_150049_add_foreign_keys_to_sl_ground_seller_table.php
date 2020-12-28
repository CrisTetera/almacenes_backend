<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlGroundSellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_ground_seller', function (Blueprint $table) {
            $table->foreign('hr_employee_id', 'fk_sl_ground_seller_hr_employee')->references('id')->on('hr_employee')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_ground_seller', function (Blueprint $table) {
            $table->dropForeign('fk_sl_ground_seller_hr_employee');
        });
    }
}
