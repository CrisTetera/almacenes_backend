<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhProductReceptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_product_reception', function(Blueprint $table)
		{
			$table->foreign('pch_purchase_order_id', 'fk_wh_product_reception_pch_purchase_order')->references('id')->on('pch_purchase_order')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_product_reception', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_product_reception_pch_purchase_order');
		});
	}

}
