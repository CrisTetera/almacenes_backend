<?php

namespace Modules\Warehouse\Services\WhProductPos;

use Modules\Warehouse\Http\Requests\WhProductPos\SuggestCodeRequest;
use Modules\Warehouse\Entities\WhProductPos;


class SuggestCodeService
{
    public function suggestUpcCode()
    {
        $upc = '';
        do {
            $upcNumber = random_int(50, 999999999999);
            $upc = str_pad("$upcNumber", 12, '0', STR_PAD_LEFT);
        } while( $this->isUpcCodeTaken($upc) );
        return $upc;
    }

    private function isUpcCodeTaken($upc)
    {
        return WhProductPos::where('upc', $upc)->where('flag_delete', 0)->count() > 0;
    }
}
