<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGMenuPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_menu_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 500);
            $table->integer('priority');
            $table->string('icon', 50);
            $table->string('route', 100);
            $table->integer('g_module_id')->unsigned()->index('g_menu_pos_children_g_module_pos_fk');

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
        Schema::dropIfExists('g_menu_pos');
    }
}
