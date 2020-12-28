<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlWholesaleDiscountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_wholesale_discount', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_product_id')->index('sl_wholesale_discount_wh_product_fk');
			$table->integer('g_branch_office_id')->index('sl_wholesale_discount_g_branch_office_fk');
			$table->integer('quantity_discount');
			$table->integer('unit_price_discount');
			$table->integer('percentage_discount');
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
		Schema::drop('sl_wholesale_discount');
	}

}
