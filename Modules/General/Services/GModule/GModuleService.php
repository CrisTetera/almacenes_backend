<?php

namespace Modules\General\Services\GModule;

use Modules\General\Entities\GModulePos;
use Modules\General\Entities\GMenuPos;
use Modules\General\Entities\GSubmenuPos;
use Modules\General\Entities\GUser;

use Illuminate\Http\Request;
use Auth;
use App\Http\Response\CustomResponse;

class GModuleService
{   
    /**
     * Constant id module login ID
     */
    const G_MODULE_LOGIN_ID = 0;

    /**
     * Get user Modules from permissions
     * 
     * @return array with GModule data
     */
    public function getAllModulesUser_FromPermissions()
    {
        try
        {
            $user = getLoggedUser();
            $userPermissionsIds = $user->getAllPermissions()->pluck('id');
            
            $menusUserIds = GSubmenuPos::whereIn('permissions_id', $userPermissionsIds)->pluck('g_menu_id')->unique();
            $modulesUserIds = GMenuPos::whereIn('id', $menusUserIds)->pluck('g_module_id')->unique();
            $modulesUser = GModulePos::whereIn('id', $modulesUserIds)
                                  ->select('id', 'name', 'url_module', 'url_bg_module')
                                  ->get();
            
            return CustomResponse::ok([
                'g_modules_user' => $modulesUser,
            ]);
        }
        catch(\Exception $e)
        {
            return CustomResponse::error($e);
        }
    } // end function

    /**
     * Get Login Module data
     * 
     * @return array
     */
    public function getLoginModule()
    {
        try
        {
            $gLoginModule = GModulePos::find(self::G_MODULE_LOGIN_ID);
            
            return CustomResponse::ok([
                'g_login_module' => $gLoginModule,
            ]);
        }
        catch(\Exception $e)
        {
            return CustomResponse::error($e);
        }
    } // end function



} // end function