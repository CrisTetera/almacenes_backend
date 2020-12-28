<?php

namespace Modules\General\Services\Auth;

use Modules\General\Entities\GUserPos;
use Hash;
use Illuminate\Http\Request;

class LoginService
{   
    /**
     * Check if user has a rut equals to credential rut in "hr_employee" relation table AND
     * password hashed is equals to password attribute in "g_user" table
     * 
     * @param array $credentials that contain rut and password not hashed
     * @return bool true if check credentials, false in otherwise 
     */
    public static function attempt(array $credentials)
    {
        try {
            $gUser = GUserPos::join('hr_employee_pos', 'hr_employee_id', 'hr_employee_pos.id')
                          ->where('hr_employee_pos.rut', $credentials['rut'])
                          ->first();
            
            if(! isset($gUser))
                throw new \Exception("Las credenciales enviadas no coinciden con las registradas en el sistema");

            return Hash::check($credentials['password'], $gUser->password);
        }
        catch(\Exception $e) {
            return false;
        }
    } // end function

    /**
     * Get user with Request Laravel object (by rut param)
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Modules\General\Entities\GUserPos
     */
    public static function getUser_ByRequest(Request $request)
    {
        try {
            $gUser = GUserPos::join('hr_employee_pos', 'hr_employee_id', 'hr_employee_pos.id')
                          ->where('hr_employee_pos.rut', $request->rut)
                          ->first();
            
            if(! isset($gUser))
                throw new \Exception("Las credenciales enviadas no coinciden con las registradas en el sistema");
                
            return $gUser;
        }
        catch(\Exception $e) {
            return null;
        }
    } // end function

    /**
     * Get user with email user
     * 
     * @param string $request
     * @return \Modules\General\Entities\GUserPos
     */
    public static function getUser_ByEmail(string $email)
    {
        try {
            $gUser = GUserPos::join('hr_employee_pos', 'hr_employee_id', 'hr_employee_pos.id')
                          ->where('hr_employee_pos.email', $email)
                          ->first();
            
            if(! isset($gUser))
                throw new \Exception("Las credenciales enviadas no coinciden con las registradas en el sistema");

            return $gUser;
        }
        catch(\Exception $e) {
            return null;
        }
    } // end function

}