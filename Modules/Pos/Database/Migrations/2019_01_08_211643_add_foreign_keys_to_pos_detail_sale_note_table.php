<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosDetailSaleNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_detail_sale_note', function(Blueprint $table)
		{
			$table->foreign('pos_sale_note_id', 'fk_sl_sale_note_sl_detail_sale_note')->references('id')->on('pos_sale_note')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_detail_sale_note', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_sale_note_sl_detail_sale_note');
		});
	}

}
