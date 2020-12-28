<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhStockMovementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_stock_movement', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_item_id')->index('wh_stock_movement_wh_item_fk');
			$table->integer('wh_warehouse_id')->index('wh_stock_movement_wh_warehouse_fk');
			$table->integer('wh_warehouse_movement_id')->index('wh_stock_movement_wh_warehouse_movement_fk');
			$table->integer('wh_product_id')->index('wh_stock_movement_wh_product_fk');
			$table->decimal('quantity', 10, 2);
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
		Schema::drop('wh_stock_movement');
	}

}
