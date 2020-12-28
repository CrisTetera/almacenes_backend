<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPosPaymentMethodPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_payment_method_pos', function (Blueprint $table) {
            $table->foreign('pos_sale_id' , 'pos_payment_method_pos_children_pos_sale_pos_fk')->references('id')->on('pos_sale_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('pos_type_payment_method_id' , 'pos_payment_method_pos_children_pos_type_payment_method_pos_fk')->references('id')->on('pos_type_payment_method_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_payment_method_pos', function (Blueprint $table) {
            $table->dropForeign('pos_payment_method_pos_children_pos_sale_pos_fk');
            $table->dropForeign('pos_payment_method_pos_children_pos_type_payment_method_pos_fk');
        });
    }
}
