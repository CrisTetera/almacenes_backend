<?php

namespace Modules\Pos\Services\DTEPos\Entities\SubsectionDTE\Factura;

use Modules\Pos\Services\DTEPos\Helpers\Helpers;
use Modules\Pos\Services\DTEPos\Exceptions\ValidateDTEFieldsException;

class Emisor 
{
    // Variables
    private $rutEmisor;
    private $razonSocial;
    private $giroComercial;
    private $codActividadComercial;
    private $direccionOrigen;
    private $comunaOrigen;
    private $codigoSucursalSII;

    public function __construct($rutEmisor, $razonSocial, $giroComercial, $codActividadComercial, $direccionOrigen, $comunaOrigen, $codigoSucursalSII)
    {
        $checkResponse = $this->checkFields($rutEmisor, $razonSocial, $giroComercial, $codActividadComercial, 
                                            $direccionOrigen, $comunaOrigen, $codigoSucursalSII);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);
        
        $this->rutEmisor = $rutEmisor;
        $this->razonSocial = $razonSocial;
        $this->giroComercial = $giroComercial;
        $this->codActividadComercial = $codActividadComercial;
        $this->direccionOrigen = $direccionOrigen;
        $this->comunaOrigen = $comunaOrigen;
        $this->codigoSucursalSII = $codigoSucursalSII;
        
    }

    /**
     * FIXME: add comments
     */
    public function checkFields($rutEmisor, $razonSocial, $giroComercial, $codActividadComercial, 
                                $direccionOrigen, $comunaOrigen, $codigoSucursalSII)
    {
        if(! Helpers::rutValidate($rutEmisor))  
            return [
                "status" => "error",
                "error" => "Error validation field 'Rut Emisor' = '$rutEmisor' in 'Emisor DTE section'",
            ];
            
        if(! Helpers::stringNotVoid($razonSocial))
            return [
                "status" => "error",
                "error" => "Error validation field 'Razón Social' = '$razonSocial' in 'Emisor DTE section'",
            ];

        if(! Helpers::stringNotVoid($giroComercial))
            return [
                "status" => "error",
                "error" => "Error validation field 'Giro Comercial' = '$giroComercial' in 'Emisor DTE section'",
            ];
        
        if(! Helpers::correctActecoCode($codActividadComercial))
            return [
                "status" => "error",
                "error" => "Error validation field 'Código actividad comercial' = '$codActividadComercial' in 'Emisor DTE section'",
            ];
        
        if(! Helpers::stringNotVoid($direccionOrigen))
            return [
                "status" => "error",
                "error" => "Error validation field 'Dirección origen' = '$direccionOrigen' in 'Emisor DTE section'",
            ];
        
        if(! Helpers::stringNotVoid($comunaOrigen))
            return [
                "status" => "error",
                "error" => "Error validation field 'Comuna origen' = '$comunaOrigen' in 'Emisor DTE section'",
            ];
        
        if(! Helpers::correctSucursalCodeSII($codigoSucursalSII))
            return [
                "status" => "error",
                "error" => "Error validation field 'Código Sucursal SII' = '$codigoSucursalSII' in 'Emisor DTE section'",
            ];

        return [
            "status" => "success"
        ];
    } // end function

    // Getters
    /**
     * Get the value of rutEmisor
     */ 
    public function getRutEmisor()
    {
        return $this->rutEmisor;
    }

    /**
     * Get the value of razonSocial
     */ 
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * Get the value of giroComercial
     */ 
    public function getGiroComercial()
    {
        return $this->giroComercial;
    }

    /**
     * Get the value of codActividadComercial
     */ 
    public function getCodActividadComercial()
    {
        return $this->codActividadComercial;
    }

    /**
     * Get the value of direccionOrigen
     */ 
    public function getDireccionOrigen()
    {
        return $this->direccionOrigen;
    }

    /**
     * Get the value of comunaOrigen
     */ 
    public function getComunaOrigen()
    {
        return $this->comunaOrigen;
    }

    /**
     * Get the value of codigoSucursalSII
     */ 
    public function getCodigoSucursalSII()
    {
        return $this->codigoSucursalSII;
    }
} // end function
