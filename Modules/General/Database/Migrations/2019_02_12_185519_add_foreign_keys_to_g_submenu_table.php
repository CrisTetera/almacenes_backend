<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::table('g_submenu', function(Blueprint $table)
		{
			$table->foreign('g_menu_id', 'fk_g_submenu_g_menu')->references('id')->on('g_menu')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('permissions_id', 'fk_g_submenu_permissions')->references('id')->on('permissions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('g_submenu', function(Blueprint $table)
		{
			$table->dropForeign('fk_g_submenu_g_menu');
			$table->dropForeign('fk_g_submenu_permissions');
		});
	}
}
