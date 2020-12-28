<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosSaleStockReservationPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_sale_stock_reservation_pos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('pos_sale_id')->index('pos_sale_stock_reservation_pos_children_pos_sale_pos_fk');
            $table->integer('wh_warehouse_id')->index('pos_sale_stock_reservation_pos_children_wh_warehouse_pos_fk');
            $table->integer('wh_item_id')->index('pos_sale_stock_reservation_pos_children_wh_item_pos_fk');

            $table->decimal('stock', 10)->nullable();
            $table->boolean('flag_delete')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_sale_stock_reservation_pos');
    }
}
