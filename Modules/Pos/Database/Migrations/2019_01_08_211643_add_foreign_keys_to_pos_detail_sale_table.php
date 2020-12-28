<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosDetailSaleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_detail_sale', function(Blueprint $table)
		{
			$table->foreign('pos_sale_id', 'fk_pos_detail_sale_pos_sale')->references('id')->on('pos_sale')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_warehouse_id', 'fk_pos_detail_sale_wh_warehouse')->references('id')->on('wh_warehouse')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_pos_detail_sale_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_detail_sale', function(Blueprint $table)
		{
			$table->dropForeign('fk_pos_detail_sale_pos_sale');
			$table->dropForeign('fk_pos_detail_sale_wh_warehouse');
			$table->dropForeign('fk_pos_detail_sale_wh_product');
		});
	}

}
