<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToWhDetailDispatchRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_detail_dispatch_request', function (Blueprint $table) {
            $table->foreign('wh_dispatch_request_id', 'wh_detail_dispatch_request_wh_dispatch_request_fk')->references('id')->on('wh_dispatch_request')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_product_id', 'wh_detail_dispatch_request_wh_product_fk')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_detail_dispatch_request', function (Blueprint $table) {
            $table->dropForeign('wh_detail_dispatch_request_wh_dispatch_request_fk');
            $table->dropForeign('wh_detail_dispatch_request_wh_product_fk');
        });
    }
}
