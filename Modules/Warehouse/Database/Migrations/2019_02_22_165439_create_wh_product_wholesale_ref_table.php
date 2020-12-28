<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhProductWholesaleRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_product_wholesale_ref', function (Blueprint $table) {
            $table->integer('wh_product_id')->index('wh_product_wholesale_ref_wh_product_fk');
			$table->integer('g_branch_office_id')->index('wh_product_wholesale_ref_g_branch_office_fk');
            $table->integer('sl_wholesale_ref_id')->index('wh_product_wholesale_ref_sl_wholesale_ref_fk');
			$table->primary(['wh_product_id','g_branch_office_id'], 'pk_wh_product_wholesale_ref');
			$table->unique(['wh_product_id','g_branch_office_id'], 'wh_product_wholesale_ref_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wh_product_wholesale_ref');
    }
}
