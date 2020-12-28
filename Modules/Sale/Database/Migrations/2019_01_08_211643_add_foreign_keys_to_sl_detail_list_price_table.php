<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlDetailListPriceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_detail_list_price', function(Blueprint $table)
		{
			$table->foreign('wh_product_id', 'fk_sl_detail_list_price_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_list_price_id', 'fk_sl_list_price_sl_detail_list_price')->references('id')->on('sl_list_price')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_detail_list_price', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_detail_list_price_wh_product');
			$table->dropForeign('fk_sl_list_price_sl_detail_list_price');
		});
	}

}
