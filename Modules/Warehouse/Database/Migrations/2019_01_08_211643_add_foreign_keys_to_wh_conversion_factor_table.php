<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhConversionFactorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_conversion_factor', function(Blueprint $table)
		{
			$table->foreign('wh_unit_of_measurement_id', 'fk_wh_conversion_factor_wh_unit_of_measurement_1')->references('id')->on('wh_unit_of_measurement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_unit_of_measurement_id2', 'fk_wh_conversion_factor_wh_unit_of_measurement_2')->references('id')->on('wh_unit_of_measurement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_conversion_factor', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_conversion_factor_wh_unit_of_measurement_1');
			$table->dropForeign('fk_wh_conversion_factor_wh_unit_of_measurement_2');
		});
	}

}
