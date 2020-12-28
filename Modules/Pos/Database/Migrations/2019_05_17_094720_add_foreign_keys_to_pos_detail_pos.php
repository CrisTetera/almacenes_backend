<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPosDetailPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_detail_pos', function (Blueprint $table) {
            $table->foreign('wh_warehouse_id', 'pos_detail_pos_children_wh_warehouse_pos_fk')->references('id')->on('wh_warehouse_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_product_id', 'pos_detail_pos_children_wh_product_pos_fk')->references('id')->on('wh_product_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('pos_sale_id', 'pos_detail_pos_children_pos_sale_pos_fk')->references('id')->on('pos_sale_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_detail_pos', function (Blueprint $table) {
            $table->dropForeign('pos_detail_pos_children_wh_warehouse_pos_fk');
            $table->dropForeign('pos_detail_pos_children_wh_product_pos_fk');
            $table->dropForeign('pos_detail_pos_children_pos_sale_pos_fk');
        });
    }
}
