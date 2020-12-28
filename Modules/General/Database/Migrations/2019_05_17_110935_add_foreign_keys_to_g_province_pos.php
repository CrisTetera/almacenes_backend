<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGProvincePos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('g_province_pos', function (Blueprint $table) {
            $table->foreign('g_region_id' , 'g_province_pos_children_g_region_pos_fk')->references('id')->on('g_region_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('g_province_pos', function (Blueprint $table) {
            $table->dropForeign('g_province_pos_children_g_province_pos_fk');
        });
    }
}
