<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlWholesaleDiscountFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_wholesale_discount_family', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wh_family_id')->index('sl_wholesale_discount_family_wh_family_fk');
			$table->integer('g_branch_office_id')->index('sl_wholesale_discount_family_g_branch_office_fk');
			$table->integer('quantity_discount');
			$table->integer('percentage_discount');
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
        Schema::dropIfExists('sl_wholesale_discount_family');
    }
}
