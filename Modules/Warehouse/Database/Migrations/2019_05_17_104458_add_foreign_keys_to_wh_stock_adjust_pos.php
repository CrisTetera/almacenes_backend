<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToWhStockAdjustPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_stock_adjust_pos', function (Blueprint $table) {
            $table->foreign('wh_inventory_id', 'wh_stock_adjust_pos_children_pos_wh_inventory_pos_fk')->references('id')->on('wh_inventory_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('g_user_id', 'wh_stock_adjust_pos_children_pos_g_user_pos_fk')->references('id')->on('g_user_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_warehouse_id', 'wh_stock_adjust_pos_children_pos_wh_warehouse_pos_fk')->references('id')->on('wh_warehouse_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_stock_adjust_type_id', 'wh_stock_adjust_pos_children_pos_wh_stock_adjust_type_pos_fk')->references('id')->on('wh_stock_adjust_type_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_stock_adjust_pos', function (Blueprint $table) {
            $table->dropForeign('wh_stock_adjust_pos_children_pos_wh_inventory_pos_fk');
            $table->dropForeign('wh_stock_adjust_pos_children_pos_g_user_pos_fk');
            $table->dropForeign('wh_stock_adjust_pos_children_pos_wh_warehouse_pos_fk');
            $table->dropForeign('wh_stock_adjust_pos_children_pos_wh_stock_adjust_type_pos_fk');
            
        });
    }
}
