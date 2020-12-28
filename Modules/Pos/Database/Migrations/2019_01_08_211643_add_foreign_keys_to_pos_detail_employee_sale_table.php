<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosDetailEmployeeSaleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_detail_employee_sale', function(Blueprint $table)
		{
			$table->foreign('pos_employee_sale_id', 'fk_pos_detail_employee_sale_pos_employee_sale')->references('id')->on('pos_employee_sale')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_product_id', 'fk_pos_detail_employee_sale_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_detail_employee_sale', function(Blueprint $table)
		{
			$table->dropForeign('fk_pos_detail_employee_sale_pos_employee_sale');
			$table->dropForeign('fk_pos_detail_employee_sale_wh_product');
		});
	}

}
