<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToWhTagWhProductPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_tag_wh_product_pos', function (Blueprint $table) {
            $table->foreign('wh_tag_id', 'wh_tag_pos_children_wh_tag_pos_fk')->references('id')->on('wh_tag_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'wh_tag_pos_children_wh_product_pos_fk')->references('id')->on('wh_product_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_tag_wh_product_pos', function (Blueprint $table) {
            $table->dropForeign('wh_tag_pos_children_wh_tag_pos_fk');
			$table->dropForeign('wh_tag_pos_children_wh_product_pos_fk');
        });
    }
}
