<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhDetailDispatchGuideTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_detail_dispatch_guide', function(Blueprint $table)
		{
			$table->foreign('wh_product_id', 'fk_wh_detail_dispatch_guide_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_dispatch_guide_id', 'fk_wh_detail_dispatch_guite_wh_dispatch_guide')->references('id')->on('wh_dispatch_guide')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_detail_dispatch_guide', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_detail_dispatch_guide_wh_product');
			$table->dropForeign('fk_wh_detail_dispatch_guite_wh_dispatch_guide');
		});
	}

}
