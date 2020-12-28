<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToWhItemStockPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_item_stock_pos', function (Blueprint $table) {
            $table->foreign('wh_item_id', 'wh_item_stock_children_wh_item_pos_fk')->references('id')->on('wh_item_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_warehouse_id', 'wh_item_stock_children_wh_warehouse_pos_fk')->references('id')->on('wh_warehouse_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_item_stock:pos', function (Blueprint $table) {
            $table->dropForeign('fk_wh_warehouse_item_wh_item');
			$table->dropForeign('fk_wh_warehouse_item_wh_warehouse');
        });
    }
}
