<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlServiceOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_service_order', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_seller_user_id')->nullable()->index('sl_service_order_g_user_id_seller_fk');
			$table->integer('g_supervisor_user_id')->nullable()->index('sl_service_order_g_user_id_supervisor_fk');
			$table->integer('sl_sale_invoice_id')->nullable()->index('sl_service_order_sl_sale_invoice_1_fk');
			$table->integer('sl_sale_invoice_id2')->nullable()->index('sl_service_order_sl_sale_invoice_2_fk');
			$table->integer('sl_sale_ticket_id')->nullable()->index('sl_service_order_sl_sale_ticket_1_fk');
			$table->integer('sl_sale_ticket_id2')->nullable()->index('sl_service_order_sl_sale_ticket_2_fk');
			$table->integer('sl_sale_credit_note_id')->nullable()->index('sl_service_order_sl_sale_credit_note_fk');
			$table->integer('sl_service_order_type_id')->nullable()->index('sl_service_order_sl_service_order_type_fk');
			$table->string('comment', 500);
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
		Schema::drop('sl_service_order');
	}

}
