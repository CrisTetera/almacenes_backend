<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_submenu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 500);
            $table->integer('priority');
            $table->string('icon', 50);
            $table->string('route', 100);
            $table->integer('g_menu_id')->unsigned()->index('fk_g_submenu_g_menu');
            $table->integer('permissions_id')->unsigned()->index('fk_g_submenu_permissions');

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
        Schema::dropIfExists('g_submenu');
    }
}
