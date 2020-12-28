<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchPurchaseOrderWhOrdererTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_purchase_order_wh_orderer', function(Blueprint $table)
		{
			$table->foreign('pch_purchase_order_id', 'fk_pch_purchase_order_wh_orderer')->references('id')->on('pch_purchase_order')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_orderer_id', 'fk_pch_purchase_order_wh_orderer2')->references('id')->on('wh_orderer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_purchase_order_wh_orderer', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_purchase_order_wh_orderer');
			$table->dropForeign('fk_pch_purchase_order_wh_orderer2');
		});
	}

}
