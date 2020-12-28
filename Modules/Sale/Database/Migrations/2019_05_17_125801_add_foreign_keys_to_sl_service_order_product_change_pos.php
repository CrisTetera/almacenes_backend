<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlServiceOrderProductChangePos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_service_order_product_change_pos', function (Blueprint $table) {
            $table->foreign('sl_service_order_id' , 'sl_service_order_product_change_pos_children_sl_service_order_pos_fk')->references('id')->on('sl_service_order_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_product_id' , 'sl_service_order_product_change_pos_children_wh_product_pos_fk')->references('id')->on('wh_product_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_service_order_product_change_pos', function (Blueprint $table) {
            $table->foreign('sl_service_order_product_change_pos_children_sl_service_order_pos_fk');
            $table->foreign('sl_service_order_product_change_pos_children_wh_product_pos_fk');
        });
    }
}
