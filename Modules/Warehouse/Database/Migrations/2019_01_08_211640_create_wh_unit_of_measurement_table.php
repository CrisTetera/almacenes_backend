<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhUnitOfMeasurementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_unit_of_measurement', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('unity_symbol', 20);
			$table->string('name');
			$table->boolean('minimun_unit');
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
		Schema::drop('wh_unit_of_measurement');
	}

}
