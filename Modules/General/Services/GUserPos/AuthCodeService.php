<?php

namespace Modules\General\Services\GUserPos;

use Modules\General\Entities\GUserPos;


class AuthCodeService
{

    public function generate()
    {
        $authCode = '';
        do {
            $authCodeNumber = random_int(1, 999);
            $authCode = str_pad("$authCodeNumber", 3, '0', STR_PAD_LEFT);
        } while( $this->isAuthCodeAlreadyTaken($authCode) );
        return $authCode;
    }

    private function isAuthCodeAlreadyTaken($AuthCode)
    {
        return GUserPos::where('auth_code', $AuthCode)->where('flag_delete', false)->first() != null;
    }

}
