<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePchPurchaseQuotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pch_purchase_quotation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pch_provider_id')->index('pch_provider_pch_purchase_quotation_fk');
			$table->integer('g_state_id')->index('pch_purchase_quotation_g_state_fk');
			$table->string('description', 500);
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
		Schema::drop('pch_purchase_quotation');
	}

}
