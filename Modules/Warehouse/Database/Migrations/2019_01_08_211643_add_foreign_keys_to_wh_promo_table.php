<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhPromoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_promo', function(Blueprint $table)
		{
			$table->foreign('wh_product_id', 'fk_wh_product_children_wh_promo2')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_promo', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_product_children_wh_promo2');
		});
	}

}
