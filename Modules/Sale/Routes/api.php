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
        'sl_change_sale_price' => 'Api\SlChangeSalePriceController',
        'sl_check' => 'Api\SlCheckController',
        'sl_customer_account_bank' => 'Api\SlCustomerAccountBankController',
        'sl_customer_account_movement' => 'Api\SlCustomerAccountMovementController',
        'sl_customer_account_receivable' => 'Api\SlCustomerAccountReceivableController',
        'sl_customer_account' => 'Api\SlCustomerAccountController',
        'sl_customer_charge_sheet' => 'Api\SlCustomerChargeSheetController',
        'sl_customer_payment' => 'Api\SlCustomerPaymentController',
        'sl_customer_presets_discount' => 'Api\SlCustomerPresetsDiscountController',
        'sl_customer' => 'Api\SlCustomerController',
        'sl_customer_pos' => 'Api\SlCustomerPosController',
        'sl_detail_customer_charge_sheet' => 'Api\SlDetailCustomerChargeSheetController',
        'sl_detail_list_price' => 'Api\SlDetailListPriceController',
        'sl_detail_sale_credit_note' => 'Api\SlDetailSaleCreditNoteController',
        'sl_detail_sale_debit_note' => 'Api\SlDetailSaleDebitNoteController',
        'sl_detail_sale_invoice' => 'Api\SlDetailSaleInvoiceController',
        'sl_detail_sale_quotation' => 'Api\SlDetailSaleQuotationController',
        'sl_detail_sale_ticket' => 'Api\SlDetailSaleTicketController',
        'sl_electronic_transfer_payment' => 'Api\SlElectronicTransferPaymentController',
        'sl_list_price' => 'Api\SlListPriceController',
        'sl_offer' => 'Api\SlOfferController',
        'sl_offer_pos' => 'Api\SlOfferPosController',
        'sl_sale_credit_note' => 'Api\SlSaleCreditNoteController',
        'sl_sale_quotation' => 'Api\SlSaleQuotationController',
        'sl_sale_ticket' => 'Api\SlSaleTicketController',
        'sl_ticket_pos' => 'Api\SlTicketPosController',
        'sl_invoice_pos' => 'Api\SlInvoicePosController',
        'sl_sale_debit_note' => 'Api\SlSaleDebitNoteController',
        'sl_sale_invoice' => 'Api\SlSaleInvoiceController',
        'sl_service_order' => 'Api\SlServiceOrderController',
        'sl_service_order_type' => 'Api\SlServiceOrderTypeController',
        'sl_type_customer_account_movment' => 'Api\SlTypeCustomerAccountMovementController',
        // sl whole sale discount: list group, per family, per subfamily
        'sl_wholesale_discount' => 'Api\SlWholesaleDiscountController',
        'sl_wholesale_discount_family' => 'Api\SlWholesaleDiscountByFamilyController',
        'sl_wholesale_discount_subfamily' => 'Api\SlWholesaleDiscountBySubFamilyController',
        'sl_commission_type' => 'Api\SlCommissionTypeController',
        'sl_commission' => 'Api\SlCommissionController',
    ]);

    //Additional routes
    Route::get('sl_sale_quotation/{id}/pdf', 'Api\SlSaleQuotationController@generatePDF')->name('sale_quotation_generate_pdf');
    Route::get('sl_customer/rut/{rut}', 'Api\SlCustomerController@searchByRut')->name('search_customer_by_rut');
    Route::get('sl_customer_pos/rut/{rut}', 'Api\SlCustomerPosController@searchByRut')->name('search_customer_by_rut');
    Route::get('sl_customer/{rut}/purchasehistory', 'Api\SlCustomerController@purchaseHistory')->name('show_customer_purcharse_history');
    Route::post('sl_service_order/change', 'Api\SlServiceOrderController@change')->name('service_order_change');
    Route::post('sl_service_order/cancel', 'Api\SlServiceOrderController@cancel')->name('service_order_cancel');

    // offer Pos
    Route::get('check_exist_sl_offer', 'Api\SlOfferPosController@checkExistSlOffer')->name('check_exist_sl_offer');
    Route::post('massive_create_offer', 'Api\SlOfferPosController@massiveCreateOffer')->name('massive_create_offer');
    Route::patch('massive_edit_offer', 'Api\SlOfferPosController@massiveEditOffer')->name('massive_edit_offer');
    Route::patch('massive_delete_offer', 'Api\SlOfferPosController@massiveDeleteOffer')->name('massive_delete_offer');


    Route::get('sl_sale_ticket/number/{number}', 'Api\SlSaleTicketController@searchByNumber')->name('sale_ticket_by_number');
    Route::get('sl_sale_invoice/number/{number}', 'Api\SlSaleInvoiceController@searchByNumber')->name('sale_invoice_by_number');
    Route::get('dte/number/{number}', 'Api\SlDTEController@searchByNumber')->name('dte_by_number');

    // SlSaleInvoice
    Route::get('get_last_sale_invoice_open_cash_desk', 'Api\SlSaleInvoiceController@getLastSaleInvoiceOpenCashDesk')->name('get_last_sale_invoice_open_cash_desk');

});
