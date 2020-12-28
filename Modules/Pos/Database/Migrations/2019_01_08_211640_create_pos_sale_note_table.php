<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosSaleNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_sale_note', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pos_sale_id')->index('pos_sale_note_pos_sale_fk');
			$table->string('number', 20);
			$table->date('emission_date');
			$table->decimal('subtotal', 10);
			$table->decimal('discount_or_charge', 10);
			$table->decimal('new_subtotal', 10);
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
		Schema::drop('pos_sale_note');
	}

}
