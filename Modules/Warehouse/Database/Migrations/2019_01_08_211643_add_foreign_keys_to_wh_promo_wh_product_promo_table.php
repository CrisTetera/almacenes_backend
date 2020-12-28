<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhPromoWhProductPromoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_promo_wh_product_promo', function(Blueprint $table)
		{
			$table->foreign('wh_promo_id', 'fk_wh_promo_wh_product_promo')->references('id')->on('wh_promo')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_wh_promo_wh_product_promo2')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_promo_wh_product_promo', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_promo_wh_product_promo');
			$table->dropForeign('fk_wh_promo_wh_product_promo2');
		});
	}

}
