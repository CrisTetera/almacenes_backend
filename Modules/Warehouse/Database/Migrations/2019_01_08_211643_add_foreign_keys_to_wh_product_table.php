<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_product', function(Blueprint $table)
		{
			$table->foreign('wh_item_id', 'fk_wh_product_children_wh_item')->references('id')->on('wh_item')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_pack_id', 'fk_wh_product_children_wh_pack')->references('id')->on('wh_pack')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_packing_id', 'fk_wh_product_children_wh_packing')->references('id')->on('wh_packing')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_promo_id', 'fk_wh_product_children_wh_promo')->references('id')->on('wh_promo')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_subfamily_id', 'fk_wh_subfamily_wh_product')->references('id')->on('wh_subfamily')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_product', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_product_children_wh_item');
			$table->dropForeign('fk_wh_product_children_wh_pack');
			$table->dropForeign('fk_wh_product_children_wh_packing');
			$table->dropForeign('fk_wh_product_children_wh_promo');
			$table->dropForeign('fk_wh_subfamily_wh_product');
		});
	}

}
