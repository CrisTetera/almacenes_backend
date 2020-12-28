<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGStatePos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_state_pos', function (Blueprint $table) {
            $table->foreign('g_state_type_id' , 'g_state_pos_children_g_state_type_pos_fk')->references('id')->on('g_state_type_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('g_state_pos', function (Blueprint $table) {
            $table->dropForeign('g_state_pos_children_g_state_type_pos_fk');
        });
    }
}
