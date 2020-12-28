<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlCallCenterSellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_call_center_seller', function (Blueprint $table) {
            $table->foreign('hr_employee_id', 'sl_call_center_seller_hr_employee_fk')->references('id')->on('hr_employee')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_call_center_seller', function (Blueprint $table) {
            $table->dropForeign('sl_call_center_seller_hr_employee_fk');
        });
    }
}
