<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhProductGBranchOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_product_g_branch_office', function (Blueprint $table) {
            $table->integer('wh_product_id')->index('wh_product_g_branch_office_wh_product_fk');
			$table->integer('g_branch_office_id')->index('wh_product_g_branch_office_g_branch_office_fk');
            $table->decimal('cost_price', 10, 2)->default(0);
            $table->decimal('gains_margin', 10, 2)->default(0);
            $table->decimal('minimum_stock', 10, 2)->default(0);
            $table->decimal('critical_stock', 10, 2)->default(0);
            $table->decimal('maximum_stock', 10, 2)->default(0);
			$table->primary(['wh_product_id','g_branch_office_id'], 'pk_wh_product_g_branch_office');
			$table->unique(['wh_product_id','g_branch_office_id'], 'wh_product_g_branch_office_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wh_product_g_branch_office');
    }
}
