<?php

namespace Modules\General\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\General\Http\Requests\GMenu\GetMenuRequest;
use Modules\General\Services\GMenu\GMenuService;

class GMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getMenuModuleUser(GetMenuRequest $request)
    { 
        $gMenuService = new GMenuService();
        $response = $gMenuService->getMenuModuleUser_FromPermissions($request);
        
        return response()->json($response, $response['http_status_code']); 
    }
}
