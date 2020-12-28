<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhInventoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_inventory', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_stock_adjust_id')->nullable()->index('wh_stock_adjust_wh_inventory2_fk');
			$table->integer('g_user_id')->index('wh_inventory_g_user_create_fk');
			$table->integer('wh_warehouse_id')->index('wh_inventory_wh_warehouse_fk');
			$table->integer('g_user_id2')->index('wh_inventory_g_user_cronfirm_fk');
			$table->integer('g_state_id')->index('wh_inventory_g_state_fk');
			$table->string('description', 500);
			$table->date('inventory_date');
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
		Schema::drop('wh_inventory');
	}

}
