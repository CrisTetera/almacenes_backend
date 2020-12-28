<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlServiceOrderPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_service_order_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cashier_user_id')->index('sl_service_order_pos_children_g_user_pos_fk');
            $table->integer('sl_invoice_id')->index('sl_service_order_pos_children_sl_invoice_pos_fk');
            $table->integer('sl_invoice_id2')->index('sl_service_order_pos_children_sl_invoice2_pos_fk');
            $table->integer('sl_ticket_id')->index('sl_service_order_pos_children_sl_ticket_pos_fk');
            $table->integer('sl_ticket_id2')->index('sl_service_order_pos_children_sl_ticket2_pos_fk');
            //$table->integer('sl_credit_note_id')->index('sl_service_order_pos_children_sl_credit_note_pos_fk');
            $table->integer('sl_service_order_type_id')->index('sl_service_order_pos_children_sl_service_order_type_pos_fk');
            $table->string('comment');
            $table->boolean('flag_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sl_service_order_pos');
    }
}
