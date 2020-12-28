<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosSalePosPaymentTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_sale_pos_payment_type', function(Blueprint $table)
		{
			$table->integer('pos_sale_payment_type_id')->index('pos_sale_pos_payment_type2_fk');
			$table->integer('pos_sale_id')->index('pos_sale_pos_payment_type_fk');
            $table->integer('amount');
            // Commented because you can pay two or more time with same payment type
			// $table->primary(['pos_sale_payment_type_id','pos_sale_id'], 'pk_pos_sale_pos_payment_type');
			// $table->unique(['pos_sale_payment_type_id','pos_sale_id'], 'pos_sale_pos_payment_type_pk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pos_sale_pos_payment_type');
	}

}
