<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosCashDeskMovementPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_cash_desk_movement_pos', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('pos_movement_egress_type_id')->nullable()->index('pos_cash_desk_movement_pos_children_pos_cash_movement_egress_type_pos_fk');
            $table->integer('pos_movement_ingress_type_id')->nullable()->index('pos_cash_desk_movement_pos_children_pos_cash_movement_ingress_type_pos_fk');
            $table->integer('pos_cash_desk_id')->index('pos_cash_desk_movement_pos_children_pos_cash_desk_pos_fk');
            $table->integer('g_user_id')->index('pos_cash_desk_movement_pos_children_g_user_pos_fk');
            $table->integer('amount');
            $table->string('observation')->nullable();
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
        Schema::dropIfExists('pos_cash_desk_movement_pos');
    }
}
