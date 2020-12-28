s<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchPurchaseOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_purchase_order', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('pch_provider_id')->index('pch_purchase_order_pch_provider_fk');
			$table->integer('pch_provider_branch_offices_id')->index('pch_purchase_order_pch_provider_branch_offices_fk');
			$table->integer('pch_payment_condition_id')->index('pch_purchase_order_pch_payment_condition_fk');
			$table->integer('pch_purchase_order_state_id')->index('pch_purchase_order_pch_purchase_order_state_fk');
			$table->integer('wh_warehouse_id')->index('pch_purchase_order_wh_warehouse_fk'); // Contains branch office
            $table->integer('g_originator_user_id')->index('pch_purchase_order_g_originator_user_fk');
            $table->integer('g_authorizer_user_id')->nullable()->index('pch_purchase_order_g_authorizer_user_fk');
            $table->boolean('email_sended')->default(0);
            $table->string('observation', 500);
            $table->integer('net_subtotal');
            $table->integer('iva');
            $table->integer('total');
			$table->integer('wh_product_reception_id')->nullable()->index('pch_purchase_order_wh_product_reception_fk');
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
		Schema::drop('pch_purchase_order');
	}

}
