<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlWholesaleDiscountFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_wholesale_discount_family', function (Blueprint $table) {
            $table->foreign('g_branch_office_id', 'fk_sl_wholesale_discount_family_g_branch_office')->references('id')->on('g_branch_office')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('wh_family_id', 'fk_sl_wholesale_discount_family_wh_family')->references('id')->on('wh_family')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_wholesale_discount_family', function (Blueprint $table) {
            $table->dropForeign('fk_sl_wholesale_discount_family_g_branch_office');
            $table->dropForeign('fk_sl_wholesale_discount_family_wh_family');
        });
    }
}
