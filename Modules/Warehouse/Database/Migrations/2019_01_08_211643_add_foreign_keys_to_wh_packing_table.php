<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhPackingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_packing', function(Blueprint $table)
		{
			$table->foreign('wh_product_id', 'fk_wh_product_children_wh_packing2')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_content_id', 'fk_wh_product_content_wh_packing2')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_packing', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_product_children_wh_packing2');
			$table->dropForeign('fk_wh_product_content_wh_packing2');
		});
	}

}
