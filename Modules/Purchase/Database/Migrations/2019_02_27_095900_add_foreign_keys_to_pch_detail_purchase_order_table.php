<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPchDetailPurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pch_detail_purchase_order', function (Blueprint $table) {
            $table->foreign('pch_purchase_order_id', 'fk_pch_detail_purchase_order_pch_purchase_order')->references('id')->on('pch_purchase_order')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_pch_detail_purchase_order_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pch_detail_purchase_order', function (Blueprint $table) {
            $table->dropForeign('fk_pch_detail_purchase_order_pch_purchase_order');
            $table->dropForeign('fk_pch_detail_purchase_order_wh_product');
        });
    }
}
