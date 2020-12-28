<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhProductPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_product_pos', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('wh_item_id')->nullable()->index('wh_product_pos_children_wh_item_pos_fk');
            $table->integer('wh_promo_id')->nullable()->index('wh_product_pos_children_wh_promo_pos_fk');
            $table->integer('wh_pack_id')->nullable()->index('wh_product_pos_children_wh_pack_pos_fk');
            $table->string('upc', 20);
            $table->string('name');
            $table->string('description', 500)->default('');
            $table->string('path_logo', 500)->default('');
            $table->boolean('is_tax_free'); // Exento de IVA
            $table->integer('wh_subfamily_id')->nullable()->index('wh_product_pos_children_wh_subfamily_pos_fk');
            $table->decimal('cost_price');
            $table->decimal('gains_margin');
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
        Schema::dropIfExists('wh_product_pos');
    }
}
