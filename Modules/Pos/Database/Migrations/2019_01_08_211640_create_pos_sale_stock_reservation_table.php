<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosSaleStockReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_sale_stock_reservation', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('pos_sale_id')->index('pos_sale_stock_reservation_pos_sale_fk');
            $table->integer('wh_warehouse_id')->index('pos_sale_stock_reservation_wh_warehouse_fk');
            $table->integer('wh_item_id')->index('pos_sale_stock_reservation_wh_item_fk');

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
        Schema::dropIfExists('pos_sale_stock_reservation');
    }
}
