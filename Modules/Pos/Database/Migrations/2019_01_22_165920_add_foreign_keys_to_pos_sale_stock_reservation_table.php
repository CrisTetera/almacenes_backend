<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPosSaleStockReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_sale_stock_reservation', function (Blueprint $table) {
            $table->foreign('pos_sale_id', 'fk_pos_sale_stock_reservation_pos_sale')->references('id')->on('pos_sale')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_warehouse_id', 'fk_pos_sale_stock_reservation_wh_warehouse')->references('id')->on('wh_warehouse')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_item_id', 'fk_pos_sale_stock_reservation_wh_item')->references('id')->on('wh_item')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_sale_stock_reservation', function (Blueprint $table) {
            $table->dropForeign('fk_pos_sale_stock_reservation_pos_sale');
            $table->dropForeign('fk_pos_sale_stock_reservation_wh_warehouse');
            $table->dropForeign('fk_pos_sale_stock_reservation_wh_item');
        });
    }
}
