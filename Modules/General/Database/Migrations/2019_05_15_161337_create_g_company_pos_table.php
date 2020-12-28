<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGCompanyPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_company_pos', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('rut',10);
            $table->string('business_name');
			$table->string('state', 100);
			$table->string('commercial_business', 500);
            $table->integer('commercial_activity_code');
            $table->string('address', 500);
            $table->integer('g_commune_id')->index('g_company_pos_children_g_commune_pos_fk');
            $table->string('api_key_open_factura', 500)->default('928e15a2d14d4a6292345f04960f4bd3');
            $table->string('sii_branch_office_sii', 20)->default('81303347');
			$table->string('path_icon', 1000)->nullable();
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
        Schema::dropIfExists('g_company_pos');
    }
}
