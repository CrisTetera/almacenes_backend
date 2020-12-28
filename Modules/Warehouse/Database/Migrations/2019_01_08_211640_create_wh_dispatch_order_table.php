<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhDispatchOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_dispatch_order', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_state_id')->index('wh_dispatch_order_g_state_fk');
			$table->integer('g_user_id')->index('wh_dispatch_order_g_user_fk');
			$table->string('number', 20);
			$table->string('description', 500);
			$table->date('dispatch_date');
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
		Schema::drop('wh_dispatch_order');
	}

}
