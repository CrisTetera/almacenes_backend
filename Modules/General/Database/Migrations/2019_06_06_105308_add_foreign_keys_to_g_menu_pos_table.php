<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGMenuPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_menu_pos', function (Blueprint $table) {
			$table->foreign('g_module_id', 'g_menu_pos_children_g_module_pos_fk')->references('id')->on('g_module_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('g_menu_pos', function (Blueprint $table) {
			$table->dropForeign('g_menu_pos_children_g_module_pos_fk');

        });
    }
}
