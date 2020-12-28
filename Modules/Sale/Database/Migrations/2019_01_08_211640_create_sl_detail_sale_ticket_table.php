<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlDetailSaleTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_detail_sale_ticket', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_sale_ticket_id')->index('sl_sale_ticket_sl_detail_sale_ticket_fk');
			$table->integer('line_number');
			$table->integer('wh_product_id')->index('sl_detail_sale_ticket_wh_product_fk');
			$table->decimal('quantity', 10);
			$table->decimal('price', 10);
			$table->decimal('discount_or_charge_percentage', 10)->default(0);
			$table->decimal('discount_or_charge_value', 10)->default(0);
			$table->decimal('subtotal', 10);
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
		Schema::drop('sl_detail_sale_ticket');
	}

}
