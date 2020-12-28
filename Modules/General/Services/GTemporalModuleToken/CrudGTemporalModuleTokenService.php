<?php

namespace Modules\General\Services\GTemporalModuleToken;

use Illuminate\Http\Request;
use Modules\General\Entities\GTemporalModuleToken;
use Modules\General\Entities\GUserPos;
use App\Http\Response\CustomResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
use Auth;

class CrudGTemporalModuleTokenService
{
    /**
     * Create a GTemporalModuleToken in DB
     * 
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {    
            $moduleToken = str_random(32);  //random token of 32 chars
            $gTemporalModuleToken = new GTemporalModuleToken();
            $gTemporalModuleToken->module_token = $moduleToken;
            $gTemporalModuleToken->user_token = $request->user_token;
            $gTemporalModuleToken->g_user_id = getLoggedUser()->id;
            $gTemporalModuleToken->save();

            DB::commit();

            return CustomResponse::created([
                'message' => 'Token creado exitosamente',
                'module_token' => $moduleToken
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    }

    /**
     * Get login token with module token
     * 
     * @param \Illuminate\Http\Request $request
     * @return array with token and user data
     */
    public function getLoginToken(Request $request)
    {
        DB::beginTransaction();
        try
        {    
            $gTemporalModuleToken = GTemporalModuleToken::where('module_token', $request->module_token)->first();

            if(! isset($gTemporalModuleToken)) throw new ModelNotFoundException("Token no encontrado");
            
            $gUser = GUserPos::find($gTemporalModuleToken->g_user_id);
            $userToken = $gTemporalModuleToken->user_token;
            $gTemporalModuleToken->delete();

            if(! isset($gUser)) throw new ModelNotFoundException("Usuario no encontrado");

            DB::commit();

            return CustomResponse::ok([
                'message' => 'Autorizado',
                'user' => [
                    'nombre_completo' => $gUser->hrEmployeePos->getFullName(), 
                    'email' => $gUser->email,  
                    'roles' => $gUser->getRoleNames(),
                ],
                'user_token' => $userToken            
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return CustomResponse::error($e);
        }
    } // end function
} // end class