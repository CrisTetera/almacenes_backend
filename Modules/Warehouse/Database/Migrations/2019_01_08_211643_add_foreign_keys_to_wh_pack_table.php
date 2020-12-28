<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhPackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_pack', function(Blueprint $table)
		{
			$table->foreign('wh_item_id', 'fk_wh_item_wh_pack')->references('id')->on('wh_item')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_wh_product_children_wh_pack2')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_pack', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_item_wh_pack');
			$table->dropForeign('fk_wh_product_children_wh_pack2');
		});
	}

}
