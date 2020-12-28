<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Services\Auth\LoginService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Password;
use DB;
use Hash;
use Carbon\Carbon;
use Modules\General\Entities\GUser;
use Modules\General\Entities\GTemporalModuleToken;
use Modules\General\Entities\PasswordResets;
use Modules\General\Services\GTemporalModuleToken\CrudGTemporalModuleTokenService;
use Modules\General\Http\Requests\GTemporalModuleToken\GenerateTemporalModuleTokenRequest; 
use Modules\General\Http\Requests\GTemporalModuleToken\GetUserTokenRequest; 

class AuthController extends Controller
{  
    /**
     * Login User
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'rut' => 'required|string|max:10|cl_rut|exists:hr_employee,rut',
            'password' => 'required|min:6|string',
            'remember_me' => 'boolean'
        ]);
            
        $credentials = request(['rut', 'password']);

        if(! LoginService::attempt($credentials))
            return response()->json([
                'message' => 'Rut o Password incorrectos',
                'http_status_code' => 401,
                'status' => 'error',
            ], 401);
        
        $user = LoginService::getUser_ByRequest($request);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        
        $request->remember_me ? $token->expires_at = Carbon::now()->addWeeks(1) : 
                                $token->expires_at = Carbon::now()->addDays(1);
        
        $token->save();
        
        return response()->json([
            'status' => 'success',
            'http_status_code' => 200,
            'message' => 'Autorizado',
            'user' => [
                'nombre_completo' => $user->hrEmployee->getFullName(), 
                'email' => $user->email,  
                'roles' => $user->getRoleNames(),
            ],
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        , 200]);
    }//end function
  
    /**
     * Logout user
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'success',
            'http_status_code' => 200,
            'message' => 'Se ha cerrado sesión correctamente'
        ], 200);
    }//end function

    /**
     * Send email for restore pass
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendEmailPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|exists:hr_employee,email',
        ]);

        $user = LoginService::getUser_ByEmail($request->email);
  
        if(isset($user))
        {
            $token = Password::getRepository()->create($user);
            $user->sendPasswordResetNotification($token);

            return response()->json([
                'status' => 'success',
                'http_status_code' => 200,
                'message' => 'Email enviado exitosamente'
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Unauthorized',
                'status' => 'error',
            ], 401);
        }
    } // end function

    /**
     * Restore password user
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'rut' => 'required|string|max:10|cl_rut|exists:hr_employee,rut',
            'password' => 'required|string|min:6',
            'password_repeat' => 'required|string|min:6|same:password',
            'token' => 'required',
        ]);

        $user = LoginService::getUser_ByRequest($request);
        if(! isset($user))
            return response()->json([
                'message' => 'El email ingresado no se encuentra en la base de datos',
                'http_status_code' => 404,
                'status' => 'error',
            ], 404);
        
        $passwordReset = PasswordResets::where('email', $user->hrEmployee->email)->first();

        if(! isset($passwordReset) || 
           ! Hash::check($request->token, $passwordReset->token) ||
           Carbon::parse($passwordReset->created_at)->addMinutes(config('auth.passwords.users.expire'))->isPast())
        {
            return response()->json([
                'message' => 'El token enviado no es válido',
                'http_status_code' => 404,
                'status' => 'error',
            ], 404);
        } // end if

        // update pass
        $user->password = Hash::make($request->password);
        $user->save();

        // Create Token of actual user
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token; 
        $token->expires_at = Carbon::now()->addDays(1);

        $token->save();

        // Delete token password reset
        $passwordReset->delete();

        return response()->json([
            'status' => 'success',
            'http_status_code' => 200,
            'message' => 'Autorizado',
            'user' => [
                'nombre_completo' => $user->hrEmployee->getFullName(), 
                'email' => $user->email,  
                'roles' => $user->getRoleNames(),
            ],
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        , 200]);

    } // end function

    /**
     * Generate temporal token for login in different module that login
     * 
     * @param \Modules\General\Http\Requests\GTemporalModuleToken\GenerateTemporalModuleTokenRequest $request
     * @return \Illuminate\Http\Response
     */
    public function generateTemporalModuleToken(GenerateTemporalModuleTokenRequest $request)
    {
        $crudGTemporalModuleTokenService = new CrudGTemporalModuleTokenService();
        $response = $crudGTemporalModuleTokenService->store($request);

        if ($response['status'] === 'success') {
            return response()->json($response, 201);
        }

        return response()->json($response, $response['http_status_code']);
    } // end function

    /**
     * Get login token with temporal module token
     * 
     * @param \Modules\General\Http\Requests\GTemporalModuleToken\GetUserTokenRequest $request
     * @return \Illuminate\Http\Response
     */
    public function getLoginToken(GetUserTokenRequest $request)
    {
        $crudGTemporalModuleTokenService = new CrudGTemporalModuleTokenService();
        $response = $crudGTemporalModuleTokenService->getLoginToken($request);

        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }

        return response()->json($response, $response['http_status_code']);
    } // end function
}
