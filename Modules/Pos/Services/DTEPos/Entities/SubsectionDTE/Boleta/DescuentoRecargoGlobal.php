<?php

namespace Modules\Pos\Services\DTEPos\Entities\SubsectionDTE\Boleta;

use Modules\Pos\Services\DTEPos\Helpers\Helpers;
use Modules\Pos\Services\DTEPos\Exceptions\ValidateDTEFieldsException;

class DescuentoRecargoGlobal 
{
    // Variables
    private $tipoMovimiento;
    private $tipoValor;
    private $valorDRAfecto;
    private $valorDRExento;

    public function __construct($valorDRAfecto, $valorDRExento, $tipoValor, $tipoMovimiento)
    {
        $checkResponse = $this->checkFields($valorDRAfecto, $valorDRExento, $tipoValor, $tipoMovimiento);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);
        
        $this->valorDRAfecto = $valorDRAfecto;
        $this->valorDRExento = $valorDRExento;
        $this->tipoValor = $tipoValor; //FIXME: Add 2 options: '%' or '$'
        //  Always equals
        $this->tipoMovimiento = $tipoMovimiento;
    } // end construct


    /**
     * FIXME: add comments
     */
    private function checkFields($valorDRAfecto, $valorDRExento, $tipoValor, $tipoMovimiento)
    {            
        if(! Helpers::typeDiscountOrChargeValidate($tipoValor))
            return [
                "status" => "error",
                "error" => "Error validation field 'Tipo Valor' = '$tipoValor' in 'Descto./Rec. DTE section'",
            ];

        if
        ( 
            ($tipoValor === '%' && ! Helpers::percentageZeroEnableValidate($valorDRAfecto)) ||
            ($tipoValor === '$' && ! Helpers::amountZeroEnableValidate($valorDRAfecto))
        ) 
            return [
                "status" => "error",
                "error" => "Error validation field 'Valor DR Afecto' = '$valorDRAfecto' in 'Descto./Rec. DTE section'",
            ];

        if
        (
            ($tipoValor === '%' && ! Helpers::percentageZeroEnableValidate($valorDRExento)) ||
            ($tipoValor === '$' && ! Helpers::amountZeroEnableValidate($valorDRExento))
        )
            return [
                "status" => "error",
                "error" => "Error validation field 'Valor DR Exento' = '$valorDRExento' in 'Descto./Rec. DTE section'",
            ];
        
        if(! Helpers::typeMovementValidate($tipoMovimiento))
            return [
                "status" => "error",
                "error" => "Error validation field 'Tipo Movimiento' = '$tipoMovimiento' in 'Descto./Rec. DTE section'",
            ];

        return [
            "status" => "success"
        ];
    } // end function

    // Getters

    /**
     * Get the value of tipoMovimiento
     */ 
    public function getTipoMovimiento()
    {
        return $this->tipoMovimiento;
    }

    /**
     * Get the value of tipoValor
     */ 
    public function getTipoValor()
    {
        return $this->tipoValor;
    }

    /**
     * Get the value of valorDR
     */ 
    public function getValorDRAfecto()
    {
        return $this->valorDRAfecto;
    }
    /**
     * Get the value of valorDR
     */ 
    public function getValorDRExento()
    {
        return $this->valorDRExento;
    }

    /**
     * Get the value of indExeDR
     */ 
    public function getIndExeDR()
    {
        return $this->valorDRExento > 0 ? 1 : 0;
    }
} // end function
