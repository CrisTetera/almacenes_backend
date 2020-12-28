<?php

namespace App\Services\Logs;

class LogFileWriter
{
    public static function writeLogFile(array $responseTask, string $chanelLog)
    {
        if($responseTask['status'] == 'success')
        {
            \Log::channel($chanelLog)->info($responseTask['message']);
        }
        else //error status
        {
            $errorMessage  = $responseTask['message'] . '. '; 
            $errorMessage .= 'Exception: ' . $responseTask['error'] . '. '; 
            $errorMessage .= 'File: ' . $responseTask['file'] . '. '; 
            $errorMessage .= 'Line: ' . $responseTask['line'] . '.'; 

            \Log::channel($chanelLog)->error($errorMessage);

            if(env('APP_ENV') === 'production')
                \Log::channel('slack')->critical($errorMessage);
        }
    } // end class
} // end class