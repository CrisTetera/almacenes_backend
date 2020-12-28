<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPosCashDeskMovementPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_cash_desk_movement_pos', function (Blueprint $table) {
            $table->foreign('pos_movement_egress_type_id', 'pos_cash_desk_movement_pos_children_pos_cash_movement_egress_type_pos_fk')->references('id')->on('pos_movement_egress_type_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_movement_ingress_type_id', 'pos_cash_desk_movement_pos_children_pos_cash_movement_ingress_type_pos_fk')->references('id')->on('pos_movement_ingress_type_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('pos_cash_desk_id' , 'pos_cash_desk_movement_pos_children_pos_cash_desk_pos_fk')->references('id')->on('pos_cash_desk_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('g_user_id' , 'pos_cash_desk_pos_children_g_user_pos_fk')->references('id')->on('g_user_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_cash_desk_movement_pos', function (Blueprint $table) {
            $table->dropForeign('pos_cash_desk_movement_pos_children_pos_cash_movement_egress_type_pos_fk');
            $table->dropForeign('pos_cash_desk_movement_pos_children_pos_cash_movement_ingress_type_pos_fk');
            $table->dropForeign('pos_cash_desk_movement_pos_children_pos_cash_desk_pos_fk');
            $table->dropForeign('pos_cash_desk_movement_pos_children_g_user_pos_fk');

        });
    }
}
