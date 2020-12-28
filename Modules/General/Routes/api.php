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

//auth routes
Route::group([ 'prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('password/email', 'Api\AuthController@sendEmailPassword');
    Route::post('password/reset', 'Api\AuthController@resetPassword');
    Route::get('get_login_token', 'Api\AuthController@getLoginToken');
  
    Route::group(addMiddlewares(), function() {
        Route::get('logout', 'Api\AuthController@logout');
    });
});

/**Routes without auth middleware */
// Login Module Data
Route::get('get_login_module', 'Api\GModuleController@getLoginModule');

Route::group(addMiddlewares(), function() {
    Route::resources([
        // AUDIT PATHS
        'audit_historic_price' => 'Api\AuditHistoricPriceController',
        'audit_sended_email_logs' => 'Api\AuditSendedEmailLogsController',
        'audit_system_logs' => 'Api\AuditSystemLogsController',

        // G PATHS
        'g_bank' => 'Api\GBankController',
        'g_branch_office' => 'Api\GBranchOfficeController',
        'g_commune' => 'Api\GCommuneController',
        'g_commune_pos' => 'Api\GCommunePosController',
        'g_company' => 'Api\GCompanyController',
        'g_province' => 'Api\GProvinceController',
        'g_province_pos' => 'Api\GProvincePosController',
        'g_region' => 'Api\GRegionController',
        'g_region_pos' => 'Api\GRegionPosController',
        'g_state' => 'Api\GStateController',
        'g_state_pos' => 'Api\GStatePosController',
        'g_system_configuration' => 'Api\GSystemConfigurationController',
        'g_state_type' => 'Api\GStateTypeController',
        'g_state_type_pos' => 'Api\GStateTypePosController',
        'g_type_account_bank' => 'Api\GTypeAccountBankController',
        'g_user' => 'Api\GUserController',
        'g_user_pos' => 'Api\GUserPosController',
        'g_core_business_sii' => 'Api\GCoreBusinessSIIController',
    ]);
    
    /**  Additional routes **/
    // Modules and menu 
    Route::get('get_menu_module_user', 'Api\GMenuController@getMenuModuleUser');
    Route::get('get_all_modules_user', 'Api\GModuleController@getAllModulesUser');

    //Additional routes (auth)
    Route::post('auth/generate_temporal_module_token', 'Api\AuthController@generateTemporalModuleToken');

    // Authowizatiion
    Route::get('authorization', 'Api\GUserPosController@isAuthorized');
    Route::get('bar_authorization', 'Api\GUserPosController@isBarAuthorized');
    Route::post('authorization/{role}/recover', 'Api\GUserPosController@recoverBarAuthCode');
});

