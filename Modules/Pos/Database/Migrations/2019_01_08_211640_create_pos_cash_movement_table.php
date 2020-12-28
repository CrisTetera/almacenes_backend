<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosCashMovementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_cash_movement', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pos_cash_movement_egress_type_id')->nullable()->index('pos_cash_movement_pos_cash_movement_egress_type_fk');
			$table->integer('pos_cash_movement_ingress_type_id')->nullable()->index('pos_cash_movement_pos_cash_movement_ingress_type_fk');
			$table->integer('pos_cash_desk_id')->index('pos_cash_movement_g_cash_desk_fk');
			$table->integer('g_user_id')->index('pos_cash_movement_g_user_fk');
			$table->decimal('amount', 10);
			$table->string('observation', 500)->nullable();
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
		Schema::drop('pos_cash_movement');
	}

}
