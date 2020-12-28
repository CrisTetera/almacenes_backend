<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosTrustSalePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_trust_sale_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('pos_payment_method_id')->index('pos_trust_sale_pos_children_pos_payment_method_pos_fk');
            $table->bigInteger('pos_sale_id')->index('pos_trust_sale_pos_children_pos_sale_pos_fk');
            $table->bigInteger('sl_customer_id')->nullable()->index('pos_trust_sale_pos_children_sl_customer_pos_fk');
            $table->boolean('flag_is_payed')->default(0);
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
        Schema::dropIfExists('pos_trust_sale_pos');
    }
}
