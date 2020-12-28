<?php

namespace Modules\Pos\Services\DTEPos\Json\Factura;

use Modules\Pos\Services\DTEPos\Entities\DTE\DTE;
use Modules\Pos\Services\DTEPos\Entities\DTE\Boleta;
use Modules\Pos\Services\DTEPos\Entities\DTE\Factura;

class GenerateEncabezado
{
    private $dte;

    public function __construct(DTE $dte)
    {
        $this->dte = $dte;
    } // end function

    public function getEncabezado()
    {
        return [
            'IdDoc' => $this->getIdDoc(),
            'Emisor' => $this->getEmisor(),
            'Receptor' => $this->getReceptor(),
            'Totales' => $this->getTotales(),
        ];
    } // end function

    private function getIdDoc()
    {
        return array_merge(
            array('TipoDTE' => $this->dte->getOEncabezado()->getTipoDte()),
            array('Folio' => $this->dte->getOEncabezado()->getFolio()),
            array('FchEmis' => $this->dte->getOEncabezado()->getFechaEmision()),
            ( // optional
                $this->dte->getOEncabezado()->getIndServicio() !== null ?
                array('IndServicio' => $this->dte->getOEncabezado()->getIndServicio()) : 
                array()
            ),
            array('TpoTranCompra' => $this->dte->getOEncabezado()->getTipoTransaccionCompra()),
            array('TpoTranVenta' => $this->dte->getOEncabezado()->getTipoTransaccionVenta()),
            array('FmaPago' => $this->dte->getOEncabezado()->getFormaPago())
        );
    }

    private function getEmisor()
    {
        return [
            'RUTEmisor' => $this->dte->getOEmisor()->getRutEmisor(),
            'RznSoc' => substr($this->dte->getOEmisor()->getRazonSocial(), 0, 100),
            'GiroEmis' => substr($this->dte->getOEmisor()->getGiroComercial(), 0, 80),
            'Acteco' => $this->dte->getOEmisor()->getCodActividadComercial(),
            'DirOrigen' => substr($this->dte->getOEmisor()->getDireccionOrigen(), 0, 60),
            'CmnaOrigen' => substr($this->dte->getOEmisor()->getComunaOrigen(), 0, 20),
            'CdgSIISucur' => $this->dte->getOEmisor()->getCodigoSucursalSII(),
        ];
    } // end function

    private function getReceptor()
    {
        return [
            'RUTRecep' => $this->dte->getOReceptor()->getRutReceptor(),
            'RznSocRecep' => substr($this->dte->getOReceptor()->getRazonSocialReceptor(), 0, 100),
            'GiroRecep' => substr($this->dte->getOReceptor()->getGiroReceptor(), 0, 40),
            'DirRecep' => substr($this->dte->getOReceptor()->getDireccionReceptor(), 0, 70),
            'CmnaRecep' => substr($this->dte->getOReceptor()->getComunaReceptor(), 0, 20),
        ];
    } // end function

    private function getTotales()
    {
        if($this->dte->getOTotal()->getMontoExe() == 0 && $this->dte->getOTotal()->getMontoNeto() > 0){
            return array_merge (
                array('MntNeto' => $this->dte->getOTotal()->getMontoNeto()),
                array('TasaIVA' => $this->dte->getOTotal()->getTasaIVA()),
                array('IVA' => $this->dte->getOTotal()->getIva()),
                array('MntTotal' => $this->dte->getOTotal()->getMontoTotal())
                
            );
        }else{
            if($this->dte->getOTotal()->getMontoExe() > 0 && $this->dte->getOTotal()->getMontoNeto() == 0){
                return array_merge (
                    // array('MntNeto' => $this->dte->getOTotal()->getMontoNeto()),
                    // array('TasaIVA' => $this->dte->getOTotal()->getTasaIVA()),
                    // array('IVA' => $this->dte->getOTotal()->getIva()),
                    array('MntTotal' => $this->dte->getOTotal()->getMontoTotal()),
                    array('MontoPeriodo' => $this->dte->getOTotal()->getMontoTotal()),
                    // array('VlrPagar' => $this->dte->getOTotal()->getMontoNeto()),
                    array('MntExe' => $this->dte->getOTotal()->getMontoExe())
                );
            }
            else{
                return array_merge (
                    array('MntNeto' => $this->dte->getOTotal()->getMontoNeto()),
                    array('TasaIVA' => $this->dte->getOTotal()->getTasaIVA()),
                    array('IVA' => $this->dte->getOTotal()->getIva()),
                    array('MntTotal' => $this->dte->getOTotal()->getMontoTotal()),
                    array('MontoPeriodo' => $this->dte->getOTotal()->getMontoTotal()),
                    // array('VlrPagar' => $this->dte->getOTotal()->getMontoNeto()),
                    array('MntExe' => $this->dte->getOTotal()->getMontoExe())
                );
            }
        }
        
    } // end function
} // end class