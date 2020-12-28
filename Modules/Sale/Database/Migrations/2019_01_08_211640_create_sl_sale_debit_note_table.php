<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlSaleDebitNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_sale_debit_note', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_customer_account_movement_id')->index('sl_customer_account_movement_sl_sale_debit_note2_fk');
			$table->integer('sl_customer_id')->index('sl_sale_debit_note_sl_customer_fk');
			$table->string('number', 20);
			$table->date('emission_date');
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
		Schema::drop('sl_sale_debit_note');
	}

}
