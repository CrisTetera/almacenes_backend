<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlCustomerAccountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_customer_account', function(Blueprint $table)
		{
			$table->foreign('sl_customer_id', 'fk_sl_customer_sl_customer_account2')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_customer_account', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_customer_sl_customer_account2');
		});
	}

}
