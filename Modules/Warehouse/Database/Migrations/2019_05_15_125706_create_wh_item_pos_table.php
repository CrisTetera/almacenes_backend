<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhItemPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_item_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_product_id')->index('wh_item_pos_children_wh_product_pos_fk');
			$table->boolean('have_decimal_quantity');
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
        Schema::dropIfExists('wh_item_pos');
    }
}
