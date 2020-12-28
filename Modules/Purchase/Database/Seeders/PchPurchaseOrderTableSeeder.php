<?php

namespace Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Purchase\Entities\PchPaymentCondition;
use Modules\Purchase\Entities\PchPurchaseOrderState;

class PchPurchaseOrderTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pch_purchase_order')->delete();

        \DB::table('pch_purchase_order')->insert(array (
            0 =>
            array (
                'pch_provider_id' => 1,
                'pch_provider_branch_offices_id' => 1,
                'pch_payment_condition_id' => PchPaymentCondition::DAYS_30,
                'pch_purchase_order_state_id' => PchPurchaseOrderState::CREATED,
                'wh_warehouse_id' => 1,
                'g_originator_user_id' => 1,
                'g_authorizer_user_id' => null,
                'email_sended' => false,
                'observation' => 'Lorea el ipsum',
                'net_subtotal' => 5604,
                'iva' => 1065,
                'total' => 6669,
                'flag_delete' => false,
            ),
            1 =>
            array (
                'pch_provider_id' => 1,
                'pch_provider_branch_offices_id' => 1,
                'pch_payment_condition_id' => PchPaymentCondition::DAYS_60,
                'pch_purchase_order_state_id' => PchPurchaseOrderState::AUTHORIZED,
                'wh_warehouse_id' => 1,
                'g_originator_user_id' => 1,
                'g_authorizer_user_id' => 2,
                'email_sended' => false,
                'observation' => 'Lorea el ipsum',
                'net_subtotal' => 5604,
                'iva' => 1065,
                'total' => 6669,
                'flag_delete' => false,
            ),
            2 =>
            array (
                'pch_provider_id' => 1,
                'pch_provider_branch_offices_id' => 1,
                'pch_payment_condition_id' => PchPaymentCondition::DAYS_90,
                'pch_purchase_order_state_id' => PchPurchaseOrderState::PENDING_MAIL,
                'wh_warehouse_id' => 1,
                'g_originator_user_id' => 1,
                'g_authorizer_user_id' => 2,
                'email_sended' => false,
                'observation' => 'Lorea el ipsum',
                'net_subtotal' => 5604,
                'iva' => 1065,
                'total' => 6669,
                'flag_delete' => false,
            ),
            3 =>
            array (
                'pch_provider_id' => 1,
                'pch_provider_branch_offices_id' => 1,
                'pch_payment_condition_id' => PchPaymentCondition::DAYS_90,
                'pch_purchase_order_state_id' => PchPurchaseOrderState::IN_PROCESS,
                'wh_warehouse_id' => 1,
                'g_originator_user_id' => 1,
                'g_authorizer_user_id' => 2,
                'email_sended' => true,
                'observation' => 'Lorea el ipsum',
                'net_subtotal' => 5604,
                'iva' => 1065,
                'total' => 6669,
                'flag_delete' => false,
            ),
            4 =>
            array (
                'pch_provider_id' => 1,
                'pch_provider_branch_offices_id' => 1,
                'pch_payment_condition_id' => PchPaymentCondition::ANTICIPATED,
                'pch_purchase_order_state_id' => PchPurchaseOrderState::RECEIVED,
                'wh_warehouse_id' => 1,
                'g_originator_user_id' => 1,
                'g_authorizer_user_id' => 2,
                'email_sended' => true,
                'observation' => 'Lorea el ipsum',
                'net_subtotal' => 5604,
                'iva' => 1065,
                'total' => 6669,
                'flag_delete' => false,
            ),

        ));

        $now = \Carbon\Carbon::now();
        \DB::table('pch_purchase_order')->update([
            'created_at' => $now,
            'updated_at' => $now
        ]);


    }
}
