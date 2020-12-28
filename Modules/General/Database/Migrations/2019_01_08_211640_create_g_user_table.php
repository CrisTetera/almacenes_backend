<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('g_user', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('hr_employee_id')->nullable()->unique()->index('g_user_hr_employee_fk');
			$table->string('password')->default('');
			$table->string('auth_code', 5)->default('');
			$table->string('bar_auth_code', 12)->default('');
			$table->string('remember_token')->nullable();
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
		Schema::drop('g_user');
	}

}
