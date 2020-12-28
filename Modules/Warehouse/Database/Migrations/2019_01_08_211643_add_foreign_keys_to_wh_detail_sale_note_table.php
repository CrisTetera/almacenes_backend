<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhDetailSaleNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_detail_sale_note', function(Blueprint $table)
		{
			$table->foreign('wh_product_id', 'fk_wh_detail_sale_note_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_sale_note_id', 'fk_wh_detail_sale_note_wh_sale_note')->references('id')->on('wh_sale_note')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_detail_sale_note', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_detail_sale_note_wh_product');
			$table->dropForeign('fk_wh_detail_sale_note_wh_sale_note');
		});
	}

}
