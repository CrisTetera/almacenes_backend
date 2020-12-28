<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhSaleNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_sale_note', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_user_id')->index('wh_sale_note_g_user_fk');
			$table->integer('pos_sale_id')->nullable()->index('wh_sale_note__pos_sale_fk');
			$table->decimal('subtotal', 10);
			$table->decimal('discount_or_charge', 10);
			$table->decimal('new_subtotal', 10);
			$table->decimal('iva', 10);
			$table->decimal('total', 10);
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
		Schema::drop('wh_sale_note');
	}

}
