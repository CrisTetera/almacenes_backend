<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGCommunePos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_commune_pos', function (Blueprint $table) {
            $table->foreign('g_province_id' , 'g_commune_pos_children_g_province_pos_fk')->references('id')->on('g_province_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('g_commune_pos', function (Blueprint $table) {
            $table->dropForeign('g_commune_pos_children_g_province_pos_fk');
        });
    }
}
