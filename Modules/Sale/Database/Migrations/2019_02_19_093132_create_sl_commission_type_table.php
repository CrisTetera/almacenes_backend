<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlCommissionTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_commission_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10)->unique(); // CÓDIGO ÚNICO PARA CADA UNO
            $table->string('type', 60);
            $table->string('description', 500)->default('');
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
        Schema::dropIfExists('sl_commission_type');
    }
}
