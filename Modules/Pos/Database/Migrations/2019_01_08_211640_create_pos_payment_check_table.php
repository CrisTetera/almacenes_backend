<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosPaymentCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_payment_check', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pos_sale_payment_type_id')->nullable()->index('pos_payment_check_pos_sale_payment_type_fk');
            $table->integer('pos_sale_id')->nullable()->index('pos_payment_check_pos_sale_pos_payment_type_fk');
            $table->integer('pos_payment_check_type_id')->nullable()->index('pos_payment_check_pos_payment_check_type_fk');
            $table->integer('g_bank_id')->nullable()->index('pos_payment_check_g_bank_fk');
            $table->string('serial_number', 40);
            $table->integer('account_number');
            $table->integer('plaza');
            $table->integer('amount');
            $table->dateTime('emission_date');
            $table->date('charge_date')->nullable();
            $table->boolean('flag_delete', false);
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
        Schema::dropIfExists('pos_payment_check');
    }
}
