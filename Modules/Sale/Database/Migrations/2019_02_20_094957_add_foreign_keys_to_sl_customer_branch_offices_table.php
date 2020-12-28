<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSlCustomerBranchOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sl_customer_branch_offices', function (Blueprint $table) {
            $table->foreign('sl_customer_id', 'sl_customer_branch_offices_sl_customer_fk')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('g_commune_id', 'sl_customer_branch_offices_g_commune_fk')->references('id')->on('g_commune')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sl_customer_branch_offices', function (Blueprint $table) {
            $table->dropForeign('sl_customer_branch_offices_sl_customer_fk');
            $table->dropForeign('sl_customer_branch_offices_g_commune_fk');
        });
    }
}
