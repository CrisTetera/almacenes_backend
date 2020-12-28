<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhPackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_pack', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_product_id')->index('wh_product_children_wh_pack2_fk');
			$table->integer('wh_item_id')->index('wh_item_wh_pack_fk');
			$table->decimal('item_quantity', 10);
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
		Schema::drop('wh_pack');
	}

}
