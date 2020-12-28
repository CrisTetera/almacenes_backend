<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosEmployeeStockReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_employee_sale_stock_reservation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pos_employee_sale_id')->index('pos_employee_sale_stock_reservation_pos_employee_sale_fk');
            $table->integer('wh_warehouse_id')->index('pos_employee_sale_stock_reservation_wh_warehouse_fk');
            $table->integer('wh_item_id')->index('pos_employee_sale_stock_reservation_wh_item_fk');

            $table->decimal('stock', 10)->nullable();
            $table->boolean('flag_delete')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_employee_stock_reservation');
    }
}
