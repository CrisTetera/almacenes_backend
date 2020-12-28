<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhDetailStockAdjustTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_detail_stock_adjust', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_stock_adjust_id')->index('wh_detail_stock_adjust_wh_stock_adjust_fk');
			$table->integer('wh_item_id')->index('wh_detail_stock_adjust_wh_item_fk');
			$table->decimal('quantity_adjust', 10);
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
		Schema::drop('wh_detail_stock_adjust');
	}

}
