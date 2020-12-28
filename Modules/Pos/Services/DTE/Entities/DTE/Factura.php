<?php

namespace Modules\Pos\Services\DTE\Entities\DTE;

use Modules\Pos\Services\DTE\Json\Factura\DteToJson; 
use Modules\Pos\Services\DTE\Request\SendDteToApiOF; 
use Modules\Pos\Services\DTE\FileStorage\AllDteFileStorage; 
use Modules\Pos\Services\DTE\Exceptions\ResponseFromOFException; 
use Modules\Pos\Services\DTE\Exceptions\ValidateDTEFieldsException; 
use Modules\Pos\Services\DTE\Exceptions\SaveFileDTEFieldsException; 

use Modules\Pos\Services\DTE\Entities\SubsectionDTE\Factura\Encabezado;
use Modules\Pos\Services\DTE\Entities\SubsectionDTE\Factura\Emisor;
use Modules\Pos\Services\DTE\Entities\SubsectionDTE\Factura\Receptor;
use Modules\Pos\Services\DTE\Entities\SubsectionDTE\Factura\Total;
use Modules\Pos\Services\DTE\Entities\SubsectionDTE\Factura\Detalle;
use Modules\Pos\Services\DTE\Entities\SubsectionDTE\Factura\DescuentoRecargoGlobal;
use Modules\Pos\Services\DTE\Entities\SubsectionDTE\Factura\ReferenciaOC;

class Factura extends DTE
{
    // const
    protected const CODE_FACTURA_AFECTA = 33;
    protected const CODE_FACTURA_EXENTA = 34;
    protected const CODE_OC = 801;

    // Constantes
    protected const ALL_OPTIONS_ARRAY_RESPONSE = ["TOKEN", "XML", "PDF", "TIMBRE", "LOGO", "FOLIO", "RESOLUCION"];
    
    // Attributes
    protected $arrResponse;
    protected $oEncabezado;
    protected $oEmisor;
    protected $oReceptor;
    protected $oTotal;
    protected $oDetalle; // array of Detalle Object
    protected $oDescuentoRecargoGlobal;
    protected $oReferenciaOC;

    /**
     * FIXME: Add comments
     */
    public function __construct($arrResponse = ["TOKEN", "XML", "PDF", "TIMBRE", "LOGO", "FOLIO", "RESOLUCION"])
    {
        $checkResponse = $this->checkFields($arrResponse);
        if($checkResponse['status'] === 'error')
            throw new ValidateDTEFieldsException($checkResponse['error']);

        $this->arrResponse = $arrResponse;
        $this->oDetalle = [];
    } // end function

    /**
     * FIXME: add comments
     */
    public function checkFields($arrResponse)
    {
        if(! is_array($arrResponse))  
            return [
                "status" => "error",
                "error" => "Error validation field 'array response'. The Field is not array"
            ];
        
        if(! count($arrResponse) > 0)  
            return [
                "status" => "error",
                "error" => "Error validation field 'array response'. The field must to be not void array'"
            ];
        
        foreach($arrResponse as $response)
        {
            if(! in_array($response, self::ALL_OPTIONS_ARRAY_RESPONSE))  
                return [
                    "status" => "error",
                    "error" =>"Error validation field 'array response'. Value $response is invalid"
                ];
        } // end foreach
        
        return [
            "status" => "success"
        ];
    } // end function

    /**
     * FIXME: Add comments
     */
    public function setEncabezado($folio, $fechaEmision, $bIsAfecta, $tipoTransaccionCompra, 
                                 $tipoTransaccionVenta, $formaPago, $indiceServicio = null)
    {
        $this->oEncabezado = new Encabezado($folio, $fechaEmision, $bIsAfecta, $tipoTransaccionCompra, 
                                            $tipoTransaccionVenta, $formaPago, $indiceServicio = null);
    } // end function

