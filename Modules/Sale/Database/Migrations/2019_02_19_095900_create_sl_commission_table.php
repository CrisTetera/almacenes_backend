<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlCommissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_commission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sl_commission_type_id')->nullable()->index('sl_commission_sl_commission_type_fk');
            $table->string('name', 80);
            $table->string('description', 500)->default('');
            $table->decimal('percentage', 10, 2);
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
        Schema::dropIfExists('sl_commission');
    }
}
