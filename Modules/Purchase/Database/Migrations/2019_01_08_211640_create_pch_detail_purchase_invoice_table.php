<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchDetailPurchaseInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_detail_purchase_invoice', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_purchase_invoice_id')->index('pch_detail_purchase_invoice_pch_purchase_invoice_fk');
			$table->integer('wh_product_id')->index('pch_detail_purchase_invoice_wh_product_fk');
			$table->decimal('discount_or_surcharge', 10);
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
		Schema::drop('pch_detail_purchase_invoice');
	}

}
