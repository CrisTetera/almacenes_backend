<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosSalePosPaymentTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_sale_pos_payment_type', function(Blueprint $table)
		{
			$table->foreign('pos_sale_id', 'fk_pos_sale_pos_payment_type')->references('id')->on('pos_sale')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_sale_payment_type_id', 'fk_pos_sale_pos_payment_type2')->references('id')->on('pos_sale_payment_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_sale_pos_payment_type', function(Blueprint $table)
		{
			$table->dropForeign('fk_pos_sale_pos_payment_type');
			$table->dropForeign('fk_pos_sale_pos_payment_type2');
		});
	}

}
