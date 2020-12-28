<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhProductMovementReportTable extends Migration
{
    /**
     * Run the migrations. (create View SQL - virtual table)
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->dropView());
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }

    /**
     * Sql query for delete view with name 'meter_reading_reports' from DB
     * 
     * @return string with query
     */
    private function dropView(): string
    {
        return <<<SQL
                  DROP VIEW IF EXISTS wh_product_movement_report 
SQL;
    } // end function
    
    /**
     * Sql query for delete view with name 'meter_reading_reports' from DB
     * 
     * @return string with query
     */
    private function createView(): string
    {
        return <<<SQL
                CREATE VIEW wh_product_movement_report AS
                    SELECT 
                        wh_product_id,
                        date,
                        SUM(normal_sale_quantity) AS normal_sale_quantity,
                        SUM(ground_sale_quantity) AS ground_sale_quantity,
                        SUM(waste_quantity) AS waste_quantity,
                        SUM(adjust_quantity) AS adjust_quantity,
                        SUM(purchase_quantity) AS purchase_quantity
                    FROM (
                        -- Select Sales in Room
                        SELECT 
                            pos_detail_sale.wh_product_id AS wh_product_id,
                            pos_sale.created_at::timestamp::date AS date,
                            pos_detail_sale.quantity AS normal_sale_quantity,
                            0 AS ground_sale_quantity,
                            0 AS waste_quantity,
                            0 AS adjust_quantity,
                            0 AS purchase_quantity
                        FROM 
                            pos_detail_sale
                        INNER JOIN 
                            pos_sale
                        ON 
                            pos_detail_sale.pos_sale_id = pos_sale.id
                        WHERE 
                            pos_sale.g_state_id = 19 AND -- Sales Closed
                            pos_sale.pos_origin_sale_id = 1 AND -- Sales in Room
                            pos_sale.flag_delete = false
                        
                        UNION

                        -- Select Sales in Room
                        SELECT 
                            pos_detail_sale.wh_product_id AS wh_product_id,
                            pos_sale.created_at::timestamp::date AS date,
                            0 AS normal_sale_quantity,
                            pos_detail_sale.quantity AS ground_sale_quantity,
                            0 AS waste_quantity,
                            0 AS adjust_quantity,
                            0 AS purchase_quantity
                        FROM 
                            pos_detail_sale
                        INNER JOIN 
                            pos_sale
                        ON 
                            pos_detail_sale.pos_sale_id = pos_sale.id
                        WHERE 
                            pos_sale.g_state_id = 19 AND -- Sales Closed
                            pos_sale.pos_origin_sale_id = 2 AND -- Ground Sales
                            pos_sale.flag_delete = false

                        UNION

                        -- Select Adjust item
                        SELECT 
                            wh_product.id AS wh_product_id,
                            wh_stock_adjust.created_at::timestamp::date AS date,
                            0 AS normal_sale_quantity,
                            0 AS ground_sale_quantity,
                            0 AS waste_quantity,
                            wh_detail_stock_adjust.quantity_adjust AS adjust_quantity,
                            0 AS purchase_quantity
                        FROM 
                            wh_detail_stock_adjust
                        INNER JOIN 
                            wh_stock_adjust
                        ON 
                            wh_detail_stock_adjust.wh_stock_adjust_id = wh_stock_adjust.id
                        INNER JOIN 
                            wh_product
                        ON 
                            wh_detail_stock_adjust.wh_item_id = wh_product.wh_item_id
                        WHERE 
                            wh_stock_adjust.flag_delete = false
                        
                        UNION

                        -- Select Purchase products (reception products)
                        SELECT 
                            wh_detail_product_reception.wh_product_id AS wh_product_id,
                            wh_product_reception.created_at::timestamp::date AS date,
                            0 AS normal_sale_quantity,
                            0 AS ground_sale_quantity,
                            0 AS waste_quantity,
                            0 AS adjust_quantity,
                            wh_detail_product_reception.quantity AS purchase_quantity
                        FROM 
                            wh_detail_product_reception
                        INNER JOIN 
                            wh_product_reception
                        ON 
                            wh_detail_product_reception.wh_product_reception_id = wh_product_reception.id
                        WHERE 
                            wh_product_reception.flag_delete = false
                    ) AS wh_product_movement
                    GROUP BY wh_product_id, date
SQL;
    } // end function

}