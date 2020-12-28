<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_item', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_product_id')->nullable()->index('wh_product_children_wh_item2_fk');
			$table->integer('wh_unit_of_measurement_id')->nullable()->index('wh_product_wh_unit_of_measurement_fk');
			$table->decimal('uom_quantity', 10);
			$table->boolean('is_inventoriable');
			$table->boolean('have_decimal_quantity');
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
		Schema::drop('wh_item');
	}

}
