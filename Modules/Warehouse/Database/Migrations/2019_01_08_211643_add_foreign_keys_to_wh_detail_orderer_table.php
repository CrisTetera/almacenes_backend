<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhDetailOrdererTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_detail_orderer', function(Blueprint $table)
		{
			$table->foreign('wh_orderer_id', 'fk_wh_detail_orderer_wh_orderer')->references('id')->on('wh_orderer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_wh_detail_orderer_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_detail_orderer', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_detail_orderer_wh_orderer');
			$table->dropForeign('fk_wh_detail_orderer_wh_product');
		});
	}

}
