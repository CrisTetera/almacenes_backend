<?php

namespace Modules\Pos\Services\DTEPos\Entities\DTE;

use Modules\Pos\Services\DTEPos\Entities\SubsectionDTE\NotaCredito\Referencia;
use Modules\Pos\Services\DTEPos\Json\NotaCredito\DteToJson;
use Modules\Pos\Services\DTEPos\Request\GetDTE_DataFromOF;

class NotaCreditoFactura extends Factura
{ 
    // Constant
    private const CODE_NOTA_CREDITO = 61; 
    private const ACEPTED_BY_SII_STATE = 'Aceptado'; 
    private const PENDING_BY_SII_STATE = 'Pendiente'; 
    private const REJECTED_BY_SII_STATE = 'Rechazado'; 
    private const ACEPTED_WITH_OBJECTION_BY_SII_STATE = 'Aceptado con Reparo'; 

    // Variables
    private $documentRefToken;
    private $oReferencia;
    
    public function __construct($documentRefToken, $arrResponse = ["XML", "PDF", "TIMBRE", "LOGO", "FOLIO", "RESOLUCION"])
    {
        parent::__construct($arrResponse);
        $this->documentRefToken = $documentRefToken;
    } // end function

    /**
     * FIXME: Add comments
     */
    public function setEncabezado($folio, $fechaEmision, $bIsAfecta, $tipoTransaccionCompra, 
                                  $tipoTransaccionVenta, $formaPago, $indiceServicio = null)
    {
        parent::setEncabezado($folio, $fechaEmision, $bIsAfecta, $tipoTransaccionCompra, 
                              $tipoTransaccionVenta, $formaPago, $indiceServicio = null);
        $this->oEncabezado->setTypeDte(self::CODE_NOTA_CREDITO);
    } // end function

    /**
     * FIXME: Add comments
     */
    public function setReferencia($tpoDocRef, $folioRef, $fchaRef, $codRef, $razonRef)
    {
        $nroLinRef = 1; // set a default line reference
        $this->oReferencia = new Referencia($nroLinRef, $tpoDocRef, $folioRef, $fchaRef, $codRef, $razonRef);
    } // end function

    /**
     * FIXME: Add comments
     */
    public function getJson()
    {
        $json = Parent::getJson();
        
        $dteToJson = new DteToJson($this, $json);
        return $dteToJson->getCreditNoteJson_FromInvoice();
    }

    // FIXME: add comments
    public function sendDte()
    {
        $this->checkDTE_AceptedBySII();          
        return Parent::sendDte();
    } // end function

    // FIXME: add comments
    private function checkDTE_AceptedBySII()
    {
        $getDteDataFromOF = new GetDTE_DataFromOF();
        $response = $getDteDataFromOF->getDTE_Data($this->documentRefToken);
        
        if(
            isset($response['payload']) && 
            ( 
                $response['payload']['estado'] !== self::ACEPTED_BY_SII_STATE &&
                $response['payload']['estado'] !== self::ACEPTED_WITH_OBJECTION_BY_SII_STATE
            )
        )
            throw new \Exception("DTE no ha sido aceptado aún por el SII");

        return true;
    } // end function

    /**
     * Get the value of oReferencia
     */ 
    public function getOReferencia()
    {
        return $this->oReferencia;
    }

    /**
     * Get the value of documentRefToken
     */ 
    public function getDocumentRefToken()
    {
        return $this->documentRefToken;
    }
} // end function
