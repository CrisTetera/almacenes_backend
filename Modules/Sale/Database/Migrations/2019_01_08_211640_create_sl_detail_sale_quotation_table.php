<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlDetailSaleQuotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_detail_sale_quotation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_sale_quotation_id')->index('sl_detail_sale_quotation_sl_sale_quotation_fk');
			$table->integer('wh_product_id')->index('sl_detail_sale_quotation_wh_product_fk');
			$table->integer('quantity');
			$table->integer('price');
			$table->decimal('net_price', 10, 2);
			$table->integer('net_subtotal');
			$table->integer('discount_or_charge_percentage');
			$table->integer('discount_or_charge_value');
			$table->integer('new_net_subtotal');
			$table->integer('total');
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
		Schema::drop('sl_detail_sale_quotation');
	}

}
