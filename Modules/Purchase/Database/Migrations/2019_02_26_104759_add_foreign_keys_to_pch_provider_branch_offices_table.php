<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPchProviderBranchOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pch_provider_branch_offices', function (Blueprint $table) {
            $table->foreign('pch_provider_id', 'pch_provider_branch_offices_pch_provider_fk')->references('id')->on('pch_provider')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('g_commune_id', 'pch_provider_branch_offices_g_commune_fk')->references('id')->on('g_commune')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pch_provider_branch_offices', function (Blueprint $table) {
            $table->dropForeign('pch_provider_branch_offices_sl_customer_fk');
            $table->dropForeign('pch_provider_branch_offices_g_commune_fk');
        });
    }
}
