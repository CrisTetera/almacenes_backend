<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhSubfamilyPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_subfamily_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_family_id')->index('wh_subfamily_pos_children_wh_family_pos_fk');
            $table->string('subfamily',100);
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
        Schema::dropIfExists('wh_subfamily_pos');
    }
}
