<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosCashDeskTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_cash_desk', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_branch_office_id')->index('pos_cash_desk_g_branch_office_fk');
			$table->string('number', 20);
			$table->string('name');
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
		Schema::drop('pos_cash_desk');
	}

}
