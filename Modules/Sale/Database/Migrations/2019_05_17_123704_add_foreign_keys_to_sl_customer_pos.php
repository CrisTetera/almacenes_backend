<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlCustomerPos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_customer_pos', function (Blueprint $table) {
            $table->foreign('g_commune_id' , 'sl_customer_pos_children_g_commune_pos_fk')->references('id')->on('g_commune_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_customer_pos', function (Blueprint $table) {
            $table->dropForeign('sl_customer_pos_children_g_commune_pos_fk');
        });
    }
}
