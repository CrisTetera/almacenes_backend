<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhDetailProductReceptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_detail_product_reception', function(Blueprint $table)
		{
			$table->foreign('wh_product_id', 'fk_wh_detail_product_reception_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_reception_id', 'fk_wh_detail_product_reception_wh_product_reception')->references('id')->on('wh_product_reception')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_detail_product_reception', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_detail_product_reception_wh_product');
			$table->dropForeign('fk_wh_detail_product_reception_wh_product_reception');
		});
	}

}
