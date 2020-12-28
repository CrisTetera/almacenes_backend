<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsKeysToTableGRoleCanCreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_role_can_create_role', function (Blueprint $table) {
            $table->foreign('role_id', 'fk_g_role_can_create_role_role')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('role_can_create_id', 'fk_g_role_can_create_role_role_can_create')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('g_role_can_create_role', function (Blueprint $table) {
            $table->dropForeign('fk_g_role_can_create_role_role');
            $table->dropForeign('fk_g_role_can_create_role_role_can_create');
        });
    }
}
