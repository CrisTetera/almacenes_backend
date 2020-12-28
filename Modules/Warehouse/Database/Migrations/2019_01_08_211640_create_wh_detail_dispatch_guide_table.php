<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhDetailDispatchGuideTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_detail_dispatch_guide', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_dispatch_guide_id')->index('wh_detail_dispatch_guite_wh_dispatch_guide_fk');
			$table->integer('wh_product_id')->index('wh_detail_dispatch_guide_wh_product_fk');
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
		Schema::drop('wh_detail_dispatch_guide');
	}

}
