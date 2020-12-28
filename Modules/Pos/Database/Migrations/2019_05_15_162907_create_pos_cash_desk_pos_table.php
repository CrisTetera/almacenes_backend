<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosCashDeskPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_cash_desk_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            // $table->integer('g_state_id')->index('pos_cash_desk_pos_children_g_state_pos_fk');
            $table->boolean('flag_delete')->default(0);
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
        Schema::dropIfExists('pos_cash_desk_pos');
    }
}
