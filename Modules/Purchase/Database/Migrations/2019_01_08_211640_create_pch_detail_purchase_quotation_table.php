<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchDetailPurchaseQuotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_detail_purchase_quotation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_purchase_quotation_id')->index('pch_detail_purchase_quotation_pch_purchase_quotation_fk');
			$table->integer('wh_product_id')->index('pch_detail_purchase_quotation_wh_product_fk');
			$table->decimal('quantity', 10);
			$table->string('detail', 500);
			$table->decimal('discount_or_charge', 10);
			$table->decimal('subtotal', 10);
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
		Schema::drop('pch_detail_purchase_quotation');
	}

}
