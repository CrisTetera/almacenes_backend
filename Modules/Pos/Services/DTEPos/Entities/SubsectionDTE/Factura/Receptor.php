<?php

namespace Modules\Pos\Services\DTEPos\Entities\SubsectionDTE\Factura;

use Modules\Pos\Services\DTEPos\Helpers\Helpers;
use Modules\Pos\Services\DTEPos\Exceptions\ValidateDTEFieldsException;

class Receptor 
{
    // Variables
    private $rutReceptor;
    private $razonSocialReceptor;
    private $giroReceptor;
    private $direccionReceptor;
    private $comunaReceptor;

    public function __construct($rutReceptor, $razonSocialReceptor, $giroReceptor, $direccionReceptor, $comunaReceptor)
    {
        $checkResponse = $this->checkFields($rutReceptor, $razonSocialReceptor, $giroReceptor, $direccionReceptor, $comunaReceptor);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);
        
        $this->rutReceptor          = $rutReceptor;
        $this->razonSocialReceptor  = $razonSocialReceptor;
        $this->giroReceptor         = $giroReceptor;
        $this->direccionReceptor    = $direccionReceptor;
        $this->comunaReceptor       = $comunaReceptor;
    }

    /**
     * FIXME: add comments
     */
    public function checkFields($rutReceptor, $razonSocialReceptor, $giroReceptor, $direccionReceptor, $comunaReceptor)
    {
        if(! Helpers::rutValidate($rutReceptor))  
            return [
                "status" => "error",
                "error" =>"Error validation field 'Rut Receptor' = '$rutReceptor' in 'Receptor DTE section'"
            ];
            
        if(! Helpers::stringNotVoid($razonSocialReceptor))  
            return [
                "status" => "error",
                "error" =>"Error validation field 'Razón Social Receptor' = '$razonSocialReceptor' in 'Receptor DTE section'"
            ];

        if(! Helpers::stringNotVoid($giroReceptor))  
            return [
                "status" => "error",
                "error" =>"Error validation field 'Giro Receptor' = '$giroReceptor' in 'Receptor DTE section'"
            ];

        if(! Helpers::stringNotVoid($direccionReceptor))  
            return [
                "status" => "error",
                "error" =>"Error validation field 'Dirección Receptor' = '$direccionReceptor' in 'Receptor DTE section'"
            ];
        
        if(! Helpers::stringNotVoid($comunaReceptor))  
            return [
                "status" => "error",
                "error" =>"Error validation field 'Comuna Receptor' = '$comunaReceptor' in 'Receptor DTE section'"
            ];
        
        return [
            "status" => "success"
        ];
    } // end function

    /**
     * Get the value of rutReceptor
     */ 
    public function getRutReceptor()
    {
        return $this->rutReceptor;
    }

    /**
     * Get the value of razonSocialReceptor
     */ 
    public function getRazonSocialReceptor()
    {
        return $this->razonSocialReceptor;
    }

    /**
     * Get the value of giroReceptor
     */ 
    public function getGiroReceptor()
    {
        return $this->giroReceptor;
    }

    /**
     * Get the value of direccionReceptor
     */ 
    public function getDireccionReceptor()
    {
        return $this->direccionReceptor;
    }

    /**
     * Get the value of comunaReceptor
     */ 
    public function getComunaReceptor()
    {
        return $this->comunaReceptor;
    }
} // end function