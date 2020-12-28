<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhTagWhProductPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_tag_wh_product_pos', function (Blueprint $table) {
            $table->integer('wh_product_id')->index('wh_tag_pos_children_wh_product_pos_fk');
			$table->integer('wh_tag_id')->index('wh_tag_pos_children_wh_tag_pos_fk');
			$table->primary(['wh_product_id','wh_tag_id'], 'pk_wh_tag_wh_product_pos');
			$table->unique(['wh_product_id','wh_tag_id'], 'wh_tag_wh_product_pos_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wh_tag_wh_product_pos');
    }
}
