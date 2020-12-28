<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_warehouse', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_branch_office_id')->index('wh_warehouse_g_branch_office_fk');
			$table->integer('wh_warehouse_type_id')->index('wh_warehouse_wh_warehouse_type_fk');
			$table->string('name');
			$table->string('description', 500);
			$table->string('address', 500);
			$table->boolean('is_waste_warehouse')->default(0);
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
		Schema::drop('wh_warehouse');
	}

}
