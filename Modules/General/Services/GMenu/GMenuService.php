<?php

namespace Modules\General\Services\GMenu;

use Modules\General\Entities\GMenuPos;
use Modules\General\Entities\GSubmenuPos;
use Modules\General\Entities\GUserPos;
use Illuminate\Http\Request;
use App\Http\Response\CustomResponse;

// FIXME: add comments
class GMenuService
{
    // FIXME: temporal const default ID User
    const ID_DEFAULT_USER = 1;
    
    // FIXME: add comments
    public function getMenuModuleUser_FromPermissions(Request $request)
    {
        try
        {
            $user = getLoggedUser();
            $userPermissionsIds = $user->getAllPermissions()->pluck('id');
            
            $menusUserIds = GSubmenuPos::whereIn('permissions_id', $userPermissionsIds)->pluck('g_menu_id')->unique();
            $submenusUserIds = GSubmenuPos::whereIn('permissions_id', $userPermissionsIds)->pluck('id');
            
            $menusModuleUser = GMenuPos::whereIn('id', $menusUserIds)
                                    ->orderBy('priority')
                                    ->where('g_module_id', $request->g_module_id)
                                    ->with(['gSubmenusPos' => function($query) use ($submenusUserIds) {
                                        $query->whereIn('id', $submenusUserIds);
                                        $query->orderBy('priority');
                                        $query->select(['id', 'g_menu_id', 'name', 'icon', 'route']);
                                    }])
                                    ->select(['id', 'name', 'icon', 'route'])
                                    ->get();

            return CustomResponse::ok([
                'data' => array('g_menu_module_user' => $menusModuleUser),
            ]);
        }
        catch(\Exception $e)
        {
            return CustomResponse::error($e);
        }
    } // end function

}