<?php

namespace Modules\Warehouse\Services\WhProduct;

use Modules\Warehouse\Http\Requests\WhProduct\SuggestCodeRequest;
use Modules\Warehouse\Entities\WhProduct;
use Modules\Warehouse\Entities\WhProductUpcCode;


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
        return WhProductUpcCode::where('upc_code', $upc)->where('flag_delete', 0)->count() > 0;
    }

    public function suggestInternalCode(SuggestCodeRequest $request)
    {
        // First three digit, with "0" padding to the left
        $family = str_pad( substr("$request->family_id", 0, 3) , 3, '0', STR_PAD_LEFT);
        $subfamily = str_pad( substr("$request->subfamily_id", 0, 3) , 3, '0', STR_PAD_LEFT);
        // Upercase first word
        $productName = strtoupper( substr( explode(' ', $request->product_name)[0], 0, 4 ) );

        $genericCode = "$family$subfamily$productName";

        $sequenceNumber = 1 + WhProduct::where('internal_code', 'LIKE', "$genericCode%")->where('flag_delete', 0)->count();
        $sequenceNumber = str_pad("$sequenceNumber", 3, '0', STR_PAD_LEFT);

        return "$genericCode$sequenceNumber";
    }
}