    /**
     * FIXME: Add comments
     */
    public function setEmisor($rutEmisor, $razonSocial, $giroComercial, $codActividadComercial, 
                              $direccionOrigen, $comunaOrigen, $codigoSucursalSII)
    {
        $this->oEmisor = new Emisor($rutEmisor, $razonSocial, $giroComercial, $codActividadComercial, 
                                    $direccionOrigen, $comunaOrigen, $codigoSucursalSII);
    }

    /**
     * FIXME: Add comments
     */
    public function setReceptor($rutReceptor, $razonSocialReceptor, $giroReceptor, $direccionReceptor, $comunaReceptor)
    {
        $this->oReceptor = new Receptor($rutReceptor, $razonSocialReceptor, $giroReceptor, $direccionReceptor, $comunaReceptor);
    }

    /**
     * FIXME: Add comments
     */
    public function setTotales($montoNeto, $tasaIVA, $iva, $montoTotal)
    {
        $this->oTotal = new Total($montoNeto, $tasaIVA, $iva, $montoTotal);
    }

    /**
     * FIXME: Add comments
     */
    public function addLineaDetalle($IndExe, $NroLinDte, $NmbItem, $QtyItem, $PrcItem, $MontoItem, $DescuentoPct, $DescuentoMonto)
    {
        array_push(
            $this->oDetalle, 
            new Detalle($IndExe, $NroLinDte, $NmbItem, $QtyItem, $PrcItem, $MontoItem, $DescuentoPct, $DescuentoMonto)
        );
    }

    /**
     * FIXME: Add comments
     */
    public function setDescuentoRecargoGlobal($valorDRAfecto, $valorDRExento, $tipoValor, $tipoMovimiento)
    {
        $this->oDescuentoRecargoGlobal = new DescuentoRecargoGlobal($valorDRAfecto, $valorDRExento, $tipoValor, $tipoMovimiento);
    }

    /**
     * FIXME: add comments
     */
    public function setReferenciaOC($folioRef, $rutOtr, $fchRef)
    {
        // same params for reference OC
        $nroLinRef = 1; // specific any line (only for respect API DTE)
        $tpoDocRef = self::CODE_OC;
        $razonRef = 'Trazabilidad con OC cliente';

        // Set ReferenciaOC attribute
        $this->oReferenciaOC = new ReferenciaOC($nroLinRef,$tpoDocRef, $folioRef, $rutOtr, $fchRef, $razonRef);
    }

    /**
     * FIXME: Add comments
     */
    public function hasDescuentoGlobal()
    {
        return isset($this->oDescuentoRecargoGlobal);
    }

    /**
     * FIXME: Add comments
     */
    public function hasReferenciaOC()
    {
        return isset($this->oReferenciaOC);
    }

    /**
     * FIXME: Add comments
     */
    public function getJson()
    {
        $dteToJson = new DteToJson($this);
        return $dteToJson->getJson();
    }

    // FIXME: add comments
    public function sendDte()
    {
        $sendDteToApiOF = new SendDteToApiOF();
        $response = $sendDteToApiOF->sendDTE(
            $this->getJson()
        );

        $checkResponseApi = $this->checkResponseApi($response['payload']);
        if($checkResponseApi['status'] === 'success')
            $this->addPayloadToAttributesDTE($response['payload']);
        else //status error
            throw new ResponseFromOFException($checkResponseApi['error']); 

        return $response;
    } // end function

    /**
     * FIXME: Add comments
     */
    protected function checkResponseApi($payloadResponse)
    {
        if(! isset($payloadResponse))
            return [
                "status" => "error",
                "error" => "Response from Open Factura is void",
            ];
        
        if(! isset($payloadResponse['TOKEN']))
            return [
                "status" => "error",
                "error" => "Response from Open Factura without 'TOKEN' field"
            ];

        if(! isset($payloadResponse['FOLIO']))
            return [
                "status" => "error",
                "error" => "Response from Open Factura without 'FOLIO' field"
            ];

        if(! isset($payloadResponse['LOGO']))
            return [
                "status" => "error",
                "error" => "Void Response from Open Factura without 'LOGO' field",
            ];

        if(! isset($payloadResponse['PDF']))
            return [
                "status" => "error",
                "error" => "Void Response from Open Factura without 'PDF' field",
            ];

        if(! isset($payloadResponse['TIMBRE']))
            return [
                "status" => "error",
                "error" => "Void Response from Open Factura without 'TMBRE' field",
            ];

        if(! isset($payloadResponse['XML']))
            return [
                "status" => "error",
                "error" => "Void Response from Open Factura without 'XML' field"
            ];
        
        return [
            "status" => "success"
        ];
    } // end function

