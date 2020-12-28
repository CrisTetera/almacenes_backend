<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosSalePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_sale_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sl_invoice_id')->nullable()->index('pos_sale_pos_children_sl_invoice_pos_fk');
            $table->integer('sl_ticket_id')->nullable()->index('pos_sale_pos_children_sl_ticket_pos_fk');
            $table->integer('pos_cash_desk_id')->nullable()->index('pos_sale_pos_children_pos_cash_desk_pos_fk'); //quitar nullable
            $table->integer('g_cashier_id')->nullable()->index('pos_sale_pos_children_g_user_pos_fk'); //quitar nullable
            $table->integer('g_state_id')->nullable()->index('pos_sale_pos_children_g_state_pos_fk'); //quitar nullable
            $table->datetime('close_sale_datetime')->nullable();
            $table->integer('pos_sale_type_id')->nullable()->index('pos_sale_pos_children_pos_sale_type_pos_fk'); //quitar nullable
            //$table->integer('pos_payment_method_id')->index('pos_sale_pos_children_pos_payment_method_pos_fk');
            $table->integer('sl_customer_id')->nullable()->index('pos_sale_pos_children_sl_customer_pos_fk');
            $table->integer('net_subtotal');
			$table->integer('global_discount_amount')->default(0);
			$table->integer('global_discount_percentage')->default(0);
			$table->integer('new_net_subtotal');
			$table->integer('exempt_total');
			$table->integer('iva');
            $table->integer('ticket_total');
            $table->integer('invoice_total');
            $table->integer('rounding_law')->default(0);
			$table->boolean('flag_delete');
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
        Schema::dropIfExists('pos_sale_pos');
    }
}
