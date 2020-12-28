<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhSaleNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_sale_note', function(Blueprint $table)
		{
			$table->foreign('g_user_id', 'fk_wh_sale_note_g_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_sale_id', 'fk_wh_sale_note__pos_sale')->references('id')->on('pos_sale')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_sale_note', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_sale_note_g_user');
			$table->dropForeign('fk_wh_sale_note__pos_sale');
		});
	}

}
