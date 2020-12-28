<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlDetailListPriceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_detail_list_price', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_list_price_id')->index('sl_list_price_sl_detail_list_price_fk');
			$table->integer('wh_product_id')->index('sl_detail_list_price_wh_product_fk');
			$table->decimal('sale_price', 10);
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
		Schema::drop('sl_detail_list_price');
	}

}
