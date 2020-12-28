<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosPaymentElectronicTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_payment_electronic_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pos_sale_payment_type_id')->nullable()->index('pos_payment_electronic_transfer_pos_sale_payment_type_fk');
            $table->integer('pos_sale_id')->nullable()->index('pos_payment_electronic_transfer_pos_sale_pos_payment_type_fk');
            $table->integer('transfer_number');
            $table->boolean('flag_delete', false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_payment_electronic_transfer');
    }
}
