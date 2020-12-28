<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlCustomerPresetsDiscountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sl_customer_presets_discount', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sl_customer_id')->index('sl_customer_sl_customer_presets_discount_fk');
			$table->decimal('discount_percentage', 10);
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
		Schema::drop('sl_customer_presets_discount');
	}

}
