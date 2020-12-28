<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosDetailPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_detail_pos', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('line_number');
            $table->integer('wh_warehouse_id')->index('pos_detail_pos_children_wh_warehouse_pos_fk');
            $table->integer('wh_product_id')->index('pos_detail_pos_children_wh_product_pos_fk');
            $table->integer('pos_sale_id')->index('pos_detail_pos_children_pos_sale_pos_fk');
            $table->integer('quantity');
            $table->integer('price');
            $table->decimal('net_price', 10, 2);
            $table->integer('net_subtotal');
			$table->integer('discount_percentage');
			$table->integer('discount_amount');
            $table->integer('new_net_subtotal');
            $table->integer('total');
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
        Schema::dropIfExists('pos_detail_pos');
    }
}
