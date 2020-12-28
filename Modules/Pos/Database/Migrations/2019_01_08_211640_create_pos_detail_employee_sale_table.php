<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosDetailEmployeeSaleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_detail_employee_sale', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('line_number');
			$table->integer('wh_product_id')->index('pos_detail_employee_sale_wh_product_fk');
			$table->integer('pos_employee_sale_id')->index('pos_detail_employee_sale_pos_employee_sale_fk');
			$table->integer('quantity');
            $table->integer('price');
            $table->decimal('net_price', 10, 2);
            $table->integer('net_subtotal');
			$table->integer('discount_or_charge_percentage');
			$table->integer('discount_or_charge_value');
            $table->integer('new_net_subtotal');
            $table->integer('total');
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
		Schema::drop('pos_detail_employee_sale');
	}

}
