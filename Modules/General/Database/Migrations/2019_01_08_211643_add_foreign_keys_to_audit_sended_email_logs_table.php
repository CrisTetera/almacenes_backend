<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAuditSendedEmailLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('audit_sended_email_logs', function(Blueprint $table)
		{
			$table->foreign('g_user_id', 'fk_audit_sended_email_logs_g_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('audit_sended_email_logs', function(Blueprint $table)
		{
			$table->dropForeign('fk_audit_sended_email_logs_g_user');
		});
	}

}
