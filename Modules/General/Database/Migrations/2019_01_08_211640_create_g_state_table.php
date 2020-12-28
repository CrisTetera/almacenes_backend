<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGStateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('g_state', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_state_type_id')->index('g_state_g_state_type_fk');
			$table->string('state', 100);
			$table->integer('state_sequence');
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
		Schema::drop('g_state');
	}

}
