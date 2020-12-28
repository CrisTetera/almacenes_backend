<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlSaleTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_sale_ticket', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('number', 20)->nullable();
			$table->integer('dte_type_ticket');
			$table->date('emission_date');
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
			$table->integer('sl_service_order_id')->nullable()->index('sl_service_order_sl_sale_ticket_3_fk');
			$table->integer('sl_service_order_id2')->nullable()->index('sl_service_order_sl_sale_ticket_4_fk');
			$table->integer('sl_customer_id')->nullable()->index('sl_sale_ticket_sl_customer_fk');
			$table->integer('g_company_id')->index('sl_sale_ticket_g_company_fk');
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
		Schema::drop('sl_sale_ticket');
	}

}
