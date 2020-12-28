<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPosTrustSalePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_trust_sale_pos', function (Blueprint $table) {
            $table->foreign('pos_payment_method_id', 'pos_trust_sale_pos_children_pos_payment_method_pos_fk')->references('id')->on('pos_payment_method_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('pos_sale_id', 'pos_trust_sale_pos_children_pos_sale_pos_fk')->references('id')->on('pos_sale_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sl_customer_id', 'pos_trust_sale_pos_children_sl_customer_pos_fk')->references('id')->on('sl_customer_pos')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_trust_sale_pos', function (Blueprint $table) {
            $table->dropForeign('pos_trust_sale_pos_children_pos_payment_method_pos_fk');
            $table->dropForeign('pos_trust_sale_pos_children_pos_sale_pos_fk');
            $table->dropForeign('pos_trust_sale_pos_children_sl_customer_pos_fk');

        });
    }
}
