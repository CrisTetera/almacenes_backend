<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhTagWhProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_tag_wh_product', function(Blueprint $table)
		{
			$table->foreign('wh_tag_id', 'fk_wh_tag_wh_product')->references('id')->on('wh_tag')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_wh_tag_wh_product2')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_tag_wh_product', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_tag_wh_product');
			$table->dropForeign('fk_wh_tag_wh_product2');
		});
	}

}
