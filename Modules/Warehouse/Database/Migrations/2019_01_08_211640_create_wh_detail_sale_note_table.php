<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhDetailSaleNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_detail_sale_note', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_sale_note_id')->index('wh_detail_sale_note_wh_sale_note_fk');
			$table->integer('wh_product_id')->index('wh_detail_sale_note_wh_product_fk');
			$table->decimal('quantity', 10);
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
		Schema::drop('wh_detail_sale_note');
	}

}
