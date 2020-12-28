<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlWholesaleDiscountSubfamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_wholesale_discount_subfamily', function (Blueprint $table) {
            $table->foreign('g_branch_office_id', 'fk_sl_wholesale_discount_subfamily_g_branch_office')->references('id')->on('g_branch_office')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_subfamily_id', 'fk_sl_wholesale_discount_subfamily_wh_subfamily')->references('id')->on('wh_subfamily')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_wholesale_discount_subfamily', function (Blueprint $table) {
            $table->dropForeign('fk_sl_wholesale_discount_subfamily_g_branch_office');
            $table->dropForeign('fk_sl_wholesale_discount_subfamily_wh_subfamily');
        });
    }
}
