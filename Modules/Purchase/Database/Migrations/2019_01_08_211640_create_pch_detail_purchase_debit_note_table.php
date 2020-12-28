<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchDetailPurchaseDebitNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_detail_purchase_debit_note', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_purchase_debit_note_id')->index('pch_detail_purchase_debit_note_pch_purchase_debit_note_fk');
			$table->integer('wh_product_id')->index('pch_detail_purchase_debit_note_wh_product_fk');
			$table->decimal('quantity', 10);
			$table->string('detail', 500);
			$table->decimal('discount_or_surcharge', 10);
			$table->decimal('subtotal', 10)->nullable();
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
		Schema::drop('pch_detail_purchase_debit_note');
	}

}
