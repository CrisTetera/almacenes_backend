<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlListPriceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_list_price', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_branch_office_id')->index('sl_list_price_g_branch_office_fk');
			$table->string('name');
			$table->string('description', 500);
			$table->boolean('is_active');
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
		Schema::drop('sl_list_price');
	}

}
