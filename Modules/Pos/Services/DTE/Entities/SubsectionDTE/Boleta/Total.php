<?php

namespace Modules\Pos\Services\DTE\Entities\SubsectionDTE\Boleta;

use Modules\Pos\Services\DTE\Helpers\Helpers;
use Modules\Pos\Services\DTE\Exceptions\ValidateDTEFieldsException;

class Total 
{
    // Variables
    private $montoTotal;

    public function __construct($montoTotal)
    {
        $checkResponse = $this->checkFields($montoTotal);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);
            
        $this->montoTotal = $montoTotal;
    } // end construct    
    
    /**
     * FIXME: add comments
     */
    public function checkFields($montoTotal)
    {
        if(! Helpers::amountValidate($montoTotal))  
            return [
                "status" => "success",
                "error" => "Error validation field 'Monto Total' = '$montoTotal' in 'Total DTE section'",
            ];
        
        return [
            "status" => "success"
        ];
    } // end function

    // Getters
    
    /**
     * Get the value of montoTotal
     */ 
    public function getMontoTotal()
    {
        return $this->montoTotal;
    }
} // end function
