<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhDetailProductReceptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_detail_product_reception', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_product_reception_id')->index('wh_detail_product_reception_wh_product_reception_fk');
			$table->integer('wh_product_id')->index('wh_detail_product_reception_wh_product_fk');
			$table->decimal('quantity', 10);
			$table->boolean('complete_reception');
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
		Schema::drop('wh_detail_product_reception');
	}

}
