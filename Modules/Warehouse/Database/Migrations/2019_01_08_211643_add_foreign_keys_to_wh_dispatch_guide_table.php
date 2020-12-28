<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhDispatchGuideTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_dispatch_guide', function(Blueprint $table)
		{
			$table->foreign('g_user_id', 'fk_wh_dispatch_guide_g_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_purchase_invoice_id', 'fk_wh_dispatch_guide_pch_purchase_invoice')->references('id')->on('pch_purchase_invoice')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_id', 'fk_wh_dispatch_guide_sl_customer')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_dispatch_guide', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_dispatch_guide_g_user');
			$table->dropForeign('fk_wh_dispatch_guide_pch_purchase_invoice');
			$table->dropForeign('fk_wh_dispatch_guide_sl_customer');
		});
	}

}
