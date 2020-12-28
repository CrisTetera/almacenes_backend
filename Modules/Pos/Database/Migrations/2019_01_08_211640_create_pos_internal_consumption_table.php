<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosInternalConsumptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_internal_consumption', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('description', 500);
            $table->integer('g_branch_office_id')->nullable()->index('pos_internal_consumption_g_branch_office_fk');
            $table->integer('hr_requester_employee_id')->nullable()->index('pos_internal_consumption_hr_employee_fk');
            $table->integer('g_seller_user_id')->nullable()->index('pos_internal_consumption_g_user_fk');
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
		Schema::drop('pos_internal_consumption');
	}

}
