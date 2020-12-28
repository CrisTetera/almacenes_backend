<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGRoleCanCreateRolePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_role_can_create_role_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('g_role_id')->index('g_role_can_create_role_pos_children_roles_fk');
            $table->integer('g_role_can_create_id')->index('g_role_can_create_role_pos_children_roles_fk2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('g_role_can_create_role_pos');
    }
}
