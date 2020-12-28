<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPosSalePos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_sale_pos', function (Blueprint $table) {
            $table->foreign('sl_invoice_id', 'pos_sale_pos_children_sl_invoice_pos_fk')->references('id')->on('sl_invoice_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_ticket_id', 'pos_sale_pos_children_sl_ticket_pos_fk')->references('id')->on('sl_ticket_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_cash_desk_id', 'pos_sale_pos_children_pos_cash_desk_pos_fk')->references('id')->on('pos_cash_desk_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_cashier_id', 'pos_sale_pos_children_g_user_pos_fk')->references('id')->on('g_user_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_state_id', 'pos_sale_pos_children_g_state_pos_fk')->references('id')->on('g_state_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_sale_type_id', 'pos_sale_pos_children_pos_sale_type_pos_fk')->references('id')->on('pos_sale_type_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			//$table->foreign('pos_payment_method_id', 'pos_sale_pos_children_pos_payment_method_pos_fk')->references('id')->on('pos_payment_method_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_id', 'pos_sale_pos_children_sl_customer_pos_fk')->references('id')->on('sl_customer_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_sale_pos', function (Blueprint $table) {
            $table->dropForeign('pos_sale_pos_children_sl_invoice_pos_fk');
            $table->dropForeign('pos_sale_pos_children_sl_ticket_pos_fk');
			$table->dropForeign('pos_sale_pos_children_pos_cash_desk_pos_fk');
			$table->dropForeign('pos_sale_pos_children_g_user_pos_fk');
			$table->dropForeign('pos_sale_pos_children_g_state_pos_fk');
			$table->dropForeign('pos_sale_pos_children_pos_sale_type_pos_fk');
			//$table->dropForeign('pos_sale_pos_children_pos_payment_method_pos_fk');
			$table->dropForeign('pos_sale_pos_children_sl_customer_pos_fk');
        });
    }
}
