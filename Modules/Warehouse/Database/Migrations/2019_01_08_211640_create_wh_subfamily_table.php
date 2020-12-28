<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhSubfamilyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_subfamily', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_family_id')->index('wh_family_wh_subfamily_fk');
			$table->string('subfamily', 100);
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
		Schema::drop('wh_subfamily');
	}

}
