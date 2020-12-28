<?php

namespace Modules\Pos\Services\DTEPos\Entities\SubsectionDTE\Boleta;

use Modules\Pos\Services\DTEPos\Helpers\Helpers;
use Modules\Pos\Services\DTEPos\Exceptions\ValidateDTEFieldsException;

class Encabezado 
{
    // Const
    private const CODE_BOLETA_AFECTA = 39;
    private const CODE_BOLETA_EXENTA = 41;
    
    // Variables
    protected $tipoDte;
    private $folio;
    private $fechaEmision;
    private $indServicio;

    /**
     * FIXME: add comments
     */
    public function __construct($folio, $fechaEmision, $bIsAfecta, $indiceServicio = null)
    {
        $tipoDte =  $bIsAfecta ? self::CODE_BOLETA_AFECTA: self::CODE_BOLETA_EXENTA;
        
        $checkResponse = $this->checkFields($folio, $fechaEmision, $tipoDte, $indiceServicio);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);

        // computed
        $this->tipoDte = $tipoDte;
        $this->folio = $folio;
        $this->fechaEmision = $fechaEmision;
        $this->indServicio = $indiceServicio;
    } // end construct

    /**
     * FIXME: add comments
     */
    private function checkFields($folio, $fechaEmision, $tipoDte, $indiceServicio)
    {
        if(! intval($folio))  
            return [
                "status" => "error",
                "error" => "Error validation field 'Folio' = '$folio' in 'Encabezado DTE section'",
            ];
            
        if(! Helpers::validateDate($fechaEmision, 'Y-m-d'))
            return [
                "status" => "error",
                "error" => "Error validation field 'Fecha emisión' = '$fechaEmision' in 'Encabezado DTE section'",
            ];

        if(! Helpers::correctBoletaDTECode($tipoDte))
            return [
                "status" => "error",
                "error" => "Error validation field 'DTE Code' = '$tipoDte' in 'Encabezado DTE section'",
            ];

        if(isset($indiceServicio) && ! Helpers::correctIndiceServicioCode($indiceServicio))
            return [
                "status" => "error",
                "error" => "Error validation field 'Indice Servicio Code' = '$indiceServicio' in 'Encabezado DTE section'",
            ];

        return [
            "status" => "success"
        ];
    } // end function
    
    public function setTypeDte($tipoDte)
    {
        return $this->tipoDte = $tipoDte;
    } // end function

    // Getters
    /**
     * Get the value of tipoDte
     */ 
    public function getTipoDte()
    {
        return $this->tipoDte;
    }

    /**
     * Get the value of folio
     */ 
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * Get the value of rutEmisor
     */ 
    public function getFechaEmision()
    {
        return $this->fechaEmision;
    }

    /**
     * Get the value of indServicio
     */ 
    public function getIndServicio()
    {
        return $this->indServicio;
    }
} // end function
