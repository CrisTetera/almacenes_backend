<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToWhSubfamilyPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_subfamily_pos', function (Blueprint $table) {
            $table->foreign('wh_family_id', 'wh_subfamily_pos_children_wh_family_pos_fk')->references('id')->on('wh_family_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_subfamily_pos', function (Blueprint $table) {
            $table->dropForeign('wh_subfamily_pos_children_wh_family_pos_fk');
        });
    }
}
