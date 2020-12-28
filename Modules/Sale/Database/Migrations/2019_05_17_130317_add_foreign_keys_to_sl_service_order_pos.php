<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlServiceOrderPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_service_order_pos', function (Blueprint $table) {
            $table->foreign('cashier_user_id' , 'sl_service_order_pos_children_g_user_pos_fk')->references('id')->on('g_user_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sl_invoice_id' , 'sl_service_order_pos_children_sl_invoice_pos_fk')->references('id')->on('sl_invoice_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sl_invoice_id2' , 'sl_service_order_pos_children_sl_invoice2_pos_fk')->references('id')->on('sl_invoice_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sl_ticket_id' , 'sl_service_order_pos_children_sl_ticket_pos_fk')->references('id')->on('sl_ticket_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sl_ticket_id' , 'sl_service_order_pos_children_sl_ticket2_pos_fk')->references('id')->on('sl_ticket_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            //$table->foreign('sl_credit_note_id' , 'sl_service_order_pos_children_sl_credit_note_pos_fk')->references('id')->on('sl_credit_note_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sl_service_order_type_id' , 'sl_service_order_pos_children_sl_service_order_type_pos_fk')->references('id')->on('sl_service_order_type_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_service_order_pos', function (Blueprint $table) {
            $table->dropForeign('sl_service_order_pos_children_g_user_pos_fk');
            $table->dropForeign('sl_service_order_pos_children_sl_invoice_pos_fk');
            $table->dropForeign('sl_service_order_pos_children_sl_invoice2_pos_fk');
            $table->dropForeign('sl_service_order_pos_children_sl_ticket_pos_fk');
            $table->dropForeign('sl_service_order_pos_children_sl_ticket2_pos_fk');
            //$table->dropForeign('sl_service_order_pos_children_sl_credit_note_pos_fk');
            $table->dropForeign('sl_service_order_pos_children_sl_service_order_type_pos_fk');
        });
    }
}
