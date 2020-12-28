<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuditSendedEmailLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audit_sended_email_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('g_user_id')->index('audit_sended_email_logs_g_user_fk');
			$table->string('email_sender', 100);
			$table->string('email_receiver', 100);
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
		Schema::drop('audit_sended_email_logs');
	}

}
