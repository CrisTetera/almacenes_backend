<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGRoleCanCreateRolePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_role_can_create_role_pos', function (Blueprint $table) {
            $table->foreign('g_role_id', 'g_role_can_create_role_pos_children_roles_fk')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('g_role_can_create_id', 'g_role_can_create_role_pos_children_roles_fk2')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('g_role_can_create_role_pos', function (Blueprint $table) {
            $table->dropForeign('g_role_can_create_role_pos_children_roles_fk');
            $table->dropForeign('g_role_can_create_role_pos_children_roles_fk2');
        });
    }
}
