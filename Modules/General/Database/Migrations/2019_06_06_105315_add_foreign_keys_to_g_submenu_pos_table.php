<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGSubmenuPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_submenu_pos', function (Blueprint $table) {
            $table->foreign('g_menu_id', 'g_submenu_pos_children_g_menu_pos_fk')->references('id')->on('g_menu_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('permissions_id', 'g_submenu_pos_children_permissions_fk')->references('id')->on('permissions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('g_submenu_pos', function (Blueprint $table) {
            $table->dropForeign('g_submenu_pos_children_g_menu_pos_fk');
			$table->dropForeign('g_submenu_pos_children_permissions_fk');
        });
    }
}
