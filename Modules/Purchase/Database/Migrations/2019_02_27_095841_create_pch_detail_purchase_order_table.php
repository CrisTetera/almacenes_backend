<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePchDetailPurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pch_detail_purchase_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pch_purchase_order_id')->index('pch_detail_purchase_order_pch_purchase_order_fk');
            $table->string('provider_product_code', 20)->default('');
            $table->integer('wh_product_id')->index('pch_detail_purchase_order_wh_product_fk');
            $table->integer('quantity');
            $table->decimal('net_price', 10, 2);
            $table->integer('net_total');
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
        Schema::dropIfExists('pch_detail_purchase_order');
    }
}
