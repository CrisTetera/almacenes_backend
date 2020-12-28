<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPosPaymentElectronicTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_payment_electronic_transfer', function (Blueprint $table) {
            $table->foreign('pos_sale_payment_type_id', 'fk_pos_payment_electronic_transfer_pos_sale_payment_type')->references('id')->on('pos_sale_payment_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('pos_sale_id', 'fk_pos_payment_electronic_transfer_pos_sale')->references('id')->on('pos_sale')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_payment_electronic_transfer', function (Blueprint $table) {
            $table->dropForeign('fk_pos_payment_electronic_transfer_pos_sale_payment_type');
            $table->dropForeign('fk_pos_payment_electronic_transfer_pos_sale');
        });
    }
}
