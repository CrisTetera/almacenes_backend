<?php

namespace Modules\General\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\General\Services\GModule\GModuleService;

class GModuleController extends Controller
{
    /**
     * Get Modules of user
     * 
     * @return Response
     */
    public function getAllModulesUser()
    {
        $gModuleService = new GModuleService();
        $response = $gModuleService->getAllModulesUser_FromPermissions();

        return response()->json($response, $response['http_status_code']); 
    }

    /**
     * Get Login Module data
     * 
     * @return Response
     */
    public function getLoginModule()
    {
        $gModuleService = new GModuleService();
        $response = $gModuleService->getLoginModule();

        return response()->json($response, $response['http_status_code']); 
    }
}
