<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlCustomerGroundSellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_customer_ground_seller', function (Blueprint $table) {
            $table->integer('sl_customer_id')->index('sl_customer_ground_seller_sl_customer_fk');
            $table->integer('sl_ground_seller_id')->index('sl_customer_ground_seller_sl_ground_seller_fk');
			$table->primary(['sl_customer_id','sl_ground_seller_id'], 'pk_sl_customer_ground_seller');
			$table->unique(['sl_customer_id','sl_ground_seller_id'], 'sl_customer_ground_seller_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sl_customer_ground_seller');
    }
}
