<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlCustomerGroundSellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_customer_ground_seller', function (Blueprint $table) {
            $table->foreign('sl_customer_id', 'fk_sl_customer_ground_seller_sl_customer')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sl_ground_seller_id', 'fk_sl_customer_ground_seller_sl_ground_seller')->references('id')->on('sl_ground_seller')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_customer_ground_seller', function (Blueprint $table) {
            $table->dropForeign('fk_sl_customer_ground_seller_sl_customer');
            $table->dropForeign('fk_sl_customer_ground_seller_sl_ground_seller');
        });
    }
}
