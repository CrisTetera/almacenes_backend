<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhDetailTransferBetweenWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_detail_transfer_between_warehouse', function(Blueprint $table)
		{
			$table->foreign('wh_product_id', 'fk_wh_detail_transfer_between_warehouse_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_transfer_between_warehouse_id', 'fk_wh_dtl_trnsfr_btwn_warehouse_wh_transfer_between_warehouse')->references('id')->on('wh_transfer_between_warehouse')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_detail_transfer_between_warehouse', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_detail_transfer_between_warehouse_wh_product');
			$table->dropForeign('fk_wh_dtl_trnsfr_btwn_warehouse_wh_transfer_between_warehouse');
		});
	}

}
