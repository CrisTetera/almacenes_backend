<?php

namespace Modules\Pos\Services\DTEPos\Entities\SubsectionDTE\Boleta;

use Modules\Pos\Services\DTEPos\Helpers\Helpers;
use Modules\Pos\Services\DTEPos\Exceptions\ValidateDTEFieldsException;

class Total 
{
    // Variables
    private $montoTotal;
    private $montoExe;

    public function __construct($montoExe, $montoTotal)
    {
        $checkResponse = $this->checkFields($montoExe, $montoTotal);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);
        $this->montoExe = $montoExe;
        $this->montoTotal = $montoTotal;
    } // end construct    
    
    /**
     * FIXME: add comments
     */
    public function checkFields($montoExe, $montoTotal)
    {
        if(! Helpers::amountValidate($montoExe))  
            return [
                "status" => "success",
                "error" => "Error validation field 'Monto Exento' = '$montoExe' in 'Total DTE section'",
            ];
            
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

    /**
     * Get the value of montoNeto
     */ 
    public function getMontoExe()
    {
        return $this->montoExe;
    }
} // end function
