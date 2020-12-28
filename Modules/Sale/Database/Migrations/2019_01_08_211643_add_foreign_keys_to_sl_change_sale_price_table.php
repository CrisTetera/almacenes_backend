<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlChangeSalePriceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_change_sale_price', function(Blueprint $table)
		{
			$table->foreign('wh_product_id', 'fk_sl_change_sale_price_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_change_sale_price', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_change_sale_price_wh_product');
		});
	}

}
