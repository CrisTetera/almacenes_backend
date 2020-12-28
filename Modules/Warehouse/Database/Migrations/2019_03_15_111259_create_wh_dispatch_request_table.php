<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhDispatchRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_dispatch_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sl_customer_id')->index('wh_dispatch_request_sl_customer_fk');
            $table->integer('sl_customer_branch_offices_id')->index('wh_dispatch_request_sl_customer_branch_offices_fk');
            $table->datetime('reception_date');
            $table->integer('pos_sale_id')->index('wh_dispatch_request_pos_sale_fk');
            $table->integer('pos_sale_payment_type_id')->index('wh_dispatch_request_pos_sale_payment_type_fk');
            $table->integer('g_state_id')->index('wh_dispatch_request_g_state_fk');
            $table->boolean('flag_delete')->default(false);

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
        Schema::dropIfExists('wh_dispatch_request');
    }
}
