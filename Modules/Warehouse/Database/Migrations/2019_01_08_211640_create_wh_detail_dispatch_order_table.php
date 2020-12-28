<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhDetailDispatchOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_detail_dispatch_order', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_dispatch_order_id')->index('wh_detail_dispatch_order_wh_dispatch_order_fk');
			$table->integer('wh_dispatch_guide_id')->index('wh_detail_dispatch_order_wh_dispatch_guide_fk');
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
		Schema::drop('wh_detail_dispatch_order');
	}

}
