<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhPromoWhProductPromoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_promo_wh_product_promo', function(Blueprint $table)
		{
			$table->integer('wh_product_id')->index('wh_promo_wh_product_promo2_fk');
			$table->integer('wh_promo_id')->index('wh_promo_wh_product_promo_fk');
			$table->integer('quantity')->default(1);
			$table->unique(['wh_product_id','wh_promo_id'], 'wh_promo_wh_product_promo_pk');
			$table->primary(['wh_product_id','wh_promo_id'], 'pk_wh_promo_wh_product_promo');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wh_promo_wh_product_promo');
	}

}
