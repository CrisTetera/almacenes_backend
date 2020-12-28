<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosSaleInvoiceDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_sale_invoice_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pos_sale_id')->index('pos_sale_invoice_data_pos_sale_fk');
            $table->integer('purchase_order')->default(0);
            $table->boolean('flag_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_sale_invoice_data');
    }
}
