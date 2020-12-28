<?php

namespace Modules\Pos\Services\DTEPos\Entities\SubsectionDTE\Factura;

use Modules\Pos\Services\DTEPos\Helpers\Helpers;
use Modules\Pos\Services\DTEPos\Exceptions\ValidateDTEFieldsException;

class Encabezado 
{
    // Const
    private const CODE_FACTURA_AFECTA = 33; 
    private const CODE_FACTURA_EXENTA = 34; 
    
    // Variables
    protected $tipoDte;
    private $folio;
    private $fechaEmision;
    private $tipoTransaccionCompra;
    private $tipoTransaccionVenta;
    private $formaPago;
    private $indServicio;

    /**
     * FIXME: add comments
     */
    public function __construct($folio, $fechaEmision, $bIsAfecta, $tipoTransaccionCompra, 
                                $tipoTransaccionVenta, $formaPago, $indiceServicio = null)
    {
        $tipoDte =  $bIsAfecta ? self::CODE_FACTURA_AFECTA: self::CODE_FACTURA_EXENTA;
        
        $checkResponse = $this->checkFields($folio, $fechaEmision, $tipoDte, $tipoTransaccionCompra, 
                                            $tipoTransaccionVenta, $formaPago, $indiceServicio);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);

        // computed
        $this->tipoDte = $tipoDte;
        $this->folio = $folio;
        $this->fechaEmision = $fechaEmision;
        $this->tipoTransaccionCompra = $tipoTransaccionCompra;
        $this->tipoTransaccionVenta = $tipoTransaccionVenta;
        $this->formaPago = $formaPago;
        // computed
        $this->indServicio = $indiceServicio;
    } // end construct

    /**
     * FIXME: add comments
     */
    private function checkFields($folio, $fechaEmision, $tipoDte, $tipoTransaccionCompra, 
                                 $tipoTransaccionVenta, $formaPago, $indiceServicio)
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

        if(! Helpers::correctFacturaDTECode($tipoDte))
            return [
                "status" => "error",
                "error" => "Error validation field 'DTE Code' = '$tipoDte' in 'Encabezado DTE section'",
            ];

        if(! Helpers::correctTipoTransaccionCode($tipoTransaccionCompra))
            return [
                "status" => "error",
                "error" => "Error validation field 'Tipo Transacción Compra Code' = '$tipoTransaccionCompra' in 'Encabezado DTE section'",
            ];

        if(! Helpers::correctTipoTransaccionCode($tipoTransaccionVenta))
            return [
                "status" => "error",
                "error" => "Error validation field 'Tipo Transacción Venta Code' = '$tipoTransaccionVenta' in 'Encabezado DTE section'",
            ];

        if(! Helpers::correctFormaPagoCode($formaPago))
            return [
                "status" => "error",
                "error" => "Error validation field 'Forma Pago Code' = '$formaPago' in 'Encabezado DTE section'",
            ];

        if(isset($indiceServicio) && ! Helpers::correctFormaPagoCode($indiceServicio))
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
     * Get the value of tipoTransaccionCompra
     */ 
    public function getTipoTransaccionCompra()
    {
        return $this->tipoTransaccionCompra;
    }

    /**
     * Get the value of tipoTransaccionVenta
     */ 
    public function getTipoTransaccionVenta()
    {
        return $this->tipoTransaccionVenta;
    }

    /**
     * Get the value of formaPago
     */ 
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * Get the value of indServicio
     */ 
    public function getIndServicio()
    {
        return $this->indServicio;
    }
} // end function
