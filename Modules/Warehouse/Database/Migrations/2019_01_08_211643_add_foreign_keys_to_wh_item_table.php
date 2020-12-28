<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_item', function(Blueprint $table)
		{
			$table->foreign('wh_product_id', 'fk_wh_product_children_wh_item2')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_unit_of_measurement_id', 'fk_wh_product_wh_unit_of_measurement')->references('id')->on('wh_unit_of_measurement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_item', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_product_children_wh_item2');
			$table->dropForeign('fk_wh_product_wh_unit_of_measurement');
		});
	}

}
