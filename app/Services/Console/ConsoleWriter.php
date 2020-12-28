<?php

namespace App\Services\Console;

use Illuminate\Console\Command;

class ConsoleWriter
{
    public static function writeConsole(array $responseTask, Command $command)
    {
        if($responseTask['status'] == 'success')
        {
            $command->info('status:' . $responseTask['status']);
            $command->info('message:' . $responseTask['message']);
        }
        else //error status
        {
            $command->error('status:' . $responseTask['status']); 
            $command->error('message:' . $responseTask['message']); 
            $command->error('error:' . $responseTask['error']); 
            $command->error('file:' . $responseTask['file']); 
            $command->error('line:' . $responseTask['line']); 
        }
    } // end class
} // end class