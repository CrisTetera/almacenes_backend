<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlOfferTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_offer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_product_id')->index('sl_offer_wh_product_fk');
			$table->integer('g_branch_office_id')->index('sl_offer_g_branch_office_fk');
			$table->string('name', 200)->nullable();
			$table->decimal('offer_price', 10);
			$table->date('init_datetime');
			$table->date('finish_datetime');
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
		Schema::drop('sl_offer');
	}

}
