<?php

namespace Modules\General\Services\GUserPos;

use App\Http\Response\CustomResponse;
use Modules\General\Entities\GUserPos;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Dotenv\Exception\ValidationException;


class RolePermissionService
{

    /**
     * Check if user is authorized to perform an action
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function isAuthorized(Request $request)
    {
        if (!$request->auth_code || !$request->permission) {
            return CustomResponse::normalError([
                'message' => 'Debe enviar código de autentificación y permiso a verificar',
                'example' => '/authorization?auth_code=875&permission=autorizar apertura caja'
            ], 400);
        }
        try
        {
            $user = GUserPos::with('hrEmployeePos')->where('auth_code', $request->auth_code)->where('flag_delete', false)->firstOrFail();
            if (!$user || !$request->auth_code) {
                throw new ValidationException("No tienes los permisos para realizar esta operación");
            }
            $userArray = $user->toArray();
            return CustomResponse::ok([
                'is_authorized' => $user->hasPermissionTo($request->permission),
                'user' => [
                    'id' => $user->id,
                    'first_names' => $userArray['hr_employee']['names'],
                    'last_name1' => $userArray['hr_employee']['last_name1'],
                    'last_name2' => $userArray['hr_employee']['last_name2'],
                    'email' => $userArray['hr_employee']['email']
                ]
            ]);
        } catch( PermissionDoesNotExist $e)
        {
            return CustomResponse::normalError([
                'message' => "El permiso '$request->permission' no existe"
            ], 404);
        } catch( \Exception $e)
        {
            return CustomResponse::error($e);
        }

    }

    /**
     * Check if user is authorized to perform an action (checking bar auth code)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function isBarAuthorized(Request $request)
    {
        if (!$request->auth_code || !$request->permission) {
            return CustomResponse::normalError([
                'message' => 'Debe enviar código de autentificación y permiso a verificar',
                'example' => '/authorization?auth_code=875&permission=autorizar apertura caja'
            ], 400);
        }
        try
        {
            $user = GUserPos::with('hrEmployeePos')->where('bar_auth_code', $request->auth_code)->where('flag_delete', false)->firstOrFail();
            if (!$user || !$request->auth_code) {
                throw new ValidationException("No tienes los permisos para realizar esta operación");
            }
            $userArray = $user->toArray();
            return CustomResponse::ok([
                'is_authorized' => $user->hasPermissionTo($request->permission),
                'user' => [
                    'id' => $user->id,
                    'first_names' => $userArray['hr_employee']['first_names'],
                    'last_name1' => $userArray['hr_employee']['last_name1'],
                    'last_name2' => $userArray['hr_employee']['last_name2'],
                    'email' => $userArray['hr_employee']['email']
                ]
            ]);
        } catch( PermissionDoesNotExist $e)
        {
            return CustomResponse::normalError([
                'message' => "El permiso '$request->permission' no existe"
            ], 404);
        } catch( \Exception $e)
        {
            return CustomResponse::error($e);
        }

    }

    /**
     * Check if user by code has permissions to do something
     * if not, throws DotEnv\Exception\ValidationException;
     *
     * Return id of the user is all ok
     *
     * @param integer $authCode
     * @param string $permission
     * @return integer
     */
    public function checkAuthorization($authCode, $permission)
    {
        $user = GUserPos::where(function ($query) use ($authCode){
            $query->where('auth_code', $authCode)->orWhere('bar_auth_code', $authCode);
        } )->where('flag_delete', false)->first();
        if (!$user || !$permission) {
            throw new ValidationException("No tienes los permisos para realizar esta operación");
        }
        if ( !$user->hasPermissionTo($permission) ) {
            throw new ValidationException("No tienes los permisos para realizar esta operación");
        }
        return $user->id;

    }

}
