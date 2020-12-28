<?php

namespace Modules\General\Services\GUserPos;

use Modules\General\Http\Requests\GUserPos\RecoverBarAuthCodeRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\General\Services\RoleConstant;
use Dotenv\Exception\ValidationException;
use Modules\General\Entities\GUserPos;


class BarAuthCodeService
{

    /**
     * Recover barcode auth code of role $role
     *
     * @param string $role
     * @param RecoverBarAuthCodeRequest $request
     * @return array
     */
    public function recoverBarAuthCode($role, RecoverBarAuthCodeRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->checkRole($role);
            $user = GUserPos::where('id', $request->g_user_id)->where('flag_delete', false)->first();
            if (!$user) {
                throw new ValidationException('Usuario no encontrado');
            }
            if (!$user->hasRole($role)) {
                throw new ValidationException("El usuario no posee el rol '$role'");
            }
            $barAuthCode = $this->getNewBarAuthCode();
            $user->bar_auth_code = $barAuthCode;
            $user->save();
            return CustomResponse::ok(['bar_auth_code' => $barAuthCode]);
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            return CustomResponse::error($e);
        }
    }

    /**
     * Generates new bar auth code
     *
     * @return string (The bar auth code)
     */
    public function getNewBarAuthCode()
    {
        $barAuthCode = '';
        do {
            $barAuthCodeNumber = random_int(50, 99999999999);
            $barAuthCode = "U".str_pad("$barAuthCodeNumber", 11, '0', STR_PAD_LEFT);
        } while( $this->isBarAuthCodeAlreadyTaken($barAuthCode) );
        return $barAuthCode;
    }

    /**
     * Return true if barauthcode is already taken (some user has the same bar auth code)
     *
     * @param string $barAuthCode
     * @return boolean
     */
    private function isBarAuthCodeAlreadyTaken($barAuthCode)
    {
        return GUserPos::where('bar_auth_code', $barAuthCode)->where('flag_delete', false)->first() != null;
    }

    /**
     * Check if role is in available roles
     * If not, throws ValidationException
     *
     * @param string $role
     * @return void
     */
    private function checkRole($role)
    {
        if (!in_array($role, RoleConstant::AVAILABLE_BAR_AUTH_CODE_ROLES))
        {
            $strAvailableRoles = implode(', ', RoleConstant::AVAILABLE_BAR_AUTH_CODE_ROLES);
            throw new ValidationException("El rol debe ser uno de estos roles: '$strAvailableRoles'");
        }
    }

}
