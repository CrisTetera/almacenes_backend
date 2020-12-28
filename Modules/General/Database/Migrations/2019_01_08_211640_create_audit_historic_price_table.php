<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuditHistoricPriceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audit_historic_price', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_product_id')->index('audit_historic_price_wh_product_fk');
			$table->integer('g_user_id')->index('audit_historic_price_g_user_fk');
			$table->integer('sl_list_price_id')->index('audit_historic_price_sl_list_price_fk');
			$table->date('init_datetime')->nullable();
			$table->date('finish_datetime')->nullable();
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
		Schema::drop('audit_historic_price');
	}

}
