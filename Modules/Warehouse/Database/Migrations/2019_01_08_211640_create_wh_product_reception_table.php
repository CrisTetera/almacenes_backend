<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhProductReceptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_product_reception', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_purchase_order_id')->index('wh_product_reception_pch_purchase_order_fk');
			
			$table->integer('number_purchase_invoice')->nullable();
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
		Schema::drop('wh_product_reception');
	}

}
