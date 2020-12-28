<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPosDailyCashPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_daily_cash_pos', function (Blueprint $table) {
            $table->foreign('pos_cash_desk_id' , 'pos_daily_cash_pos_children_pos_cash_desk_pos_fk')->references('id')->on('pos_cash_desk_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('g_cashier_opening_user_id' , 'pos_daily_cash_pos_children_g_user_pos_fk')->references('id')->on('g_user_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('g_cashier_closure_user_id' , 'pos_daily_cash_pos_children_g_user_pos_fk2')->references('id')->on('g_user_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('g_state_id' , 'pos_daily_cash_pos_children_g_state_pos_fk')->references('id')->on('g_state_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_daily_cash_pos', function (Blueprint $table) {
            $table->dropForeign('pos_daily_cash_pos_children_pos_cash_desk_pos_fk');
            $table->dropForeign('pos_daily_cash_pos_children_g_user_pos_fk');
            $table->dropForeign('pos_daily_cash_pos_children_g_user_pos_fk2');
            $table->dropForeign('pos_daily_cash_pos_children_g_state_pos_fk');
        });
    }
}
