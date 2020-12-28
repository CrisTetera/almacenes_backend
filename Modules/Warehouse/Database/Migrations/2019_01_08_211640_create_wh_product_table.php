<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wh_product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wh_item_id')->nullable()->index('wh_product_children_wh_item_fk');
			$table->integer('wh_pack_id')->nullable()->index('wh_product_children_wh_pack_fk');
			$table->integer('wh_packing_id')->nullable()->index('wh_product_children_wh_packing_fk');
			$table->integer('wh_promo_id')->nullable()->index('wh_product_children_wh_promo_fk');
			$table->integer('wh_subfamily_id')->index('wh_subfamily_wh_product_fk');
			$table->string('internal_code', 20);
			$table->string('name');
			$table->string('alias_name');
            $table->string('description', 500)->default('');
            $table->string('path_logo', 500)->default('');
			$table->integer('warranty_days');
			$table->boolean('is_repackaged');
			$table->boolean('is_tax_free'); // Exento de IVA
			$table->boolean('is_salable');
			$table->boolean('is_consumable');
			$table->boolean('is_seasonal');
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
		Schema::drop('wh_product');
	}

}
