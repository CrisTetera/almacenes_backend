<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhProductUpcCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_product_upc_code', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_product_id')->nullable()->index('wh_product_upc_code_wh_product_fk');
            $table->string('upc_code', 20);
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
        Schema::dropIfExists('wh_product_upc_code');
    }
}
