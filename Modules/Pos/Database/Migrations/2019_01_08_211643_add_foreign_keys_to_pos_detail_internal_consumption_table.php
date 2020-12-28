<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosDetailInternalConsumptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_detail_internal_consumption', function(Blueprint $table)
		{
			$table->foreign('pos_internal_consumption_id', 'fk_pos_detail_internal_consumption_pos_internal_consumption')->references('id')->on('pos_internal_consumption')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_pos_detail_internal_consumption_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_detail_internal_consumption', function(Blueprint $table)
		{
			$table->dropForeign('fk_pos_detail_internal_consumption_pos_internal_consumption');
			$table->dropForeign('fk_pos_detail_internal_consumption_wh_product');
		});
	}

}
