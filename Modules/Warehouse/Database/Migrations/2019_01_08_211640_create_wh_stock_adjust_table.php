<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhStockAdjustTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_stock_adjust', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_inventory_id')->index('wh_stock_adjust_wh_inventory_fk');
			$table->integer('g_user_id')->index('wh_stock_adjust_g_user_fk');
			$table->integer('wh_warehouse_id')->index('wh_warehouse_wh_stock_adjust_fk');
			$table->integer('wh_stock_adjust_type_id')->index('wh_stock_adjust_wh_stock_adjust_fk');
			$table->string('description', 500);
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
		Schema::drop('wh_stock_adjust');
	}

}
