<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlSaleQuotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_sale_quotation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('number', 20);
			$table->date('emission_date');
			$table->integer('sl_customer_id')->index('sl_sale_quotation_sl_customer_fk');
            $table->integer('sl_customer_branch_offices_id')->nullable()->index('sl_customer_branch_offices_sl_sale_quotation_fk');
            $table->integer('net_subtotal');
			$table->integer('discount_or_charge_percentage');
			$table->integer('new_net_subtotal');
			$table->integer('exent_total');
			$table->integer('iva');
			$table->integer('ticket_total');
			$table->integer('invoice_total');
			$table->integer('pos_sale_type_id')->nullable()->index('sl_sale_quotation_pos_sale_type_fk');
			$table->integer('g_user_id')->nullable()->index('sl_sale_quotation_g_user_fk');
			$table->integer('g_branch_office_id')->nullable()->index('sl_sale_quotation_g_branch_office_fk');
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
		Schema::drop('sl_sale_quotation');
	}

}