    /**
     * FIXME: add comments
     */
    protected function addPayloadToAttributesDTE($payload)
    {
        $this->token        = isset($payload['TOKEN']) ? $payload['TOKEN'] : null;         
        $this->folio        = isset($payload['FOLIO']) ? $payload['FOLIO'] : null; 
        $this->logoBase64   = isset($payload['LOGO']) ? $payload['LOGO'] : null; //can to be optional
        $this->pdfBase64    = isset($payload['PDF']) ? $payload['PDF'] : null;  //can to be optional
        $this->timbreBase64 = isset($payload['TIMBRE']) ? $payload['TIMBRE'] : null; //can to  be optional
        $this->xmlBase64    = isset($payload['XML']) ? $payload['TIMBRE'] : null; //can to be optional
    } // end function

    // FIXME: add comments
    public function saveFilesDte($strPath)
    {
        $checkFilesDTE = $this->checkFilesDTE();
        if($checkFilesDTE['status'] === 'error')
            throw new SaveFileDTEFieldsException($checkFilesDTE['error']); 
        
        return AllDteFileStorage::base64ToFile($strPath, $this->folio, $this->logoBase64, $this->pdfBase64, $this->timbreBase64, $this->xmlBase64);
    } // end function


    protected function checkFilesDte()
    {
        if(! isset($this->folio))
            return [
                "status" => "error",
                "error" => "DTE hasn't Folio Number",
            ];
        
        if( in_array("LOGO", $this->arrResponse) && ! isset($this->logoBase64))
            return [
                "status" => "error",
                "error" => "DTE hasn't Logo File",
            ];
        
        if( in_array("PDF", $this->arrResponse) && ! isset($this->pdfBase64))
            return [
                "status" => "error",
                "error" => "DTE hasn't PDF File",
            ];
        
        if( in_array("TIMBRE", $this->arrResponse) && ! isset($this->timbreBase64))
            return [
                "status" => "error",
                "error" => "DTE hasn't Timbre File",
            ];
        
        if( in_array("XML", $this->arrResponse) && ! isset($this->xmlBase64))
            return [
                "status" => "error",
                "error" => "DTE hasn't XML File",
            ];
        
        return [
            "status" => true
        ];
    } // end function


    // Getters

    /**
     * Get the value of oEncabezado
     */ 
    public function getOEncabezado()
    {
        return $this->oEncabezado;
    }

    /**
     * Get the value of oEmisor
     */ 
    public function getOEmisor()
    {
        return $this->oEmisor;
    }

    /**
     * Get the value of oEeceptor
     */ 
    public function getOReceptor()
    {
        return $this->oReceptor;
    }

    /**
     * Get the value of oTotal
     */ 
    public function getOTotal()
    {
        return $this->oTotal;
    }

    /**
     * Get the value of oDetalle
     */ 
    public function getODetalle()
    {
        return $this->oDetalle;
    }

    /**
     * Get the value of oDescuentoRecargoGlobal
     */ 
    public function getODescuentoRecargoGlobal()
    {
        return $this->oDescuentoRecargoGlobal;
    }

    /**
     * Get the value of oReferenciaOC
     */ 
    public function getOReferenciaOC()
    {
        return $this->oReferenciaOC;
    }


    /**
     * Get the value of arrResponse
     */ 
    public function getArrResponse()
    {
        return $this->arrResponse;
    }


} // end function
