<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlTicketPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_ticket_pos', function (Blueprint $table) {
            $table->foreign('sl_customer_id', 'sl_ticket_pos_children_sl_customer_pos_fk')->references('id')->on('sl_customer_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sl_service_order_id' , 'sl_ticket_pos_children_sl_service_order_pos_fk')->references('id')->on('sl_service_order_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sl_service_order_id2' , 'sl_ticket_pos_children_sl_service_order_pos_fk2')->references('id')->on('sl_service_order_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('g_company_id', 'sl_ticket_pos_children_g_company_pos_fk')->references('id')->on('g_company_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_ticket_pos', function (Blueprint $table) {
            $table->dropForeign('sl_ticket_pos_children_sl_customer_pos_fk');
            $table->dropForeign('sl_ticket_pos_children_sl_service_order_pos_fk');
            $table->dropForeign('sl_ticket_pos_children_sl_service_order_pos_fk2');
            $table->dropForeign('sl_ticket_pos_children_g_company_pos_fk');

        });
    }
}
