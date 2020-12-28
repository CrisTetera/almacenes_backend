<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhWarehouseItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_warehouse_item', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_warehouse_id')->index('wh_warehouse_item_wh_warehouse_fk');
			$table->integer('wh_item_id')->index('wh_warehouse_item_wh_item_fk');
			$table->decimal('stock', 10)->nullable();
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
		Schema::drop('wh_warehouse_item');
	}

}
