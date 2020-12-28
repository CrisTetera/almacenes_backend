<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlInvoicePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_invoice_pos', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('invoice_number', 20);
            $table->integer('dte_type_invoice');
			$table->date('emission_date');
			$table->decimal('net_total', 10);
			$table->decimal('iva', 10);
            $table->decimal('total', 10);
            $table->string('global_discount_type', 20)->nullable();
			$table->string('global_discount_apply_to', 50)->nullable();
            $table->decimal('global_discount_percentage', 10)->nullable();
            $table->integer('g_company_id')->index('sl_invoice_pos_children_g_company_pos_fk');
            $table->integer('sl_customer_id')->index('sl_invoice_pos_children_sl_customer_pos_fk');
			$table->string('document_token', 500)->nullable();
			$table->string('pdf_path', 500)->nullable();
			$table->string('signature_path', 500)->nullable();
			$table->string('xml_path', 500)->nullable();
            $table->boolean('was_replaced')->default(0);
            $table->integer('sl_service_order_id')->nullable()->index('sl_invoice_pos_children_sl_service_order_pos_fk');
			$table->integer('sl_service_order_id2')->nullable()->index('sl_invoice_pos_children_sl_service_order_pos_fk2');
            $table->boolean('flag_pending_send_dte')->default(0);
            $table->integer('g_state_id')->index('sl_invoice_pos_children_g_state_pos_fk');
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
        Schema::dropIfExists('sl_invoice_pos');
    }
}
