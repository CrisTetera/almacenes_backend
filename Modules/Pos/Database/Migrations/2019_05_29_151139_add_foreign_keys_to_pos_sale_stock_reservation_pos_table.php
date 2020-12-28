<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPosSaleStockReservationPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_sale_stock_reservation_pos', function (Blueprint $table) {
            $table->foreign('pos_sale_id', 'pos_sale_stock_reservation_pos_children_pos_sale_pos_fk')->references('id')->on('pos_sale_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_warehouse_id','pos_sale_stock_reservation_pos_children_wh_warehouse_pos_fk')->references('id')->on('wh_warehouse_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('wh_item_id', 'pos_sale_stock_reservation_pos_children_wh_item_pos_fk')->references('id')->on('wh_item_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_sale_stock_reservation_pos', function (Blueprint $table) {
            $table->dropForeign('pos_sale_stock_reservation_pos_children_pos_sale_pos_fk');
            $table->dropForeign('pos_sale_stock_reservation_pos_children_wh_warehouse_pos_fk');
            $table->dropForeign('pos_sale_stock_reservation_pos_children_wh_item_pos_fk');
        });
    }
}
