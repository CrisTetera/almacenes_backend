<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlOfferPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_offer_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_product_id')->index('sl_offer_pos_children_wh_product_pos_fk');
            $table->string('name', 100);
            $table->integer('offer_price');
            $table->date('init_datetime');
            $table->date('finish_datetime');
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
        Schema::dropIfExists('sl_offer_pos');
    }
}
