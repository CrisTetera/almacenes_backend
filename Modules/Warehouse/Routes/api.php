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

    // Suggest upc and internal code
    Route::get('wh_product/suggest_upc_code', 'Api\WhProductController@suggestUpcCode');
    Route::get('wh_product/suggest_internal_code', 'Api\WhProductController@suggestInternalCode');

    // Massive margin update
    Route::put('wh_product/massive_margin', 'Api\WhProductController@massiveMarginUpdate');

    Route::resources([
        //WH PATHS
        'wh_conversion_factor' => 'Api\WhConversionFactorController',
        'wh_detail_dispatch_guide' => 'Api\WhDetailDispatchGuideController',
        'wh_detail_dispatch_order' => 'Api\WhDetailDispatchOrderController',
        'wh_detail_inventory' => 'Api\WhDetailInventoryController',
        'wh_detail_orderer' => 'Api\WhDetailOrdererController',
        'wh_detail_product_reception' => 'Api\WhDetailProductReceptionController',
        'wh_detail_sale_note' => 'Api\WhDetailSaleNoteController',
        'wh_detail_stock_adjust' => 'Api\WhDetailStockAdjustController',
        'wh_detail_transfr_betwn_warhouse' => 'Api\WhDetailTransferBetweenWarehouseController',
        'wh_dispatch_guide' => 'Api\WhDispatchGuideController',
        'wh_dispatch_order' => 'Api\WhDispatchOrderController',
        'wh_dispatch_request' => 'Api\WhDispatchRequestController',
        'wh_family' => 'Api\WhFamilyController',
        'wh_family_pos' => 'Api\WhFamilyPosController',
        'wh_inventory' => 'Api\WhInventoryController',
        'wh_item' => 'Api\WhItemController',
        'wh_item_stock_pos' => 'Api\WhItemStockPosController',
        'wh_item_pos' => 'Api\WhItemPosController',
        'wh_orderer' => 'Api\WhOrdererController',
        'wh_orderer_priority' => 'Api\WhOrdererPriorityController',
        'wh_pack' => 'Api\WhPackController',
        'wh_pack_pos' => 'Api\WhPackPosController',
        'wh_packing' => 'Api\WhPackingController',
        'wh_product' => 'Api\WhProductController',
        'wh_product_pos' => 'Api\WhProductPosController',
        'wh_product_reception' => 'Api\WhProductReceptionController',
        'wh_promo' => 'Api\WhPromoController',
        'wh_promo_pos' => 'Api\WhPromoPosController',
        'wh_sale_note' => 'Api\WhSaleNoteController',
        'wh_stock_adjust' => 'Api\WhStockAdjustController',
        'wh_stock_adjust_type' => 'Api\WhStockAdjustTypeController',
        'wh_stock_movement' => 'Api\WhStockMovementController',
        'wh_stock_movement_pos' => 'Api\WhStockMovementPosController',
        'wh_subfamily' => 'Api\WhSubfamilyController',
        'wh_subfamily_pos' => 'Api\WhSubfamilyPosController',
        'wh_transfer_warehouse_state' => 'Api\WhTransferBetweenWarehouseStateController',
        'wh_transfer_between_warehouse' => 'Api\WhTransferBetweenWarehouseController',
        'wh_tag' => 'Api\WhTagController',
        'wh_tag_pos' => 'Api\WhTagPosController',
        'wh_warehouse' => 'Api\WhWarehouseController',
        'wh_warehouse_movement' => 'Api\WhWarehouseMovementController',
        'wh_warehouse_item' => 'Api\WhWarehouseItemController',
        'wh_warehouse_type' => 'Api\WhWarehouseTypeController',
        'wh_unit_of_measurement' => 'Api\WhUnitOfMeasurementController',
    ]);

    //Additional routes
    Route::get('wh_product_excel', 'WhProductExcelController@create');
    Route::post('wh_product_excel', 'WhProductExcelController@store');

    // Transfer (Guía de Intercambio)
    Route::post('wh_transfer_between_warehouse/{id}/dispatch', 'Api\WhTransferBetweenWarehouseController@dispatchTransfer');
    Route::post('wh_transfer_between_warehouse/{id}/receive', 'Api\WhTransferBetweenWarehouseController@receive');
    
    //Additional routes
    Route::get('wh_product_movement_report', 'Api\WhProductMovementReportController@index');

    Route::post('wh_product/{id}/logo', 'Api\WhProductController@uploadLogo');
});
