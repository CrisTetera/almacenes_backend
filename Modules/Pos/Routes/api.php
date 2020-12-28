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
        // POS PATHS
        'pos_cash_desk' => 'Api\PosCashDeskController',
        'pos_cash_desk_pos' => 'Api\PosCashDeskPosController',
        'pos_cash_movement_egress_type' => 'Api\PosCashMovementEgressTypeController',
        'pos_cash_movement_ingress_type' => 'Api\PosCashMovementIngressTypeController',
        'pos_movement_egress_type_pos' => 'Api\PosMovementEgressTypePosController',
        'pos_movement_ingress_type_pos' => 'Api\PosMovementIngressTypePosController',
        'pos_cash_movement' => 'Api\PosCashMovementController',
        'pos_cash_desk_movement_pos' => 'Api\PosCashDeskMovementPosController',
        'pos_customer_credit_option' => 'Api\PosCustomerCreditOptionController',
        'pos_daily_cash' => 'Api\PosDailyCashController',
        'pos_daily_cash_pos' => 'Api\PosDailyCashPosController',
        'pos_detail_employee_sale' => 'Api\PosDetailEmployeeSaleController',
        'pos_detail_internal_consumption' => 'Api\PosDetailInternalConsumptionController',
        'pos_detail_sale_note' => 'Api\PosDetailSaleNoteController',
        'pos_detail_sale' => 'Api\PosDetailSaleController',
        'pos_detail_pos' => 'Api\PosDetailPosController',
        'pos_employee_sale_payment_type' => 'Api\PosEmployeeSalePaymentTypeController',
        'pos_employee_sale' => 'Api\PosEmployeeSaleController',
        'pos_internal_consumption' => 'Api\PosInternalConsumptionController',
        'pos_manual_discount' => 'Api\PosManualDiscountController',
        'pos_sale_note' => 'Api\PosSaleNoteController',
        'pos_sale_payment_type' => 'Api\PosSalePaymentTypeController',
        'pos_sale_type' => 'Api\PosSaleTypeController',
        'pos_sale' => 'Api\PosSaleController',
        'pos_sale_pos' => 'Api\PosSalePosController',
        'pos_trust_sale_pos' => 'Api\PosTrustSalePosController',
        'pos_sale_type_pos' => 'Api\PosSaleTypePosController',
        'pos_type_payment_method_pos' => 'Api\PosTypePaymentMethodPosController'
    ]);

    //Additional routes

    // PosSale
    Route::post('pos_sale/pay', 'Api\PosSaleController@paySale')->name('pos_pay_the_sale');
    Route::post('pos_sale_pos/pay', 'Api\PosSalePosController@paySale')->name('pos_pay_the_sale');
    Route::post('pos_trust_sale_pos/pay', 'Api\PosTrustSalePosController@paySale')->name('pos_pay_the_sale');
    Route::post('pos_sale_pos/modify', 'Api\PosSalePosController@modifySale')->name('pos_modify_the_sale');
    Route::post('pos_sale/modify', 'Api\PosSaleController@modifySale')->name('pos_modify_the_sale');
    // PosEmployeeSale
    Route::post('pos_employee_sale/pay', 'Api\PosEmployeeSaleController@payEmployeeSale')->name('pos_pay_the_employee_sale');
    // PosDailyCash
    Route::get('pos_daily_cash_initial_resume', 'Api\PosDailyCashController@getInitialResume')->name('pos_daily_cash_initial_resume');
    Route::get('pos_daily_cash_complete_resume', 'Api\PosDailyCashController@getCompleteResume')->name('pos_daily_cash');
    Route::patch('pos_daily_cash_close', 'Api\PosDailyCashController@posDailyCashClose')->name('pos_daily_cash_close');
    // PosDailyCashPos
    Route::get('pos_daily_cash_initial_resume_pos', 'Api\PosDailyCashPosController@getInitialResume')->name('pos_daily_cash_initial_resume_pos');
    Route::get('pos_daily_cash_complete_resume_pos', 'Api\PosDailyCashPosController@getCompleteResume')->name('pos_daily_cash_pos');
    Route::patch('pos_daily_cash_close_pos', 'Api\PosDailyCashPosController@posDailyCashClose')->name('pos_daily_cash_close_pos');
    
});
