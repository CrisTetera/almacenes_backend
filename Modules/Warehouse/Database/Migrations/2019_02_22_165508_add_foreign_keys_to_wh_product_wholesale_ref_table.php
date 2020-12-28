<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToWhProductWholesaleRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_product_wholesale_ref', function (Blueprint $table) {
            $table->foreign('wh_product_id', 'fk_wh_product_wholesale_ref_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_branch_office_id', 'fk_wh_product_wholesale_ref_g_branch_office')->references('id')->on('g_branch_office')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_wholesale_ref_id', 'fk_wh_product_wholesale_ref_sl_wholesale_ref')->references('id')->on('sl_wholesale_ref')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_product_wholesale_ref', function (Blueprint $table) {
            $table->dropForeign('fk_wh_product_wholesale_ref_wh_product');
            $table->dropForeign('fk_wh_product_wholesale_ref_g_branch_office');
            $table->dropForeign('fk_wh_product_wholesale_ref_sl_wholesale_ref');
        });
    }
}
