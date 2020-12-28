<?php

namespace Modules\Pos\Services\DTEPos\FileStorage;

use Carbon\Carbon;
use Modules\Pos\Services\DTEPos\Exceptions\SaveFileDteException;

class LogoDteFileStorage
{
    // FIXME: Add comments
    public static function base64ToFile(string $path, string $base64, string $folio)
    {
        $data = base64_decode($base64);
        
        $now = Carbon::now();
        $path = "$path/$now->year/$now->month/$now->day";
        $pathFile = "$path/logo-$folio.png";

        if (! file_exists($path))
            mkdir($path, 0777, true);
            
        $response = file_put_contents($pathFile, $data);

        // error in write file
        if($response === false)
            throw new SaveFileDteException("Error in write file in $pathFile");

        return $pathFile;
    } // end function
} // end class