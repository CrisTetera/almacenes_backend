<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosSaleNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_sale_note', function(Blueprint $table)
		{
			$table->foreign('pos_sale_id', 'fk_pos_sale_note_pos_sale')->references('id')->on('pos_sale')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_sale_note', function(Blueprint $table)
		{
			$table->dropForeign('fk_pos_sale_note_pos_sale');
		});
	}

}
