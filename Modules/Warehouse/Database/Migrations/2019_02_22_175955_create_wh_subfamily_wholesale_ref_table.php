<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhSubfamilyWholesaleRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_subfamily_wholesale_ref', function (Blueprint $table) {
            $table->integer('wh_subfamily_id')->index('wh_subfamily_wholesale_ref_wh_subfamily_fk');
			$table->integer('g_branch_office_id')->index('wh_subfamily_wholesale_ref_g_branch_office_fk');
            $table->integer('sl_wholesale_ref_id')->index('wh_subfamily_wholesale_ref_sl_wholesale_ref_fk');
			$table->primary(['wh_subfamily_id','g_branch_office_id'], 'pk_wh_subfamily_wholesale_ref');
			$table->unique(['wh_subfamily_id','g_branch_office_id'], 'wh_subfamily_wholesale_ref_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wh_subfamily_wholesale_ref');
    }
}
