<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPosSaleInvoiceDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_sale_invoice_data', function (Blueprint $table) {
            $table->foreign('pos_sale_id', 'fk_pos_sale_invoice_data_pos_sale')->references('id')->on('pos_sale')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_sale_invoice_data', function (Blueprint $table) {
            $table->dropForeign('fk_pos_sale_invoice_data_pos_sale');
        });
    }
}
