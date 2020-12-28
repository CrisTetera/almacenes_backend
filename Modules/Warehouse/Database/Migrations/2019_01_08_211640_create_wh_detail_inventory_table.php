<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhDetailInventoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_detail_inventory', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_inventory_id')->index('wh_detail_inventory_wh_inventory_fk');
			$table->integer('wh_product_id')->index('wh_detail_inventory_wh_product_fk');
			$table->decimal('expected_amount', 10)->nullable();
			$table->decimal('amount_found', 10)->nullable();
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
		Schema::drop('wh_detail_inventory');
	}

}
