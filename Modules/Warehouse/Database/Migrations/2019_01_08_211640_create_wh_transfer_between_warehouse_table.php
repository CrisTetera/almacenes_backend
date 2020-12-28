<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhTransferBetweenWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_transfer_between_warehouse', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_from_warehouse_id')->index('wh_transfer_between_warehouse_wh_warehouse_origin_fk');
            $table->integer('g_from_supervisor_id')->index('wh_transfer_between_warehouse_g_from_supervisor_id_fk');
            $table->integer('wh_to_warehouse_id')->index('wh_transfer_between_warehouse_wh_warehouse_destination_fk');
            $table->integer('g_to_supervisor_id')->nullable()->index('wh_transfer_between_warehouse_g_to_supervisor_id_fk');
            $table->integer('wh_transfer_between_warehouse_state_id')->index('wh_transfer_between_warehouse_wh_transfer_between_warehouse_state_id_fk');
            $table->dateTime('creation_date');
            $table->dateTime('dispatch_date')->nullable();
            $table->dateTime('reception_date')->nullable();
			$table->string('description', 500)->default('');
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
		Schema::drop('wh_transfer_between_warehouse');
	}

}
