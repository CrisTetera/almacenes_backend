<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlDetailSaleTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_detail_sale_ticket', function(Blueprint $table)
		{
			$table->foreign('wh_product_id', 'fk_sl_detail_sale_ticket_wh_product')->references('id')->on('wh_product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_sale_ticket_id', 'fk_sl_sale_ticket_sl_detail_sale_ticket')->references('id')->on('sl_sale_ticket')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_detail_sale_ticket', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_detail_sale_ticket_wh_product');
			$table->dropForeign('fk_sl_sale_ticket_sl_detail_sale_ticket');
		});
	}

}
