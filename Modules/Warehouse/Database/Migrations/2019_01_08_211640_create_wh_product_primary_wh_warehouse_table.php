<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhProductPrimaryWhWarehouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_product_primary_wh_warehouse', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_product_id')->index('wh_product_primary_wh_product_fk');
            $table->integer('wh_warehouse_id')->index('wh_product_primary_wh_warehouse_fk');
            $table->integer('g_branch_office_id')->index('wh_product_primary_g_branch_office');
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
        Schema::dropIfExists('wh_product_primary_wh_warehouse');
    }
}
