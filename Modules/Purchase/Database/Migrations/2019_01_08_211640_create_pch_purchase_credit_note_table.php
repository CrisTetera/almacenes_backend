<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchPurchaseCreditNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_purchase_credit_note', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_purchase_invoice_id')->index('pch_purchase_credit_note_pch_purchase_invoice_fk');
			$table->integer('g_commune_id')->index('pch_purchase_credit_note_g_commune_fk');
			$table->integer('pch_provider_account_movement_id')->index('pch_provider_account_movement_pch_purchase_credit_note2_fk');
			$table->string('number', 20);
			$table->string('core_business', 500);
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
		Schema::drop('pch_purchase_credit_note');
	}

}
