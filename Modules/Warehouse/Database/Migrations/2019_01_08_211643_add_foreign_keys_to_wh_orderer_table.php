<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWhOrdererTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wh_orderer', function(Blueprint $table)
		{
			$table->foreign('wh_orderer_priority_id', 'fk_wh_orderer_wh_orderer_priority')->references('id')->on('wh_orderer_priority')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_supervisor_user_id', 'fk_wh_orderer_g_supervisor_user')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_warehouse_id', 'wh_orderer_wh_warehouse_fk')->references('id')->on('wh_warehouse')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_provider_id', 'fk_wh_orderer_pch_provider')->references('id')->on('pch_provider')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pch_provider_branch_offices_id', 'fk_wh_orderer_pch_provider_branch_offices')->references('id')->on('pch_provider_branch_offices')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wh_orderer', function(Blueprint $table)
		{
			$table->dropForeign('fk_wh_orderer_wh_orderer_priority');
			$table->dropForeign('fk_wh_orderer_g_supervisor_user');
			$table->dropForeign('wh_orderer_wh_warehouse_fk');
			$table->dropForeign('fk_wh_orderer_pch_provider');
			$table->dropForeign('fk_wh_orderer_pch_provider_branch_offices');
		});
	}

}
