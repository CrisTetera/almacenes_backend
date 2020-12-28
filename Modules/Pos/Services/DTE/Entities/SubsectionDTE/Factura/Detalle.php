<?php

namespace Modules\Pos\Services\DTE\Entities\SubsectionDTE\Factura;

use Modules\Pos\Services\DTE\Helpers\Helpers;
use Modules\Pos\Services\DTE\Exceptions\ValidateDTEFieldsException;

class Detalle 
{
    // Variables
    private $arrDetalle;

    private $indExe;
    private $nroLinDte;
    private $nmbItem;
    private $qtyItem;
    private $prcItem;
    private $montoItem;
    private $descuentoPct;
    private $descuentoMonto;

    // FIXME: add correct comments
    public function __construct($indExe, $nroLinDte, $nmbItem, $qtyItem, $prcItem, $montoItem, $descuentoPct, $descuentoMonto)
    {
        $checkResponse = $this->checkFields($indExe, $nroLinDte, $nmbItem, $qtyItem, $prcItem, $montoItem, $descuentoPct, $descuentoMonto);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);
        
        $this->indExe = $indExe;
        $this->nroLinDte = $nroLinDte;
        $this->nmbItem = $nmbItem;
        $this->qtyItem = $qtyItem;
        $this->prcItem = $prcItem;
        $this->montoItem = $montoItem;
        $this->descuentoPct = $descuentoPct;
        $this->descuentoMonto = $descuentoMonto;
    }

    /**
     * FIXME: add comments
     */
    public function checkFields($indExe, $nroLinDte, $nmbItem, $qtyItem, $prcItem, $montoItem, $descuentoPct, $descuentoMonto)
    {
        if(! Helpers::booleanIntValidate($indExe))  
            return [
                "status" => "error",
                "error" => "Error validation field 'Ind Exe' = '$indExe' in 'Detalle DTE section'",
            ];
 
        if(! intval($nroLinDte))  
            return [
                "status" => "error",
                "error" => "Error validation field 'NroLinDte' = '$nroLinDte' in 'Detalle DTE section'",
            ];
 
        if(! Helpers::stringNotVoid($nmbItem))  
            return [
                "status" => "error",
                "error" => "Error validation field 'NmbItem' = '$nmbItem' in 'Detalle DTE section'",
            ];
        
 
        if(! Helpers::amountValidate($qtyItem))  
            return [
                "status" => "error",
                "error" => "Error validation field 'QtyItem' = '$qtyItem' 'Detalle DTE section'",
            ];
        
 
        if(! Helpers::amountValidate($prcItem))  
            return [
                "status" => "error",
                "error" => "Error validation field 'PrcItem' = '$prcItem' 'Detalle DTE section'",
            ];
        
 
        if(! Helpers::amountValidate($montoItem))  
            return [
                "status" => "error",
                "error" => "Error validation field 'MontoItem' = '$montoItem' 'Detalle DTE section'",
            ];
 
        if(! Helpers::amountZeroEnableValidate($descuentoMonto))  
            return [
                "status" => "error",
                "error" => "Error validation field 'DescuentoMonto' = '$descuentoMonto' 'Detalle DTE section'",
            ];

        // if(! Helpers::percentageValidate($descuentoPct))  
        //     return [
        //         "status" => "error",
        //         "error" => "Error validation field 'DescuentoPct' = '$descuentoPct' 'Detalle DTE section'",
        //     ];
                
        return [
            "status" => "success"
        ];
    } // end function


    /**
     * Get the value of indExe
     */ 
    public function getIndExe()
    {
        return $this->indExe;
    }

    /**
     * Get the value of nroLinDte
     */ 
    public function getNroLinDte()
    {
        return $this->nroLinDte;
    }

    /**
     * Get the value of nmbItem
     */ 
    public function getNmbItem()
    {
        return $this->nmbItem;
    }

    /**
     * Get the value of qtyItem
     */ 
    public function getQtyItem()
    {
        return $this->qtyItem;
    }

    /**
     * Get the value of prcItem
     */ 
    public function getPrcItem()
    {
        return $this->prcItem;
    }

    /**
     * Get the value of montoItem
     */ 
    public function getMontoItem()
    {
        return $this->montoItem;
    }

    /**
     * Get the value of descuentoPct
     */ 
    public function getDescuentoPct()
    {
        return $this->descuentoPct;
    }

    /**
     * Get the value of descuentoMonto
     */ 
    public function getDescuentoMonto()
    {
        return $this->descuentoMonto;
    }
} // end function
