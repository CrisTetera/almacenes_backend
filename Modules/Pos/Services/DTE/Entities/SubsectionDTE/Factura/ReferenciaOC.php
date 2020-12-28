<?php

namespace Modules\Pos\Services\DTE\Entities\SubsectionDTE\Factura;

use Modules\Pos\Services\DTE\Helpers\Helpers;
use Modules\Pos\Services\DTE\Exceptions\ValidateDTEFieldsException;

class ReferenciaOC
{   
    // Variables
    private $nroLinRef;
    private $tpoDocRef;
    private $folioRef;
    private $rutOtr;
    private $fchRef;
    private $razonRef;

    /**
     * FIXME: add comments
     */
    public function __construct($nroLinRef,$tpoDocRef, $folioRef, $rutOtr, $fchRef, $razonRef)
    {        
        $checkResponse = $this->checkFields($nroLinRef, $tpoDocRef, $folioRef, $rutOtr, $fchRef, $razonRef);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);

        $this->nroLinRef = $nroLinRef;
        $this->tpoDocRef = $tpoDocRef;
        $this->folioRef = $folioRef;
        $this->rutOtr = $rutOtr;
        $this->fchRef = $fchRef;
        $this->razonRef = $razonRef;
    } // end construct

    /**
     * FIXME: add comments
     */
    private function checkFields($nroLinRef,$tpoDocRef, $folioRef, $rutOtr, $fchRef, $razonRef)
    {
        if(! intval($nroLinRef))
            return [
                "status" => "error",
                "error" => "Error validation field 'nroLinRef' = '$nroLinRef' in 'Referencia OC DTE section'",
            ];

        if(! Helpers::correctOC_DTECode($tpoDocRef))
            return [
                "status" => "error",
                "error" => "Error validation field 'TpoDocRef' = '$tpoDocRef' in 'Referencia OC DTE section'",
            ];

        if(! intval($folioRef))
            return [
                "status" => "error",
                "error" => "Error validation field 'FolioRef' = '$folioRef' in 'Referencia OC DTE section'",
            ];

        if(! Helpers::rutValidate($rutOtr))
            return [
                "status" => "error",
                "error" => "Error validation field 'rutOtr' = '$rutOtr' in 'Referencia OC DTE section'",
            ];

        if(! verifyDate($fchRef, 'Y-m-d'))
            return [
                "status" => "error",
                "error" => "Error validation field 'FchRef' = '$fchRef' in 'Referencia OC DTE section'",
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
     * Get the value of nroLinRef
     */ 
    public function getNroLinRef()
    {
        return $this->nroLinRef;
    }

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
     * Get the value of rutOtr
     */ 
    public function getRutOtr()
    {
        return $this->rutOtr;
    }

    /**
     * Get the value of fchRef
     */ 
    public function getFchRef()
    {
        return $this->fchRef;
    }

    /**
     * Get the value of razonRef
     */ 
    public function getRazonRef()
    {
        return $this->razonRef;
    }
}