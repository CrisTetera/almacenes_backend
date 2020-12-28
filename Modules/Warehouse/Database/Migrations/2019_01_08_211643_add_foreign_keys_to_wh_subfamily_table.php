<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhSubfamilyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_subfamily', function(Blueprint $table)
		{
			$table->foreign('wh_family_id', 'fk_wh_family_wh_subfamily')->references('id')->on('wh_family')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_subfamily', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_family_wh_subfamily');
		});
	}

}
