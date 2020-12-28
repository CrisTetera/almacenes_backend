<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhDetailTransferBetweenWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_detail_transfer_between_warehouse', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_transfer_between_warehouse_id')->index('wh_dtil_trnsfr_btwn_wrehse_wh_transfer_between_warehouse_fk');
			$table->integer('wh_product_id')->index('wh_detail_transfer_between_warehouse_wh_product_fk');
            $table->decimal('quantity', 10);
            $table->integer('state')->default(0); // status: 0 => Pendiente, 1 => Recibido, -1 => No Recibido
			$table->boolean('flag_delete')->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wh_detail_transfer_between_warehouse');
	}

}
