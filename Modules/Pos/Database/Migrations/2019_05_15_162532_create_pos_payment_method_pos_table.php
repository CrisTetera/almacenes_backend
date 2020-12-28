<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosPaymentMethodPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_payment_method_pos', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('pos_sale_id')->index('pos_payment_method_pos_children_pos_sale_pos_fk');
            $table->integer('pos_type_payment_method_id')->index('pos_payment_method_pos_children_pos_type_payment_method_pos_fk');
            $table->integer('amount_payment');
            $table->integer('rounding_law')->nullable();
            $table->integer('transfer_number')->nullable();
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
        Schema::dropIfExists('pos_payment_method_pos');
    }
}
