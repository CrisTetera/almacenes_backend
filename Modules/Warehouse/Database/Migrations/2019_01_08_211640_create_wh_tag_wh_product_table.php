<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhTagWhProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_tag_wh_product', function(Blueprint $table)
		{
			$table->integer('wh_product_id')->index('wh_tag_wh_product2_fk');
			$table->integer('wh_tag_id')->index('wh_tag_wh_product_fk');
			$table->primary(['wh_product_id','wh_tag_id'], 'pk_wh_tag_wh_product');
			$table->unique(['wh_product_id','wh_tag_id'], 'wh_tag_wh_product_pk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wh_tag_wh_product');
	}

}
