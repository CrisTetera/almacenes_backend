<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGTemporalModuleTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_temporal_module_token', function (Blueprint $table) {
            $table->foreign('g_user_id', 'g_temporal_module_token_children_g_user_pos_fk')->references('id')->on('g_user_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('g_temporal_module_token', function (Blueprint $table) {
            $table->dropForeign('g_temporal_module_token_children_g_user_pos_fk');
        });
    }
}
