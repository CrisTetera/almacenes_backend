<?php

namespace Modules\Pos\Database\Seeders\local;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Modules\Pos\Services\PosSalePos\Entities\SaleConstant;

class PosSalePosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::table('pos_sale_pos')->delete();

        \DB::table('pos_sale_pos')->insert(array (
            0 =>
            array (
                // 'pos_customer_credit_option_id' => $faker->numberBetween(1, 3),
                'pos_sale_type_id' => SaleConstant::TICKET,
                'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                // 'g_seller_user_id' => 1,
                // 'g_supervisor_user_id' => 1,
                'g_cashier_id' => 1,
                // 'pos_cash_desk_id' => 1,
                // 'pos_manual_discount_id' => 1,
                // 'wh_sale_note_id' => 1,
                // 'sl_customer_branch_offices_id' => null,
                'sl_customer_id' => 1,
                // 'pos_sale_note_id' => 1,
                'net_subtotal' => 14706,
                'global_discount_amount' => 0,
                'global_discount_percentage' => 0,
                'new_net_subtotal' => 14706,
                'iva' => 2794,
                'ticket_total' => 17500,
                'invoice_total' => 17500,
                'exempt_total' => 0,
                'close_sale_datetime' => date('Y-m-d H:i:s'),
                'sl_ticket_id' => 1,
                'sl_invoice_id' => NULL,
                // 'pos_origin_sale_id' => $faker->numberBetween(1, 3),
                'flag_delete' => false,
            ),
            // (2) No se puede pagar esta venta, flag_delete = true
            1 =>
            array (
                // 'pos_customer_credit_option_id' => $faker->numberBetween(1, 3),
                'pos_sale_type_id' => $faker->numberBetween(1, 2),
                'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                // 'g_seller_user_id' => 1,
                // 'g_supervisor_user_id' => 1,
                'g_cashier_id' => 1,
                // 'pos_cash_desk_id' => 1,
                // 'pos_manual_discount_id' => 1,
                // 'wh_sale_note_id' => 1,
                // 'sl_customer_branch_offices_id' => null,
                'sl_customer_id' => 1,
                // 'pos_sale_note_id' => 1,
                'net_subtotal' => 14706,
                'global_discount_amount' => 0,
                'global_discount_percentage' => 0,
                'new_net_subtotal' => 14706,
                'iva' => 2794,
                'ticket_total' => 17500,
                'invoice_total' => 17500,
                'exempt_total' => 0,
                'close_sale_datetime' => date('Y-m-d H:i:s'),
                'sl_ticket_id' => 1,
                'sl_invoice_id' => NULL,
                // 'pos_origin_sale_id' => $faker->numberBetween(1, 3),
                'flag_delete' => true,
            ),
            //(3) No se puede pagar esta venta, está anulada
            2 =>
            array (
                // 'pos_customer_credit_option_id' => $faker->numberBetween(1, 3),
                'pos_sale_type_id' => $faker->numberBetween(1, 2),
                'g_state_id' => SaleConstant::SALE_STATE_ANULADA,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                // 'g_seller_user_id' => 3,
                // 'g_supervisor_user_id' => 1,
                'g_cashier_id' => 1,
                // 'pos_cash_desk_id' => 1,
                // 'pos_manual_discount_id' => 1,
                // 'wh_sale_note_id' => 1,
                // 'sl_customer_branch_offices_id' => null,
                'sl_customer_id' => 1,
                // 'pos_sale_note_id' => 1,
                'net_subtotal' => 14706,
                'global_discount_amount' => 0,
                'global_discount_percentage' => 0,
                'new_net_subtotal' => 14706,
                'iva' => 2794,
                'ticket_total' => 17500,
                'invoice_total' => 17500,
                'exempt_total' => 0,
                'close_sale_datetime' => date('Y-m-d H:i:s'),
                'sl_ticket_id' => 1,
                'sl_invoice_id' => NULL,
                // 'pos_origin_sale_id' => $faker->numberBetween(1, 3),
                'flag_delete' => false,
            ),
            // (4) No puede pagar esta venta, está realizada
            3 =>
            array (
                // 'pos_customer_credit_option_id' => $faker->numberBetween(1, 3),
                'pos_sale_type_id' => SaleConstant::TICKET,
                'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                // 'g_seller_user_id' => 4,
                // 'g_supervisor_user_id' => 1,
                'g_cashier_id' => 1,
                // 'pos_cash_desk_id' => 1,
                // 'pos_manual_discount_id' => 1,
                // 'wh_sale_note_id' => 1,
                // 'sl_customer_branch_offices_id' => null,
                'sl_customer_id' => 1,
                // 'pos_sale_note_id' => 1,
                'net_subtotal' => 14706,
                'global_discount_amount' => 0,
                'global_discount_percentage' => 0,
                'new_net_subtotal' => 14706,
                'iva' => 2794,
                'ticket_total' => 17500,
                'invoice_total' => 17500,
                'exempt_total' => 0,
                'close_sale_datetime' => date('Y-m-d H:i:s'),
                'sl_ticket_id' => 1,
                'sl_invoice_id' => NULL,
                // 'pos_origin_sale_id' => $faker->numberBetween(1, 3),
                'flag_delete' => false,
            ),
            // (5) OK, Pero la suma de los monto de pago a enviar debe ser distinto
            4 =>
            array (
                // 'pos_customer_credit_option_id' => $faker->numberBetween(1, 3),
                'pos_sale_type_id' => 1,
                'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                // 'g_seller_user_id' => 5,
                // 'g_supervisor_user_id' => 1,
                'g_cashier_id' => 1,
                // 'pos_cash_desk_id' => 1,
                // 'pos_manual_discount_id' => 1,
                // 'wh_sale_note_id' => 1,
                // 'sl_customer_branch_offices_id' => null,
                'sl_customer_id' => 1,
                // 'pos_sale_note_id' => 1,
                'net_subtotal' => 14706,
                'global_discount_amount' => 0,
                'global_discount_percentage' => 0,
                'new_net_subtotal' => 14706,
                'iva' => 2794,
                'ticket_total' => 17500,
                'invoice_total' => 17500,
                'exempt_total' => 0,
                'close_sale_datetime' => date('Y-m-d H:i:s'),
                'sl_ticket_id' => 1,
                'sl_invoice_id' => NULL,
                // 'pos_origin_sale_id' => $faker->numberBetween(1, 3),
                'flag_delete' => false,
            ),
            // (6) Se puede anular
            5 =>
            array (
                // 'pos_customer_credit_option_id' => $faker->numberBetween(1, 3),
                'pos_sale_type_id' => $faker->numberBetween(1, 2),
                'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                // 'g_seller_user_id' => 6,
                // 'g_supervisor_user_id' => 1,
                'g_cashier_id' => 1,
                // 'pos_cash_desk_id' => 1,
                // 'pos_manual_discount_id' => 1,
                // 'wh_sale_note_id' => 1,
                // 'sl_customer_branch_offices_id' => null,
                'sl_customer_id' => 1,
                // 'pos_sale_note_id' => 1,
                'net_subtotal' => 14706,
                'global_discount_amount' => 0,
                'global_discount_percentage' => 0,
                'new_net_subtotal' => 14706,
                'iva' => 2794,
                'ticket_total' => 17500,
                'invoice_total' => 17500,
                'exempt_total' => 0,
                'close_sale_datetime' => date('Y-m-d H:i:s'),
                'sl_ticket_id' => 1,
                'sl_invoice_id' => NULL,
                // 'pos_origin_sale_id' => $faker->numberBetween(1, 3),
                'flag_delete' => false,
            ),
            // (7) No puede anularse (ya está anulada)
            6 =>
            array (
                // 'pos_customer_credit_option_id' => $faker->numberBetween(1, 3),
                'pos_sale_type_id' => $faker->numberBetween(1, 2),
                'g_state_id' => SaleConstant::SALE_STATE_ANULADA,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                // 'g_seller_user_id' => 7,
                // 'g_supervisor_user_id' => 1,
                'g_cashier_id' => 1,
                // 'pos_cash_desk_id' => 1,
                // 'pos_manual_discount_id' => 1,
                // 'wh_sale_note_id' => 1,
                // 'sl_customer_branch_offices_id' => null,
                'sl_customer_id' => 1,
                // 'pos_sale_note_id' => 1,
                'net_subtotal' => 14706,
                'global_discount_amount' => 0,
                'global_discount_percentage' => 0,
                'new_net_subtotal' => 14706,
                'iva' => 2794,
                'ticket_total' => 17500,
                'invoice_total' => 17500,
                'exempt_total' => 0,
                'close_sale_datetime' => date('Y-m-d H:i:s'),
                'sl_ticket_id' => 1,
                'sl_invoice_id' => NULL,
                // 'pos_origin_sale_id' => $faker->numberBetween(1, 3),
                'flag_delete' => false,
            ),
            // (8) No puede anularse, ya se pagó la venta
            7 =>
            array (
                // 'pos_customer_credit_option_id' => $faker->numberBetween(1, 3),
                'pos_sale_type_id' => $faker->numberBetween(1, 2),
                'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                // 'g_seller_user_id' => 8,
                // 'g_supervisor_user_id' => 1,
                'g_cashier_id' => 1,
                // 'pos_cash_desk_id' => 1,
                // 'pos_manual_discount_id' => 1,
                // 'wh_sale_note_id' => 1,
                // 'sl_customer_branch_offices_id' => null,
                'sl_customer_id' => 1,
                // 'pos_sale_note_id' => 1,
                'net_subtotal' => 14706,
                'global_discount_amount' => 0,
                'global_discount_percentage' => 0,
                'new_net_subtotal' => 14706,
                'iva' => 2794,
                'ticket_total' => 17500,
                'invoice_total' => 17500,
                'exempt_total' => 0,
                'close_sale_datetime' => date('Y-m-d H:i:s'),
                'sl_ticket_id' => 1,
                'sl_invoice_id' => NULL,
                // 'pos_origin_sale_id' => $faker->numberBetween(1, 3),
                'flag_delete' => false,
            ),
            // (9) No puede anularse, la venta está eliminada
            8 =>
            array (
                // 'pos_customer_credit_option_id' => $faker->numberBetween(1, 3),
                'pos_sale_type_id' => $faker->numberBetween(1, 2),
                'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                // 'g_seller_user_id' => 9,
                // 'g_supervisor_user_id' => 1,
                'g_cashier_id' => 1,
                // 'pos_cash_desk_id' => 1,
                // 'pos_manual_discount_id' => 1,
                // 'wh_sale_note_id' => 1,
                // 'sl_customer_branch_offices_id' => null,
                'sl_customer_id' => 1,
                // 'pos_sale_note_id' => 1,
                'net_subtotal' => 14706,
                'global_discount_amount' => 0,
                'global_discount_percentage' => 0,
                'new_net_subtotal' => 14706,
                'iva' => 2794,
                'ticket_total' => 17500,
                'invoice_total' => 17500,
                'exempt_total' => 0,
                'close_sale_datetime' => date('Y-m-d H:i:s'),
                'sl_ticket_id' => 1,
                'sl_invoice_id' => NULL,
                // 'pos_origin_sale_id' => $faker->numberBetween(1, 3),
                'flag_delete' => true,
            ),
            // (10) Test pago, de Factura a Boleta (cliente debiese ser null)
            9 =>
            array (
                // 'pos_customer_credit_option_id' => $faker->numberBetween(1, 3),
                'pos_sale_type_id' => SaleConstant::INVOICE,
                'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                // 'g_seller_user_id' => 1,
                // 'g_supervisor_user_id' => 1,
                'g_cashier_id' => 1,
                // 'pos_cash_desk_id' => 1,
                // 'pos_manual_discount_id' => 1,
                // 'wh_sale_note_id' => 1,
                // 'sl_customer_branch_offices_id' => 1,
                'sl_customer_id' => 1,
                // 'pos_sale_note_id' => 1,
                'net_subtotal' => 14706,
                'global_discount_amount' => 0,
                'global_discount_percentage' => 0,
                'new_net_subtotal' => 14706,
                'iva' => 2794,
                'ticket_total' => 17500,
                'invoice_total' => 17500,
                'exempt_total' => 0,
                'close_sale_datetime' => null,
                'sl_ticket_id' => 1,
                'sl_invoice_id' => NULL,
                // 'pos_origin_sale_id' => $faker->numberBetween(1, 3),
                'flag_delete' => false,
            ),
            // (11) Test pago, sin cambios
            10 =>
            array (
                // 'pos_customer_credit_option_id' => $faker->numberBetween(1, 3),
                'pos_sale_type_id' => SaleConstant::TICKET,
                'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
                // 'g_branch_office_id' => $faker->numberBetween(1, 2),
                // 'g_seller_user_id' => 1,
                // 'g_supervisor_user_id' => 1,
                'g_cashier_id' => 1,
                // 'pos_cash_desk_id' => 1,
                // 'pos_manual_discount_id' => 1,
                // 'wh_sale_note_id' => 1,
                // 'sl_customer_branch_offices_id' => null,
                'sl_customer_id' => null,
                // 'pos_sale_note_id' => 1,
                'net_subtotal' => 14706,
                'global_discount_amount' => 0,
                'global_discount_percentage' => 0,
                'new_net_subtotal' => 14706,
                'iva' => 2794,
                'ticket_total' => 17500,
                'invoice_total' => 17500,
                'exempt_total' => 0,
                'close_sale_datetime' => null,
                'sl_ticket_id' => 1,
                'sl_invoice_id' => NULL,
                // 'pos_origin_sale_id' => $faker->numberBetween(1, 3),
                'flag_delete' => false,
            ),
        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pos_sale_pos')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);

    }
}
