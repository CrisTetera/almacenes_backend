<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(addMiddlewares(), function() {
    Route::resources([
        // PCH PATHS
        'pch_detail_provider_payment_shet' => 'Api\PchDetailProviderPaymentSheetController',
        'pch_detail_purchase_debit_note' => 'Api\PchDetailPurchaseDebitNoteController',
        'pch_detail_purchase_invoice' => 'Api\PchDetailPurchaseInvoiceController',
        'pch_detail_purchase_credit_note' => 'Api\PchDetailPurchaseCreditNoteController',
        'pch_detail_purchase_quotation' => 'Api\PchDetailPurchaseQuotationController',
        'pch_provider_account_bank' => 'Api\PchProviderAccountBankController',
        'pch_provider_account_movement' => 'Api\PchProviderAccountMovementController',
        'pch_provider_account' => 'Api\PchProviderAccountController',
        'pch_provider_debt_to_pay' => 'Api\PchProviderDebtToPayController',
        'pch_provider_payment_sheet' => 'Api\PchProviderPaymentSheetController',
        'pch_provider_payment' => 'Api\PchProviderPaymentController',
        'pch_provider' => 'Api\PchProviderController',
        'pch_purchase_credit_note' => 'Api\PchPurchaseCreditNoteController',
        'pch_purchase_debit_note' => 'Api\PchPurchaseDebitNoteController',
        'pch_purchase_invoice' => 'Api\PchPurchaseInvoiceController',
        'pch_purchase_order_state' => 'Api\PchPurchaseOrderStateController',
        'pch_payment_condition' => 'Api\PchPaymentConditionController',
        'pch_purchase_order' => 'Api\PchPurchaseOrderController',
        'pch_purchase_quotation' => 'Api\PchPurchaseQuotationController',
        'pch_type_provider_account_mvment' => 'Api\PchTypeProviderAccountMovementController',
    ]);

    //Additional routes
    Route::get('pch_purchase_order/{id}/pdf', 'Api\PchPurchaseOrderController@generatePDF');
    Route::post('pch_purchase_order/{id}/authorize', 'Api\PchPurchaseOrderController@authorizePurchaseOrder');
});
