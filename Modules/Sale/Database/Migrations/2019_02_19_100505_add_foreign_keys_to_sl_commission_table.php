<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlCommissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_commission', function (Blueprint $table) {
            $table->foreign('sl_commission_type_id', 'fk_sl_commission_sl_commission_type')->references('id')->on('sl_commission_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_commission', function (Blueprint $table) {
            $table->dropForeign('fk_sl_commission_sl_commission_type');
        });
    }
}
