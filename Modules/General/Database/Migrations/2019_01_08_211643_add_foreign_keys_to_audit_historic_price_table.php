<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAuditHistoricPriceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('audit_historic_price', function(Blueprint $table)
		{
			$table->foreign('g_user_id', 'fk_audit_historic_price_g_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_list_price_id', 'fk_audit_historic_price_sl_list_price')->references('id')->on('sl_list_price')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_audit_historic_price_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('audit_historic_price', function(Blueprint $table)
		{
			$table->dropForeign('fk_audit_historic_price_g_user');
			$table->dropForeign('fk_audit_historic_price_sl_list_price');
			$table->dropForeign('fk_audit_historic_price_wh_product');
		});
	}

}
