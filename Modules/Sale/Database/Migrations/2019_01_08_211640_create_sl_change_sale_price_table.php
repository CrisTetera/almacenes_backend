<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlChangeSalePriceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_change_sale_price', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_product_id')->index('sl_change_sale_price_wh_product_fk');
			$table->decimal('old_sale_price', 10);
			$table->decimal('new_sale_price', 10);
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
		Schema::drop('sl_change_sale_price');
	}

}
