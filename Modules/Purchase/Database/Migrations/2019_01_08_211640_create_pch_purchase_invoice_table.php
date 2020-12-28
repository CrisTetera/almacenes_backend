<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchPurchaseInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_purchase_invoice', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_provider_id')->index('pch_provider_pch_purchase_invoice_fk');
			$table->integer('g_commune_id')->index('pch_purchase_invoice_g_commune_fk');
			$table->integer('pch_provider_account_movement_id')->index('pch_provider_account_movement_pch_purchase_invoice2_fk');
			$table->string('contact', 500);
			
			$table->decimal('subtotal', 10)->nullable();
			$table->decimal('discount_or_charge', 10)->nullable();
			$table->decimal('new_subtotal', 10)->nullable();
			$table->decimal('iva', 10)->nullable();
			$table->decimal('total', 10)->nullable();
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
		Schema::drop('pch_purchase_invoice');
	}

}
