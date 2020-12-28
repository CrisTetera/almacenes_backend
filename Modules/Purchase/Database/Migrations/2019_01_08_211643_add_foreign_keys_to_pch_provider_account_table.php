<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPchProviderAccountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pch_provider_account', function(Blueprint $table)
		{
			$table->foreign('pch_provider_id', 'fk_pch_provider_pch_provider_account2')->references('id')->on('pch_provider')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pch_provider_account', function(Blueprint $table)
		{
			$table->dropForeign('fk_pch_provider_pch_provider_account2');
		});
	}

}
