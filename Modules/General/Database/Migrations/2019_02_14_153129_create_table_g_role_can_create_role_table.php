<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGRoleCanCreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_role_can_create_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->index('g_role_can_create_role_role_user_fk');
            $table->integer('role_can_create_id')->index('g_role_can_create_role_role_can_create_fk');
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
        Schema::dropIfExists('g_role_can_create_role');
    }
}
