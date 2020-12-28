<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhDetailInventoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_detail_inventory', function(Blueprint $table)
		{
			$table->foreign('wh_inventory_id', 'fk_wh_detail_inventory_wh_inventory')->references('id')->on('wh_inventory')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'wh_detail_inventory_wh_product_fk')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_detail_inventory', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_detail_inventory_wh_inventory');
			$table->dropForeign('wh_detail_inventory_wh_product_fk');
		});
	}

}
