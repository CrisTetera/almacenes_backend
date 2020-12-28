<?php

$factory->define(App\Models\AuditHistoricPrice::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'sl_list_price_id' => function () {
             return factory(App\Models\SlListPrice::class)->create()->id;
        },
        'init_datetime' => $faker->date(),
        'finish_datetime' => $faker->date(),
    ];
});

$factory->define(App\Models\AuditSendedEmailLogs::class, function (Faker\Generator $faker) {
    return [
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'email_sender' => $faker->word,
        'email_receiver' => $faker->word,
    ];
});

$factory->define(App\Models\AuditSystemLogs::class, function (Faker\Generator $faker) {
    return [
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'action' => $faker->word,
    ];
});

$factory->define(App\Models\GBank::class, function (Faker\Generator $faker) {
    return [
        'bank' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\GBranchOffice::class, function (Faker\Generator $faker) {
    return [
        'g_company_id' => function () {
             return factory(App\Models\GCompany::class)->create()->id;
        },
        'address' => $faker->word,
        'flag_detete' => $faker->boolean,
    ];
});

$factory->define(App\Models\GCommune::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'g_province_id' => function () {
             return factory(App\Models\GProvince::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\GCompany::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'state' => $faker->word,
        'commercial_business' => $faker->word,
        'path_icon' => $faker->word,
    ];
});

$factory->define(App\Models\GProvince::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'g_region_id' => function () {
             return factory(App\Models\GRegion::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\GRegion::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'iso_3166_2_cl' => $faker->word,
    ];
});

$factory->define(App\Models\GState::class, function (Faker\Generator $faker) {
    return [
        'g_state_type_id' => function () {
             return factory(App\Models\GStateType::class)->create()->id;
        },
        'state' => $faker->word,
        'state_sequence' => $faker->randomNumber(),
    ];
});

$factory->define(App\Models\GStateType::class, function (Faker\Generator $faker) {
    return [
        'state_type' => $faker->word,
    ];
});

$factory->define(App\Models\GSystemConfiguration::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(App\Models\GTypeAccountBank::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word,
    ];
});

$factory->define(App\Models\GUser::class, function (Faker\Generator $faker) {
    return [
        'last_name1' => $faker->word,
        'last_name2' => $faker->word,
        'email' => $faker->safeEmail,
        'password' => bcrypt($faker->password),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\PasswordResets::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'token' => $faker->word,
    ];
});

$factory->define(App\Models\PchDetailProviderPaymentSheet::class, function (Faker\Generator $faker) {
    return [
        'pch_provider_payment_id' => function () {
             return factory(App\Models\PchProviderPayment::class)->create()->id;
        },
        'pch_provider_account_bank_id' => function () {
             return factory(App\Models\PchProviderAccountBank::class)->create()->id;
        },
        'pch_provider_payment_id2' => $faker->randomNumber(),
        'pch_provider_account_id' => function () {
             return factory(App\Models\PchProviderAccount::class)->create()->id;
        },
        'pch_provider_payment_sheet_id' => function () {
             return factory(App\Models\PchProviderPaymentSheet::class)->create()->id;
        },
        'amount' => $faker->randomFloat(),
    ];
});

$factory->define(App\Models\PchDetailPurchaseCreditNote::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'pch_purchase_credit_note_id' => function () {
             return factory(App\Models\PchPurchaseCreditNote::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'detail' => $faker->word,
        'discount_or_surcharge3' => $faker->randomFloat(),
    ];
});

$factory->define(App\Models\PchDetailPurchaseDebitNote::class, function (Faker\Generator $faker) {
    return [
        'pch_purchase_debit_note_id' => function () {
             return factory(App\Models\PchPurchaseDebitNote::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'detail' => $faker->word,
        'discount_or_surcharge3' => $faker->randomFloat(),
        'subtotal' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PchDetailPurchaseInvoice::class, function (Faker\Generator $faker) {
    return [
        'pch_purchase_invoice_id' => function () {
             return factory(App\Models\PchPurchaseInvoice::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'discount_or_surcharge3' => $faker->randomFloat(),
    ];
});

$factory->define(App\Models\PchDetailPurchaseQuotation::class, function (Faker\Generator $faker) {
    return [
        'pch_purchase_quotation_id' => function () {
             return factory(App\Models\PchPurchaseQuotation::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'detail' => $faker->word,
        'discount_or_charge' => $faker->randomFloat(),
        'subtotal' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PchProvider::class, function (Faker\Generator $faker) {
    $communesIds = App\Models\Commune::all()->pluck('id')->toArray();

    return [
        'pch_provider_account_id' => $faker->randomNumber(),
        'g_commune_id' => $faker->randomElement($communesIds),
        'pch_provider_account_id2' => function () {
             return factory(App\Models\PchProviderAccount::class)->create()->id;
        },
        'rut' => $faker->word,
        'business_name' => $faker->word,
        'phone' => $faker->phoneNumber,
    ];
});

$factory->define(App\Models\PchProviderAccount::class, function (Faker\Generator $faker) {
    return [
        'pch_provider_id' => function () {
             return factory(App\Models\PchProvider::class)->create()->id;
        },
        'debt_to_pay' => $faker->randomFloat(),
        'pch_provider_account_id2' => function () {
             return factory(App\Models\PchProvider::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\PchProviderAccountBank::class, function (Faker\Generator $faker) {
    return [
        'pch_provider_id' => function () {
             return factory(App\Models\PchProvider::class)->create()->id;
        },
        'g_bank_id' => function () {
             return factory(App\Models\GBank::class)->create()->id;
        },
        'pch_provider_id2' => $faker->randomNumber(),
        'g_type_account_bank_id' => function () {
             return factory(App\Models\GTypeAccountBank::class)->create()->id;
        },
        'account_number' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PchProviderAccountMovement::class, function (Faker\Generator $faker) {
    return [
        'pch_type_provider_account_movement_id' => function () {
             return factory(App\Models\PchTypeProviderAccountMovement::class)->create()->id;
        },
        'pch_provider_account_id' => function () {
             return factory(App\Models\PchProviderAccount::class)->create()->id;
        },
        'pch_provider_payment_id' => function () {
             return factory(App\Models\PchProviderPayment::class)->create()->id;
        },
        'pch_purchase_credit_note_id' => function () {
             return factory(App\Models\PchPurchaseCreditNote::class)->create()->id;
        },
        'pch_purchase_debit_note_id' => function () {
             return factory(App\Models\PchPurchaseDebitNote::class)->create()->id;
        },
        'pch_purchase_invoice_id' => function () {
             return factory(App\Models\PchPurchaseInvoice::class)->create()->id;
        },
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PchProviderDebtToPay::class, function (Faker\Generator $faker) {
    return [
        'pch_purchase_invoice_id' => function () {
             return factory(App\Models\PchPurchaseInvoice::class)->create()->id;
        },
        'pch_provider_account_id' => function () {
             return factory(App\Models\PchProviderAccount::class)->create()->id;
        },
        'date_to_pay' => $faker->date(),
        'flag_delete' => $faker->boolean,
        'fee_number' => $faker->randomNumber(),
        'total_paid' => $faker->randomFloat(),
        'flag_paid' => $faker->boolean,
    ];
});

$factory->define(App\Models\PchProviderDebtToPayPchDetailProviderPaymentSheet::class, function (Faker\Generator $faker) {
    return [
        'pch_detail_provider_payment_sheet_id' => function () {
             return factory(App\Models\PchDetailProviderPaymentSheet::class)->create()->id;
        },
        'pch_provider_debt_to_pay_id' => function () {
             return factory(App\Models\PchProviderDebtToPay::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\PchProviderPayment::class, function (Faker\Generator $faker) {
    return [
        'pch_detail_provider_payment_sheet_id' => function () {
             return factory(App\Models\PchDetailProviderPaymentSheet::class)->create()->id;
        },
        'pch_provider_account_movement_id' => function () {
             return factory(App\Models\PchProviderAccountMovement::class)->create()->id;
        },
        'date_payment' => $faker->date(),
        'amount_paid' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PchProviderPaymentSheet::class, function (Faker\Generator $faker) {
    return [
        'amount_to_pay' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PchPurchaseCreditNote::class, function (Faker\Generator $faker) {
    $communesIds = App\Models\Commune::all()->pluck('id')->toArray();

    return [
        'pch_purchase_invoice_id' => function () {
             return factory(App\Models\PchPurchaseInvoice::class)->create()->id;
        },
        'g_commune_id' => $faker->randomElement($communesIds),
        'pch_provider_account_movement_id' => function () {
             return factory(App\Models\PchProviderAccountMovement::class)->create()->id;
        },
        'number' => $faker->word,
        'core_business' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PchPurchaseDebitNote::class, function (Faker\Generator $faker) {
    $communesIds = App\Models\Commune::all()->pluck('id')->toArray();
    
    return [
        'pch_purchase_invoice_id' => function () {
             return factory(App\Models\PchPurchaseInvoice::class)->create()->id;
        },
        'g_commune_id' => $faker->randomElement($communesIds),
        'pch_provider_account_movement_id' => function () {
             return factory(App\Models\PchProviderAccountMovement::class)->create()->id;
        },
        'number' => $faker->word,
        'core_business' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PchPurchaseInvoice::class, function (Faker\Generator $faker) {
    $communesIds = App\Models\Commune::all()->pluck('id')->toArray();

    return [
        'pch_provider_id' => function () {
             return factory(App\Models\PchProvider::class)->create()->id;
        },
        'g_commune_id' => $faker->randomElement($communesIds),
        'pch_provider_account_movement_id' => function () {
             return factory(App\Models\PchProviderAccountMovement::class)->create()->id;
        },
        'contact' => $faker->word,
        'flag_delete' => $faker->boolean,
        'subtotal' => $faker->randomFloat(),
        'dicount_or_charge' => $faker->randomFloat(),
        'new_subtotal' => $faker->randomFloat(),
        'iva' => $faker->randomFloat(),
        'total' => $faker->randomFloat(),
    ];
});

$factory->define(App\Models\PchPurchaseOrder::class, function (Faker\Generator $faker) {
    return [
        'pch_provider_id' => function () {
             return factory(App\Models\PchProvider::class)->create()->id;
        },
        'g_state_id' => function () {
             return factory(App\Models\GState::class)->create()->id;
        },
        'wh_product_reception_id' => function () {
             return factory(App\Models\WhProductReception::class)->create()->id;
        },
        'description' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PchPurchaseOrderWhOrderer::class, function (Faker\Generator $faker) {
    return [
        'wh_orderer_id' => function () {
             return factory(App\Models\WhOrderer::class)->create()->id;
        },
        'pch_purchase_order_id' => function () {
             return factory(App\Models\PchPurchaseOrder::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\PchPurchaseQuotation::class, function (Faker\Generator $faker) {
    return [
        'pch_provider_id' => function () {
             return factory(App\Models\PchProvider::class)->create()->id;
        },
        'g_state_id' => function () {
             return factory(App\Models\GState::class)->create()->id;
        },
        'description' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PchTypeProviderAccountMovement::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word,
    ];
});

$factory->define(App\Models\PosCashDesk::class, function (Faker\Generator $faker) {
    return [
        'g_branch_office_id' => function () {
             return factory(App\Models\GBranchOffice::class)->create()->id;
        },
        'number' => $faker->word,
        'name' => $faker->name,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosCashMovement::class, function (Faker\Generator $faker) {
    return [
        'pos_cash_movement_egress_type_id' => function () {
             return factory(App\Models\PosCashMovementEgressType::class)->create()->id;
        },
        'pos_cash_movement_ingress_type_id' => function () {
             return factory(App\Models\PosCashMovementIngressType::class)->create()->id;
        },
        'pos_cash_desk_id' => function () {
             return factory(App\Models\PosCashDesk::class)->create()->id;
        },
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'amount' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosCashMovementEgressType::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word,
    ];
});

$factory->define(App\Models\PosCashMovementIngressType::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word,
    ];
});

$factory->define(App\Models\PosCustomerCreditOption::class, function (Faker\Generator $faker) {
    return [
        'credit_option' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosDailyCash::class, function (Faker\Generator $faker) {
    return [
        'pos_cash_desk_id' => function () {
             return factory(App\Models\PosCashDesk::class)->create()->id;
        },
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'g_user_id2' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'g_state_id' => function () {
             return factory(App\Models\GState::class)->create()->id;
        },
        'opening_timestamp' => $faker->date(),
        'closure_timestamp' => $faker->date(),
        'ingress_total' => $faker->randomFloat(),
        'sale_with_cash_total' => $faker->randomFloat(),
        'sale_with_card_total' => $faker->randomFloat(),
        'ingress_cash_movement_total' => $faker->randomFloat(),
        'egress_total' => $faker->randomFloat(),
        'egress_cash_movement_total' => $faker->randomFloat(),
        'estimated_cash_total' => $faker->randomFloat(),
        'real_cash_total' => $faker->randomFloat(),
        'difference' => $faker->randomFloat(),
        'sale_with_check_total' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosDetailEmployeeSale::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'pos_employee_sale_id' => function () {
             return factory(App\Models\PosEmployeeSale::class)->create()->id;
        },
        'subtotal' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosDetailInternalConsumption::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'pos_internal_consumption_id' => function () {
             return factory(App\Models\PosInternalConsumption::class)->create()->id;
        },
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosDetailSale::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'pos_sale_id' => function () {
             return factory(App\Models\PosSale::class)->create()->id;
        },
        'discount_or_charge' => $faker->randomFloat(),
        'subtotal' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosDetailSaleNote::class, function (Faker\Generator $faker) {
    return [
        'pos_sale_note_id' => function () {
             return factory(App\Models\PosSaleNote::class)->create()->id;
        },
        'discount_or_charge' => $faker->randomFloat(),
        'subtotal' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosEmployeeSale::class, function (Faker\Generator $faker) {
    return [
        'pos_employee_sale_payment_type_id' => function () {
             return factory(App\Models\PosEmployeeSalePaymentType::class)->create()->id;
        },
        'g_user_id' => $faker->randomNumber(),
        'g_user_id2' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'pos_cash_desk_id' => function () {
             return factory(App\Models\PosCashDesk::class)->create()->id;
        },
        'g_state_id' => function () {
             return factory(App\Models\GState::class)->create()->id;
        },
        'subtotal' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'new_subtotal' => $faker->randomFloat(),
        'iva' => $faker->randomFloat(),
        'total' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
        'g_user_cashier_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\PosEmployeeSalePaymentType::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosInternalConsumption::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosManualDiscount::class, function (Faker\Generator $faker) {
    return [
        'pos_employee_sale_id' => function () {
             return factory(App\Models\PosEmployeeSale::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'percentage_discount' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosSale::class, function (Faker\Generator $faker) {
    return [
        'pos_customer_credit_option_id' => function () {
             return factory(App\Models\PosCustomerCreditOption::class)->create()->id;
        },
        'pos_sale_type_id' => function () {
             return factory(App\Models\PosSaleType::class)->create()->id;
        },
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'pos_cash_desk_id' => function () {
             return factory(App\Models\PosCashDesk::class)->create()->id;
        },
        'pos_manual_discount_id' => function () {
             return factory(App\Models\PosManualDiscount::class)->create()->id;
        },
        'wh_sale_note_id' => function () {
             return factory(App\Models\WhSaleNote::class)->create()->id;
        },
        'sl_customer_id' => function () {
             return factory(App\Models\SlCustomer::class)->create()->id;
        },
        'pos_sale_note_id' => function () {
             return factory(App\Models\PosSaleNote::class)->create()->id;
        },
        'subtotal' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'new_subtotal' => $faker->randomFloat(),
        'iva' => $faker->randomFloat(),
        'total' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosSaleNote::class, function (Faker\Generator $faker) {
    return [
        'pos_sale_id' => function () {
             return factory(App\Models\PosSale::class)->create()->id;
        },
        'number' => $faker->word,
        'emission_date' => $faker->date(),
        'subtotal' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'new_subtotal' => $faker->randomFloat(),
        'total' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\PosSalePaymentType::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word,
    ];
});

$factory->define(App\Models\PosSalePosPaymentType::class, function (Faker\Generator $faker) {
    return [
        'pos_sale_payment_type_id' => function () {
             return factory(App\Models\PosSalePaymentType::class)->create()->id;
        },
        'pos_sale_id' => function () {
             return factory(App\Models\PosSale::class)->create()->id;
        },
        'amount' => $faker->randomFloat(),
    ];
});

$factory->define(App\Models\PosSaleType::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word,
    ];
});

$factory->define(App\Models\SlChangeSalePrice::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'old_sale_price' => $faker->randomFloat(),
        'new_sale_price' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlCheck::class, function (Faker\Generator $faker) {
    return [
        'g_bank_id' => function () {
             return factory(App\Models\GBank::class)->create()->id;
        },
        'sl_customer_id' => function () {
             return factory(App\Models\SlCustomer::class)->create()->id;
        },
        'number' => $faker->word,
        'amount' => $faker->randomFloat(),
        'place' => $faker->word,
        'date' => $faker->date(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlCustomer::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_account_id' => function () {
             return factory(App\Models\SlCustomerAccount::class)->create()->id;
        },
        'rut' => $faker->word,
        'business_name' => $faker->word,
        'person_name' => $faker->word,
        'core_business' => $faker->word,
        'address' => $faker->word,
        'phone' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlCustomerAccount::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_id' => function () {
             return factory(App\Models\SlCustomer::class)->create()->id;
        },
        'debt_amount' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlCustomerAccountBank::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_id' => function () {
             return factory(App\Models\SlCustomer::class)->create()->id;
        },
        'g_bank_id' => function () {
             return factory(App\Models\GBank::class)->create()->id;
        },
        'g_type_account_bank_id' => function () {
             return factory(App\Models\GTypeAccountBank::class)->create()->id;
        },
        'number' => $faker->word,
        'rut' => $faker->word,
        'email' => $faker->safeEmail,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlCustomerAccountMovement::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_account_id' => function () {
             return factory(App\Models\SlCustomerAccount::class)->create()->id;
        },
        'sl_type_customer_account_movement_id' => function () {
             return factory(App\Models\SlTypeCustomerAccountMovement::class)->create()->id;
        },
        'sl_customer_payment_id' => function () {
             return factory(App\Models\SlCustomerPayment::class)->create()->id;
        },
        'sl_sale_invoice_id' => function () {
             return factory(App\Models\SlSaleInvoice::class)->create()->id;
        },
        'sl_sale_credit_note_id' => function () {
             return factory(App\Models\SlSaleCreditNote::class)->create()->id;
        },
        'sl_sale_debit_note_id' => function () {
             return factory(App\Models\SlSaleDebitNote::class)->create()->id;
        },
        'amount' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlCustomerAccountReceivable::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_account_id' => function () {
             return factory(App\Models\SlCustomerAccount::class)->create()->id;
        },
        'sl_sale_invoice_id' => function () {
             return factory(App\Models\SlSaleInvoice::class)->create()->id;
        },
        'amount' => $faker->randomFloat(),
        'pay_date' => $faker->date(),
        'real_pay_date' => $faker->date(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlCustomerAccountReceivableSlDetailCustomerChangeSheet::class, function (Faker\Generator $faker) {
    return [
        'sl_detail_customer_charge_sheet_id' => function () {
             return factory(App\Models\SlDetailCustomerChargeSheet::class)->create()->id;
        },
        'sl_customer_account_receivable_id' => function () {
             return factory(App\Models\SlCustomerAccountReceivable::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\SlCustomerChargeSheet::class, function (Faker\Generator $faker) {
    return [
        'amount' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlCustomerPayment::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_account_movement_id' => function () {
             return factory(App\Models\SlCustomerAccountMovement::class)->create()->id;
        },
        'sl_detail_customer_charge_sheet_id' => function () {
             return factory(App\Models\SlDetailCustomerChargeSheet::class)->create()->id;
        },
        'sl_electronic_transfer_payment_id' => function () {
             return factory(App\Models\SlElectronicTransferPayment::class)->create()->id;
        },
        'amount' => $faker->randomFloat(),
        'pay_date' => $faker->date(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlCustomerPresetsDiscount::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_id' => function () {
             return factory(App\Models\SlCustomer::class)->create()->id;
        },
        'discount_percentage' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlDetailCustomerChargeSheet::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_charge_sheet_id' => function () {
             return factory(App\Models\SlCustomerChargeSheet::class)->create()->id;
        },
        'sl_customer_account_id' => function () {
             return factory(App\Models\SlCustomerAccount::class)->create()->id;
        },
        'amount' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlDetailListPrice::class, function (Faker\Generator $faker) {
    return [
        'sl_list_price_id' => function () {
             return factory(App\Models\SlListPrice::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'cost_price' => $faker->randomFloat(),
        'sale_price' => $faker->randomFloat(),
    ];
});

$factory->define(App\Models\SlDetailSaleCreditNote::class, function (Faker\Generator $faker) {
    return [
        'sl_sale_credit_note_id' => function () {
             return factory(App\Models\SlSaleCreditNote::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'subtotal' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlDetailSaleDebitNote::class, function (Faker\Generator $faker) {
    return [
        'sl_sale_debit_note_id' => function () {
             return factory(App\Models\SlSaleDebitNote::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'subtotal' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlDetailSaleInvoice::class, function (Faker\Generator $faker) {
    return [
        'sl_sale_invoice_id' => function () {
             return factory(App\Models\SlSaleInvoice::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'subtotal' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlDetailSaleQuotation::class, function (Faker\Generator $faker) {
    return [
        'sl_sale_quotation_id' => function () {
             return factory(App\Models\SlSaleQuotation::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'subtotal' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlDetailSaleTicket::class, function (Faker\Generator $faker) {
    return [
        'sl_sale_ticket_id' => function () {
             return factory(App\Models\SlSaleTicket::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'dicount_or_charge' => $faker->randomFloat(),
        'subtotal' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlElectronicTransferPayment::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_account_bank_id' => function () {
             return factory(App\Models\SlCustomerAccountBank::class)->create()->id;
        },
        'sl_customer_payment_id' => function () {
             return factory(App\Models\SlCustomerPayment::class)->create()->id;
        },
        'number' => $faker->word,
        'amount' => $faker->randomFloat(),
        'transfer_date' => $faker->date(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlListPrice::class, function (Faker\Generator $faker) {
    return [
        'g_branch_office_id' => function () {
             return factory(App\Models\GBranchOffice::class)->create()->id;
        },
        'name' => $faker->name,
        'description' => $faker->word,
        'is_active' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlOffer::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'g_branch_office_id' => function () {
             return factory(App\Models\GBranchOffice::class)->create()->id;
        },
        'offer_price' => $faker->randomFloat(),
        'init_datetime' => $faker->date(),
        'finish_datetime' => $faker->date(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlSaleCreditNote::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_account_movement_id' => function () {
             return factory(App\Models\SlCustomerAccountMovement::class)->create()->id;
        },
        'sl_customer_id' => function () {
             return factory(App\Models\SlCustomer::class)->create()->id;
        },
        'sl_service_order_id' => function () {
             return factory(App\Models\SlServiceOrder::class)->create()->id;
        },
        'number' => $faker->word,
        'emission_date' => $faker->date(),
        'subtotal' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'new_subtotal' => $faker->randomFloat(),
        'iva' => $faker->randomFloat(),
        'total' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlSaleDebitNote::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_account_movement_id' => function () {
             return factory(App\Models\SlCustomerAccountMovement::class)->create()->id;
        },
        'sl_customer_id' => function () {
             return factory(App\Models\SlCustomer::class)->create()->id;
        },
        'number' => $faker->word,
        'emission_date' => $faker->date(),
        'subtotal' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'new_subtotal' => $faker->randomFloat(),
        'iva' => $faker->randomFloat(),
        'total' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlSaleInvoice::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_account_movement_id' => function () {
             return factory(App\Models\SlCustomerAccountMovement::class)->create()->id;
        },
        'sl_service_order_id' => function () {
             return factory(App\Models\SlServiceOrder::class)->create()->id;
        },
        'sl_customer_id' => function () {
             return factory(App\Models\SlCustomer::class)->create()->id;
        },
        'number' => $faker->word,
        'emission_date' => $faker->date(),
        'subtotal' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'new_subtotal' => $faker->randomFloat(),
        'iva' => $faker->randomFloat(),
        'total' => $faker->randomFloat(),
        'was_replaced' => $faker->boolean,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlSaleQuotation::class, function (Faker\Generator $faker) {
    return [
        'sl_customer_id' => function () {
             return factory(App\Models\SlCustomer::class)->create()->id;
        },
        'number' => $faker->word,
        'emission_date' => $faker->date(),
        'subtotal' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'new_subtotal' => $faker->randomFloat(),
        'total' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\SlSaleTicket::class, function (Faker\Generator $faker) {
    return [
        'sl_service_order_id' => $faker->randomNumber(),
        'sl_service_order_id2' => function () {
             return factory(App\Models\SlServiceOrder::class)->create()->id;
        },
        'sl_customer_id' => function () {
             return factory(App\Models\SlCustomer::class)->create()->id;
        },
        'number' => $faker->word,
        'emission_date' => $faker->date(),
        'subtotal' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'new_subtotal' => $faker->randomFloat(),
        'total' => $faker->randomFloat(),
        'was_replaced' => $faker->boolean,
        'flag_delete' => $faker->boolean,
        'sl_service_order_as_affected_id' => function () {
             return factory(App\Models\SlServiceOrder::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\SlServiceOrder::class, function (Faker\Generator $faker) {
    return [
        'sl_sale_invoice_id' => $faker->randomNumber(),
        'sl_sale_invoice_id2' => function () {
             return factory(App\Models\SlSaleInvoice::class)->create()->id;
        },
        'sl_sale_ticket_id' => $faker->randomNumber(),
        'sl_sale_ticket_id2' => function () {
             return factory(App\Models\SlSaleTicket::class)->create()->id;
        },
        'sl_sale_credit_note_id' => function () {
             return factory(App\Models\SlSaleCreditNote::class)->create()->id;
        },
        'number' => $faker->word,
        'flag_delete' => $faker->boolean,
        'sl_sale_invoice_affected_id' => function () {
             return factory(App\Models\SlSaleInvoice::class)->create()->id;
        },
        'sl_sale_ticket_affected_id' => function () {
             return factory(App\Models\SlSaleTicket::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\SlTypeCustomerAccountMovement::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word,
    ];
});

$factory->define(App\Models\SlWholesaleDiscount::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'g_branch_office_id' => function () {
             return factory(App\Models\GBranchOffice::class)->create()->id;
        },
        'quantity_discount' => $faker->randomNumber(),
        'percentage_discount' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhConversionFactor::class, function (Faker\Generator $faker) {
    return [
        'wh_unit_of_measurement_id' => $faker->randomNumber(),
        'wh_unit_of_measurement_id2' => function () {
             return factory(App\Models\WhUnitOfMeasurement::class)->create()->id;
        },
        'conversion_factor' => $faker->randomFloat(),
        'wh_unit_of_measurement_left_id' => function () {
             return factory(App\Models\WhUnitOfMeasurement::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\WhDetailDispatchGuide::class, function (Faker\Generator $faker) {
    return [
        'wh_dispatch_guide_id' => function () {
             return factory(App\Models\WhDispatchGuide::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhDetailDispatchOrder::class, function (Faker\Generator $faker) {
    return [
        'wh_dispatch_order_id' => function () {
             return factory(App\Models\WhDispatchOrder::class)->create()->id;
        },
        'wh_dispatch_guide_id' => function () {
             return factory(App\Models\WhDispatchGuide::class)->create()->id;
        },
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhDetailInventory::class, function (Faker\Generator $faker) {
    return [
        'wh_inventory_id' => function () {
             return factory(App\Models\WhInventory::class)->create()->id;
        },
        'wh_item_id' => function () {
             return factory(App\Models\WhItem::class)->create()->id;
        },
        'expected_amount' => $faker->randomFloat(),
        'amount_found' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhDetailOrderer::class, function (Faker\Generator $faker) {
    return [
        'wh_orderer_id' => function () {
             return factory(App\Models\WhOrderer::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhDetailProductReception::class, function (Faker\Generator $faker) {
    return [
        'wh_product_reception_id' => function () {
             return factory(App\Models\WhProductReception::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'complete_reception' => $faker->boolean,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhDetailSaleNote::class, function (Faker\Generator $faker) {
    return [
        'wh_sale_note_id' => function () {
             return factory(App\Models\WhSaleNote::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhDetailStockAdjust::class, function (Faker\Generator $faker) {
    return [
        'wh_stock_adjust_id' => function () {
             return factory(App\Models\WhStockAdjust::class)->create()->id;
        },
        'wh_item_id' => function () {
             return factory(App\Models\WhItem::class)->create()->id;
        },
        'quantity_adjust' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhDetailTransferBetweenWarehouse::class, function (Faker\Generator $faker) {
    return [
        'wh_transfer_between_warehouse_id' => function () {
             return factory(App\Models\WhTransferBetweenWarehouse::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'quantity' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhDispatchGuide::class, function (Faker\Generator $faker) {
    return [
        'pch_purchase_invoice_id' => function () {
             return factory(App\Models\PchPurchaseInvoice::class)->create()->id;
        },
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'sl_customer_id' => function () {
             return factory(App\Models\SlCustomer::class)->create()->id;
        },
        'number' => $faker->word,
        'dispatch_date' => $faker->date(),
        'sender_compay_name' => $faker->word,
        'sender_company_rut' => $faker->word,
        'sender_company_address' => $faker->word,
        'sender_company_comune' => $faker->word,
        'sender_company_core_business' => $faker->word,
        'sender_company_phone' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhDispatchOrder::class, function (Faker\Generator $faker) {
    return [
        'g_state_id' => function () {
             return factory(App\Models\GState::class)->create()->id;
        },
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'number' => $faker->word,
        'description' => $faker->word,
        'dispatch_date' => $faker->date(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhFamily::class, function (Faker\Generator $faker) {
    return [
        'family' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhInventory::class, function (Faker\Generator $faker) {
    return [
        'wh_stock_adjust_id' => function () {
             return factory(App\Models\WhStockAdjust::class)->create()->id;
        },
        'g_user_id' => $faker->randomNumber(),
        'wh_warehouse_id' => function () {
             return factory(App\Models\WhWarehouse::class)->create()->id;
        },
        'g_user_id2' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'description' => $faker->word,
        'inventory_date' => $faker->date(),
        'flag_delete' => $faker->boolean,
        'g_user_supervisor_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\WhItem::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'wh_unit_of_measurement_id' => function () {
             return factory(App\Models\WhUnitOfMeasurement::class)->create()->id;
        },
        'uom_quantity' => $faker->randomFloat(),
        'cost_price' => $faker->randomFloat(),
        'minimun_stock' => $faker->randomFloat(),
        'is_exempt' => $faker->boolean,
        'is_inventoriable' => $faker->boolean,
        'have_decimal_quantity' => $faker->boolean,
        'path_logo' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhOrderer::class, function (Faker\Generator $faker) {
    return [
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'g_state_id' => function () {
             return factory(App\Models\GState::class)->create()->id;
        },
        'number' => $faker->word,
        'description' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhPack::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'wh_item_id' => function () {
             return factory(App\Models\WhItem::class)->create()->id;
        },
        'item_quantity' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhPacking::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => $faker->randomNumber(),
        'upc_code' => $faker->word,
        'internal_code' => $faker->word,
        'name' => $faker->name,
        'alias_name' => $faker->word,
        'description' => $faker->word,
        'quanty_product' => $faker->randomNumber(),
        'flag_delete' => $faker->boolean,
        'wh_product_id2' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\WhProduct::class, function (Faker\Generator $faker) {
    return [
        'wh_item_id' => function () {
             return factory(App\Models\WhItem::class)->create()->id;
        },
        'wh_pack_id' => function () {
             return factory(App\Models\WhPack::class)->create()->id;
        },
        'wh_packing_id' => function () {
             return factory(App\Models\WhPacking::class)->create()->id;
        },
        'wh_promo_id' => function () {
             return factory(App\Models\WhPromo::class)->create()->id;
        },
        'wh_subfamily_id' => function () {
             return factory(App\Models\WhSubfamily::class)->create()->id;
        },
        'upc_code' => $faker->word,
        'internal_code' => $faker->word,
        'name' => $faker->name,
        'alias_name' => $faker->word,
        'description' => $faker->word,
        'warranty_days' => $faker->randomNumber(),
        'is_repackaged' => $faker->boolean,
        'is_salable' => $faker->boolean,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhProductReception::class, function (Faker\Generator $faker) {
    return [
        'pch_purchase_order_id' => function () {
             return factory(App\Models\PchPurchaseOrder::class)->create()->id;
        },
        'flag_delete' => $faker->boolean,
        'number_purchase_invoice' => $faker->randomNumber(),
    ];
});

$factory->define(App\Models\WhPromo::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhPromoWhProductPromo::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'wh_promo_id' => function () {
             return factory(App\Models\WhPromo::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\WhSaleNote::class, function (Faker\Generator $faker) {
    return [
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'pos_sale_id' => function () {
             return factory(App\Models\PosSale::class)->create()->id;
        },
        'subtotal' => $faker->randomFloat(),
        'discount_or_charge' => $faker->randomFloat(),
        'new_subtotal' => $faker->randomFloat(),
        'iva' => $faker->randomFloat(),
        'total' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhStockAdjust::class, function (Faker\Generator $faker) {
    return [
        'wh_inventory_id' => function () {
             return factory(App\Models\WhInventory::class)->create()->id;
        },
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'wh_warehouse_id' => function () {
             return factory(App\Models\WhWarehouse::class)->create()->id;
        },
        'description' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhStockAdjustType::class, function (Faker\Generator $faker) {
    return [
        'wh_stock_adjust_id' => function () {
             return factory(App\Models\WhStockAdjust::class)->create()->id;
        },
        'type' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhStockMovement::class, function (Faker\Generator $faker) {
    return [
        'wh_item_id' => function () {
             return factory(App\Models\WhItem::class)->create()->id;
        },
        'wh_warehouse_id' => function () {
             return factory(App\Models\WhWarehouse::class)->create()->id;
        },
        'wh_warehouse_movement_id' => function () {
             return factory(App\Models\WhWarehouseMovement::class)->create()->id;
        },
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhSubfamily::class, function (Faker\Generator $faker) {
    return [
        'wh_family_id' => function () {
             return factory(App\Models\WhFamily::class)->create()->id;
        },
        'subfamily' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhTag::class, function (Faker\Generator $faker) {
    return [
        'tag' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhTagWhProduct::class, function (Faker\Generator $faker) {
    return [
        'wh_product_id' => function () {
             return factory(App\Models\WhProduct::class)->create()->id;
        },
        'wh_tag_id' => function () {
             return factory(App\Models\WhTag::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\WhTransferBetweenWarehouse::class, function (Faker\Generator $faker) {
    return [
        'wh_warehouse_id' => $faker->randomNumber(),
        'wh_warehouse_id2' => function () {
             return factory(App\Models\WhWarehouse::class)->create()->id;
        },
        'description' => $faker->word,
        'flag_delete' => $faker->boolean,
        'wh_warehouse_origin_id' => function () {
             return factory(App\Models\WhWarehouse::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\WhUnitOfMeasurement::class, function (Faker\Generator $faker) {
    return [
        'unity_symbol' => $faker->word,
        'name' => $faker->name,
        'minimun_unit' => $faker->boolean,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhWarehouse::class, function (Faker\Generator $faker) {
    return [
        'g_branch_office_id' => function () {
             return factory(App\Models\GBranchOffice::class)->create()->id;
        },
        'wh_warehouse_type_id' => function () {
             return factory(App\Models\WhWarehouseType::class)->create()->id;
        },
        'g_user_id' => function () {
             return factory(App\Models\GUser::class)->create()->id;
        },
        'name' => $faker->name,
        'description' => $faker->word,
        'address' => $faker->word,
        'is_waste_warehouse' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhWarehouseItem::class, function (Faker\Generator $faker) {
    return [
        'wh_warehouse_id' => function () {
             return factory(App\Models\WhWarehouse::class)->create()->id;
        },
        'wh_item_id' => function () {
             return factory(App\Models\WhItem::class)->create()->id;
        },
        'stock' => $faker->randomFloat(),
    ];
});

$factory->define(App\Models\WhWarehouseMovement::class, function (Faker\Generator $faker) {
    return [
        'amount' => $faker->randomFloat(),
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\Models\WhWarehouseType::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word,
        'flag_delete' => $faker->boolean,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'email_verified_at' => $faker->dateTimeBetween(),
        'password' => bcrypt($faker->password),
        'remember_token' => str_random(10),
    ];
});

