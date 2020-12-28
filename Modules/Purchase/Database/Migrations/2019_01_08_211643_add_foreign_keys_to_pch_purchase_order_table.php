<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchPurchaseOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_purchase_order', function(Blueprint $table)
		{
			$table->foreign('pch_provider_id', 'fk_pch_provider_pch_purchase_order')->references('id')->on('pch_provider')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_provider_branch_offices_id', 'fk_pch_provider_branch_offices_pch_purchase_order')->references('id')->on('pch_provider_branch_offices')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_payment_condition_id', 'fk_pch_payment_condition_pch_purchase_order')->references('id')->on('pch_payment_condition')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_purchase_order_state_id', 'fk_pch_purchase_order_state_pch_purchase_order')->references('id')->on('pch_purchase_order_state')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_warehouse_id', 'fk_wh_warehouse_pch_purchase_order')->references('id')->on('wh_warehouse')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_originator_user_id', 'fk_g_originator_user_pch_purchase_order')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_authorizer_user_id', 'fk_g_authorizer_user_pch_purchase_order')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_reception_id', 'fk_wh_product_reception_pch_purchase_order2')->references('id')->on('wh_product_reception')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_purchase_order', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_provider_pch_purchase_order');
			$table->dropForeign('fk_pch_provider_branch_offices_pch_purchase_order');
			$table->dropForeign('fk_pch_payment_condition_pch_purchase_order');
			$table->dropForeign('fk_pch_purchase_order_state_pch_purchase_order');
			$table->dropForeign('fk_wh_warehouse_pch_purchase_order');
			$table->dropForeign('fk_g_originator_user_pch_purchase_order');
			$table->dropForeign('fk_g_authorizer_user_pch_purchase_order');
			$table->dropForeign('wh_product_reception_id');
		});
	}

}
