<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhDetailStockAdjustTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_detail_stock_adjust', function(Blueprint $table)
		{
			$table->foreign('wh_item_id', 'fk_wh_detail_stock_adjust_wh_item')->references('id')->on('wh_item')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_stock_adjust_id', 'fk_wh_detail_stock_adjust_wh_stock_adjust')->references('id')->on('wh_stock_adjust')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_detail_stock_adjust', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_detail_stock_adjust_wh_item');
			$table->dropForeign('fk_wh_detail_stock_adjust_wh_stock_adjust');
		});
	}

}
