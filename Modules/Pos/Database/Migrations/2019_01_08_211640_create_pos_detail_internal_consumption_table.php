<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosDetailInternalConsumptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_detail_internal_consumption', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_product_id')->index('pos_detail_internal_consumption_wh_product_fk');
			$table->integer('pos_internal_consumption_id')->index('pos_detail_internal_consumption_pos_internal_consumption_fk');
            $table->integer('quantity');
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
		Schema::drop('pos_detail_internal_consumption');
	}

}
