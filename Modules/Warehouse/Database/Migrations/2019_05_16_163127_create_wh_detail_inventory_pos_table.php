<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhDetailInventoryPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_detail_inventory_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_inventory_id')->index('wh_detail_inventory_pos_children_wh_inventory_pos_fk');
            $table->integer('wh_product_id')->index('wh_detail_inventory_pos_children_wh_product_pos_fk');
            $table->decimal('expected_amount',10,2);
            $table->decimal('amount_found',10,2);
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
        Schema::dropIfExists('wh_detail_inventory_pos');
    }
}
