<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchProviderAccountMovementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_provider_account_movement', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_type_provider_account_movement_id')->index('pch_provider_account_movement_pch_type_account_movement_fk');
			$table->integer('pch_provider_account_id')->index('pch_provider_account_movement_pch_provider_account_fk');
			$table->integer('pch_provider_payment_id')->nullable()->index('pch_provider_payment_pch_provider_accouint_movement2_fk');
			$table->integer('pch_purchase_credit_note_id')->nullable()->index('pch_provider_account_movement_pch_purchase_credit_note_fk');
			$table->integer('pch_purchase_debit_note_id')->nullable()->index('pch_provider_account_movement_pch_purchase_debit_note_fk');
			$table->integer('pch_purchase_invoice_id')->nullable()->index('pch_provider_account_movement_pch_purchase_invoice_fk');
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
		Schema::drop('pch_provider_account_movement');
	}

}
