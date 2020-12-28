<?php

namespace Modules\Pos\Services\DTE\Entities\SubsectionDTE\Factura;

use Modules\Pos\Services\DTE\Helpers\Helpers;
use Modules\Pos\Services\DTE\Exceptions\ValidateDTEFieldsException;

class Total 
{
    // Variables
    private $montoNeto;
    private $tasaIVA;
    private $iva;
    private $montoTotal;

    public function __construct($montoNeto, $tasaIVA, $iva, $montoTotal)
    {
        $checkResponse = $this->checkFields($montoNeto, $tasaIVA, $iva, $montoTotal);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);
            
        $this->montoNeto = $montoNeto;
        $this->tasaIVA = $tasaIVA;
        $this->iva = $iva;
        $this->montoTotal = $montoTotal;
    } // end construct    
    
    /**
     * FIXME: add comments
     */
    public function checkFields($montoNeto, $tasaIVA, $iva, $montoTotal)
    {
        if(! Helpers::amountValidate($montoNeto))  
            return [
                "status" => "success",
                "error" => "Error validation field 'Monto Neto' = '$montoNeto' in 'Total DTE section'",
            ];
            
        if(! Helpers::amountValidate($tasaIVA))  
            return [
                "status" => "success",
                "error" => "Error validation field 'Tasa IVA' = '$tasaIVA' in 'Total DTE section'",
            ];

        if(! Helpers::amountValidate($iva))  
            return [
                "status" => "success",
                "error" => "Error validation field 'iva' = '$iva' in 'Total DTE section'",
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
     * Get the value of montoNeto
     */ 
    public function getMontoNeto()
    {
        return $this->montoNeto;
    }

    /**
     * Get the value of tasaIVA
     */ 
    public function getTasaIVA()
    {
        return $this->tasaIVA;
    }

    /**
     * Get the value of iva
     */ 
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Get the value of montoTotal
     */ 
    public function getMontoTotal()
    {
        return $this->montoTotal;
    }

} // end function
