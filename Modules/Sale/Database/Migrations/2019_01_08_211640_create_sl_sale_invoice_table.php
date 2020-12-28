<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlSaleInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_sale_invoice', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('number', 20);
			$table->integer('dte_type_invoice');
			$table->date('emission_date');
			$table->decimal('net_total', 10);
			$table->decimal('iva', 10);
			$table->decimal('total', 10);
			$table->string('global_discount_type', 20)->nullable();
			$table->string('global_discount_apply_to', 50)->nullable();
			$table->decimal('global_discount_percentage', 10)->nullable();
			$table->decimal('global_discount_amount', 10)->nullable();
			$table->string('document_token', 500)->nullable();
			$table->string('pdf_path', 500)->nullable();
			$table->string('signature_path', 500)->nullable();
			$table->string('xml_path', 500)->nullable();
			$table->boolean('was_replaced')->default(0);
			$table->integer('sl_customer_account_movement_id')->nullable()->index('sl_customer_account_movement_sl_sale_invoice2_fk');
			$table->integer('sl_service_order_id')->nullable()->index('sl_service_order_sl_sale_invoice_3_fk');
			$table->integer('sl_service_order_id2')->nullable()->index('sl_service_order_sl_sale_invoice_4_fk');
			$table->integer('sl_customer_id')->index('sl_sale_invoice_sl_customer_fk');
            $table->integer('sl_customer_branch_offices_id')->nullable()->index('sl_sale_invoice_sl_customer_branch_offices_fk');
            $table->integer('g_company_id')->index('sl_sale_invoice_g_company_fk');
            $table->integer('g_state_id')->index('sl_sale_invoice_g_state_fk');
			$table->boolean('flag_pending_send_dte')->default(0);
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
		Schema::drop('sl_sale_invoice');
	}

}
