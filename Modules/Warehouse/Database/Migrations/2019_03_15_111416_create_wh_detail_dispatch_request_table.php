<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhDetailDispatchRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_detail_dispatch_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_dispatch_request_id')->index('wh_detail_dispatch_request_wh_dispatch_request_fk');
            $table->integer('wh_product_id')->index('wh_detail_dispatch_request_wh_product_fk');
            $table->decimal('quantity_requested', 10, 2);
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
        Schema::dropIfExists('wh_detail_dispatch_request');
    }
}
