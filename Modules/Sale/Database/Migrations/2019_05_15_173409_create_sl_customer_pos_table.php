<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlCustomerPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_customer_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut',10);
            $table->string('business_name');
            $table->string('alias_name')->nullable();
			$table->string('commercial_business', 500)->nullable();
            $table->string('address', 500)->nullable();
            $table->integer('g_commune_id')->index('sl_customer_pos_children_g_commune_pos_fk');
            $table->string('phone_number', 20)->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_company')->default(0);
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
        Schema::dropIfExists('sl_customer_pos');
    }
}
