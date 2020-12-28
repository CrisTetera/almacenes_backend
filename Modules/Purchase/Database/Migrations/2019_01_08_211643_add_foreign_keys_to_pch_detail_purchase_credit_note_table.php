<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchDetailPurchaseCreditNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_detail_purchase_credit_note', function(Blueprint $table)
		{
			$table->foreign('pch_purchase_credit_note_id', 'fk_pch_purchase_credit_note_pch_purchase_credit_note')->references('id')->on('pch_purchase_credit_note')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_pch_purchase_credit_note_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_detail_purchase_credit_note', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_purchase_credit_note_pch_purchase_credit_note');
			$table->dropForeign('fk_pch_purchase_credit_note_wh_product');
		});
	}

}
