<?php

namespace Modules\Pos\Services\DTE\Json\NotaCredito;

use Modules\Pos\Services\DTE\Entities\DTE\DTE;

class DteToJson
{
    // Constant
    private const GENERIC_VOID_RUT = '66666666-6'; 
    private const TASA_IVA = 19; 
    private const ID_DETALLE_WITH_INCLUDED_IVA = 19; 
    
    // Attributes
    /**
    * DTE class for get Json format DTE
    *
    * @var Modules\Pos\Services\DTE\Entities\DTE\DTE Description
    */
    private $dte;

    /**
     * Json of ticket, for transnform to credit note
     * 
     * @var array
     */
    private $json;

    public function __construct(DTE $dte, array $json)
    {
        $this->dte = $dte;
        $this->json = $json;
    } // end function

    /**
     * FIXME: add comments
     */
    public function getCreditNoteJson_FromTicket()
    {
        // add new Credit Note Format Emisor
        $this->json['dte']['Encabezado']['Emisor'] = $this->getNewFormatEmisorDTE();

        // Add monto bruto to Encabezado (Detalle with Amount + IVA)
        $this->json['dte']['Encabezado']['IdDoc']['MntBruto'] = 1;

        // add new format receptor if is void
        if($this->json['dte']['Encabezado']['Receptor']['RUTRecep'] === self::GENERIC_VOID_RUT)
            $this->json['dte']['Encabezado']['Receptor'] = $this->getNewFormatReceptorDTE();

        // Add new Totales format
        $this->json['dte']['Encabezado']['Totales'] = $this->getNewFormatTotalesDTE();

        // add reference DTE
        $this->json['dte'] = array_merge(
            $this->json['dte'], 
            $this->getReferenceDTE()
        ); 
  
        return $this->json;
    } // end function


    /**
     * FIXME: add comments
     */
    public function getCreditNoteJson_FromInvoice()
    {
        // Delete TpoTranCompra (not requierd in Credit Note)
        unset($this->json['dte']['Encabezado']['IdDoc']['TpoTranCompra']);
        
        // add reference DTE
        $this->json['dte'] = array_merge(
            $this->json['dte'], 
            $this->getReferenceDTE()
        ); 
  
        return $this->json;
    } // end function

    /**
     * FIXME: add comments
     */
    private function getNewFormatEmisorDTE()
    {
        return [
            "RUTEmisor" => $this->dte->getOEmisor()->getRutEmisor(),
            "RznSoc" => substr($this->dte->getOEmisor()->getRazonSocial(), 0, 100),
            "GiroEmis" => substr($this->dte->getOEmisor()->getGiroComercial(), 0, 100),
            "Acteco" => $this->dte->getOEmisor()->getCodActividadComercial(),
            "DirOrigen" => substr($this->dte->getOEmisor()->getDireccionOrigen(), 0, 60),
            "CmnaOrigen" => substr($this->dte->getOEmisor()->getComunaOrigen(), 0, 20),
            "CdgSIISucur" => $this->dte->getOEmisor()->getCodigoSucursalSII(),
        ];
    } // end function
    
    /**
     * FIXME: add comments
     */
    private function getNewFormatReceptorDTE()
    {
        return [
            "RUTRecep" => self::GENERIC_VOID_RUT,
            "RznSocRecep" => "Contacto Anónimo",
            "GiroRecep" => "Sin datos",
            "DirRecep" => "Sin datos",
            "CmnaRecep" => "Sin datos",
        ];
    } // end function

    /**
     * FIXME: add comments
     */
    public function getNewFormatTotalesDTE()
    {
        $montoTotal = $this->json['dte']['Encabezado']['Totales']['MntTotal'];
        $montoNeto = round($montoTotal / 1.19);
        $iva = $montoTotal - $montoNeto;

        return [
            "MntNeto" => $montoNeto,
            "TasaIVA" => self::TASA_IVA,
            "IVA" => $iva,
            "MntTotal" => $montoTotal,
        ];
    } // end function
    
    /**
     * FIXME: add comments
     */
    private function getReferenceDTE()
    {
        $generarReferencia = new GenerateReferencia($this->dte);

        return [
            "Referencia" => $generarReferencia->getReferenciaJson()
        ];
    } // end function
} // end class