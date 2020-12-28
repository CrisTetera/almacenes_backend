<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSlSaleQuotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sl_sale_quotation', function(Blueprint $table)
		{

			$table->foreign('sl_customer_id', 'fk_sl_customer_sl_sale_quotation')->references('id')->on('sl_customer')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sl_customer_branch_offices_id', 'fk_sl_customer_branch_offices_sl_sale_quotation')->references('id')->on('sl_customer_branch_offices')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pos_sale_type_id', 'fk_pos_sale_type_sl_sale_quotation')->references('id')->on('pos_sale_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_user_id', 'fk_g_user_sl_sale_quotation')->references('id')->on('g_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('g_branch_office_id', 'fk_g_branch_office_sl_sale_quotation')->references('id')->on('g_branch_office')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sl_sale_quotation', function(Blueprint $table)
		{
			$table->dropForeign('fk_sl_customer_sl_sale_quotation');
			$table->dropForeign('fk_sl_customer_branch_offices_sl_sale_quotation');
			$table->dropForeign('fk_pos_sale_type_sl_sale_quotation');
			$table->dropForeign('fk_g_user_sl_sale_quotation');
			$table->dropForeign('fk_g_branch_office_sl_sale_quotation');
		});
	}

}
