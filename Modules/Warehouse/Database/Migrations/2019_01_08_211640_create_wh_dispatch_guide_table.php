<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhDispatchGuideTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_dispatch_guide', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_purchase_invoice_id')->nullable()->index('wh_dispatch_guide_pch_purchase_invoice_fk');
			$table->integer('g_user_id')->index('wh_dispatch_guide_g_user_fk');
			$table->integer('sl_customer_id')->index('wh_dispatch_guide_sl_customer_fk');
			$table->string('number', 20);
			$table->date('dispatch_date');
			$table->string('sender_compay_name', 500);
			$table->string('sender_company_rut', 10);
			$table->string('sender_company_address', 500);
			$table->string('sender_company_comune', 100);
			$table->string('sender_company_core_business', 500);
			$table->string('sender_company_phone', 50);
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
		Schema::drop('wh_dispatch_guide');
	}

}
