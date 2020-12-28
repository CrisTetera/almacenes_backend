<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhConversionFactorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_conversion_factor', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_unit_of_measurement_id')->index('wh_conversion_factor_wh_unit_of_measurement_1_fk');
			$table->integer('wh_unit_of_measurement_id2')->index('wh_conversion_factor_wh_unit_of_measurement_2_fk');
			$table->decimal('conversion_factor', 10)->nullable();
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
		Schema::drop('wh_conversion_factor');
	}

}
