<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPosCashDeskPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('pos_cash_desk_pos', function (Blueprint $table) {
        //     $table->foreign('g_state_id' , 'pos_cash_desk_pos_children_g_state_pos_fk')->references('id')->on('g_state_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('pos_cash_desk_pos', function (Blueprint $table) {
        //     $table->dropForeign('pos_cash_desk_pos_children_g_state_pos_fk');
        // });
    }
}
