<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhOrdererTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_orderer', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('pch_provider_id')->index('wh_orderer_pch_provider_fk');
			$table->integer('pch_provider_branch_offices_id')->index('wh_orderer_pch_provider_branch_offices_fk');
			$table->integer('wh_orderer_priority_id')->index('wh_orderer_wh_orderer_priority_fk');
			$table->integer('wh_warehouse_id')->index('wh_orderer_wh_warehouse_fk');
			$table->integer('g_supervisor_user_id')->index('wh_orderer_g_supervisor_user_fk');
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
		Schema::drop('wh_orderer');
	}

}
