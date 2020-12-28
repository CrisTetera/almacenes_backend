<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlServiceOrderProductChangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_service_order_product_change', function (Blueprint $table) {
            $table->foreign('sl_service_order_id', 'fk_sl_service_order_product_change_sl_service_order')->references('id')->on('sl_service_order')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_sl_service_order_product_change_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_service_order_product_change', function (Blueprint $table) {
            $table->dropForeign('fk_sl_service_order_product_change_service_order');
            $table->dropForeign('fk_sl_service_order_product_change_wh_product');
        });
    }
}
