<?php

namespace Modules\Pos\Services\DTEPos\Exceptions;

use Exception;

class ResponseFromOFException extends Exception
{

    public $dteResponse;

    public function __construct($dteResponse)
    {
        parent::__construct($dteResponse['message']);
        $this->dteResponse = $dteResponse;

    }

}
