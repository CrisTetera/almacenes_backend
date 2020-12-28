<?php

namespace Modules\Pos\Services\DTEPos\Entities\SubsectionDTE\NotaCredito;

use Modules\Pos\Services\DTEPos\Helpers\Helpers;
use Modules\Pos\Services\DTEPos\Exceptions\ValidateDTEFieldsException;

class Referencia
{
    // Const
    private const CODE_FACTURA_AFECTA = 33; 
    private const CODE_FACTURA_EXENTA = 34; 
    
    // Variables
    private $nroLinRef;
    private $tpoDocRef;
    private $folioRef;
    private $fchaRef;
    private $codRef;
    private $razonRef;

    /**
     * FIXME: add comments
     */
    public function __construct($nroLinRef, $tpoDocRef, $folioRef, $fchaRef, $codRef, $razonRef)
    {        
        $checkResponse = $this->checkFields($nroLinRef, $tpoDocRef, $folioRef, $fchaRef, $codRef, $razonRef);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);

        $this->nroLinRef = $nroLinRef;
        $this->tpoDocRef = $tpoDocRef;
        $this->folioRef = $folioRef;
        $this->fchaRef = $fchaRef;
        $this->codRef = $codRef;
        $this->razonRef = $razonRef;
    } // end construct

    /**
     * FIXME: add comments
     */
    private function checkFields($nroLinRef, $tpoDocRef, $folioRef, $fchaRef, $codRef, $razonRef)
    {
        if(! intval($nroLinRef))
            return [
                "status" => "error",
                "error" => "Error validation field 'NroLinRef' = '$nroLinRef' in 'Referencia DTE section'",
            ];

        if(! Helpers::correctFacturaOrBoletaDTECode($tpoDocRef))
            return [
                "status" => "error",
                "error" => "Error validation field 'TpoDocRef' = '$tpoDocRef' in 'Referencia DTE section'",
            ];

        if(! intval($folioRef))
            return [
                "status" => "error",
                "error" => "Error validation field 'FolioRef' = '$folioRef' in 'Referencia DTE section'",
            ];

        if(! verifyDate($fchaRef, 'Y-m-d'))
            return [
                "status" => "error",
                "error" => "Error validation field 'FchaRef' = '$fchaRef' in 'Referencia DTE section'",
            ];

        if(! Helpers::codeReferenceValidate($codRef))
            return [
                "status" => "error",
                "error" => "Error validation field 'CodRef' = '$codRef' in 'Referencia DTE section'",
            ];

        if(! is_string($razonRef))
            return [
                "status" => "error",
                "error" => "Error validation field 'RazonRef' = '$razonRef' in 'Referencia DTE section'",
            ];

        return [
            "status" => "success"
        ];
    } // end function

    // Getters

    /**
     * Get the value of tpoDocRef
     */ 
    public function getTpoDocRef()
    {
        return $this->tpoDocRef;
    }

    /**
     * Get the value of folioRef
     */ 
    public function getFolioRef()
    {
        return $this->folioRef;
    }

    /**
     * Get the value of fchaRef
     */ 
    public function getFchaRef()
    {
        return $this->fchaRef;
    }

    /**
     * Get the value of codRef
     */ 
    public function getCodRef()
    {
        return $this->codRef;
    }

    /**
     * Get the value of razonRef
     */ 
    public function getRazonRef()
    {
        return $this->razonRef;
    }

    /**
     * Get the value of nroLinRef
     */ 
    public function getNroLinRef()
    {
        return $this->nroLinRef;
    }
}