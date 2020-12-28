
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhPackingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_packing', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_product_id')->index('wh_product_children_wh_packing2_fk');
			$table->integer('wh_product_content_id')->index('wh_product_content_wh_packing2_fk');
			$table->integer('quantity_product');
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
		Schema::drop('wh_packing');
	}

}
