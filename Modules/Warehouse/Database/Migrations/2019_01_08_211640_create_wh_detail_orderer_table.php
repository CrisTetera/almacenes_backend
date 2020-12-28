<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhDetailOrdererTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_detail_orderer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_orderer_id')->index('wh_detail_orderer_wh_orderer_fk');
            $table->integer('wh_product_id')->index('wh_detail_orderer_wh_product_fk');
            $table->string('provider_product_code', 20)->default('');
            $table->decimal('quantity', 10, 2);
            $table->string('brand', 20)->default('');
            $table->string('description', 255)->default('');
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
		Schema::drop('wh_detail_orderer');
	}

}
