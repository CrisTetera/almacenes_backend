<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchPurchaseOrderWhOrdererTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_purchase_order_wh_orderer', function(Blueprint $table)
		{
			$table->integer('wh_orderer_id')->index('pch_purchase_order_wh_orderer2_fk');
			$table->integer('pch_purchase_order_id')->index('pch_purchase_order_wh_orderer_fk');
			$table->primary(['wh_orderer_id','pch_purchase_order_id'], 'pk_pch_purchase_order_wh_orderer');
			$table->unique(['wh_orderer_id','pch_purchase_order_id'], 'pch_purchase_order_wh_orderer_pk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pch_purchase_order_wh_orderer');
	}

}
