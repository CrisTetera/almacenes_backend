<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchDetailPurchaseInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_detail_purchase_invoice', function(Blueprint $table)
		{
			$table->foreign('pch_purchase_invoice_id', 'fk_pch_detail_purchase_invoice_pch_purchase_invoice')->references('id')->on('pch_purchase_invoice')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_pch_detail_purchase_invoice_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_detail_purchase_invoice', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_detail_purchase_invoice_pch_purchase_invoice');
			$table->dropForeign('fk_pch_detail_purchase_invoice_wh_product');
		});
	}

}
