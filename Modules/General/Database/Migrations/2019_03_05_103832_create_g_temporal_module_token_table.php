<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGTemporalModuleTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_temporal_module_token', function (Blueprint $table) {
            $table->increments('id');
            $table->string('module_token', 500);
            $table->string('user_token', 2000);
            $table->integer('g_user_id')->index('g_temporal_module_token_children_g_user_pos_fk');
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
        Schema::dropIfExists('g_temporal_module_token');
    }
}
