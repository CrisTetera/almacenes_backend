<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToWhProductUpcCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_product_upc_code', function (Blueprint $table) {
            $table->foreign('wh_product_id', 'fk_wh_product_upc_code_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_product_upc_code', function (Blueprint $table) {
            $table->dropForeign('fk_wh_product_upc_code_wh_product');
        });
    }
}
