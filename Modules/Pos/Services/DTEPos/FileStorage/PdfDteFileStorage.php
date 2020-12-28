<?php

namespace Modules\Pos\Services\DTEPos\FileStorage;

use Carbon\Carbon;
use Modules\Pos\Services\DTEPos\Exceptions\SaveFileDteException;

class PdfDteFileStorage
{
    // FIXME: Add comments
    public static function base64ToFile(string $path, string $base64, string $folio)
    {
        $data = base64_decode($base64);
        
        $now = Carbon::now();
        $pathFile = "$path/$now->year/$now->month/$now->day/dte-$folio.pdf";
            
        $response = file_put_contents($pathFile, $data);

        // error in write file
        if($response === false)
            throw new SaveFileDteException("Error in write file in $pathFile");

        return $pathFile;
    } // end function
} // end class