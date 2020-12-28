<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuditSystemLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audit_system_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_user_id')->index('audit_system_logs_g_user_fk');
			$table->string('action', 200);
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
		Schema::drop('audit_system_logs');
	}

}
