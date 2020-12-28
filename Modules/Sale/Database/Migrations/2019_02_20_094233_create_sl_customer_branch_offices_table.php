<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlCustomerBranchOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sl_customer_branch_offices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sl_customer_id')->nullable()->index('sl_customer_branch_offices_sl_customer_fk');
            $table->string('address', 255);
            $table->string('phone', 50);
			$table->string('email', 100);
			$table->integer('g_commune_id')->default(26)->index('sl_customer_branch_offices_g_commune_fk');
            $table->boolean('default_branch_office')->default(0);
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
        Schema::dropIfExists('sl_customer_branch_offices');
    }
}
