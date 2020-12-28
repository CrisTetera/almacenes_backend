<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToWhDispatchRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_dispatch_request', function (Blueprint $table) {
            $table->foreign('sl_customer_id', 'wh_dispatch_request_sl_customer_fk')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_branch_offices_id', 'wh_dispatch_request_sl_customer_branch_offices_fk')->references('id')->on('sl_customer_branch_offices')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_sale_id', 'wh_dispatch_request_pos_sale_fk')->references('id')->on('pos_sale')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_sale_payment_type_id', 'wh_dispatch_request_pos_sale_payment_type_fk')->references('id')->on('pos_sale_payment_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_state_id', 'wh_dispatch_request_g_state_fk')->references('id')->on('g_state')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_dispatch_request', function (Blueprint $table) {
            $table->dropForeign('wh_dispatch_request_sl_customer_fk');
            $table->dropForeign('wh_dispatch_request_sl_customer_branch_offices_fk');
            $table->dropForeign('wh_dispatch_request_pos_sale_fk');
            $table->dropForeign('wh_dispatch_request_pos_sale_payment_type_fk');
            $table->dropForeign('wh_dispatch_request_g_state_fk');
        });
    }
}
