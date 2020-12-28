<?php

namespace Modules\Pos\Services\DTEPos\Json\Boleta;

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
        return array_merge(
            array('IdDoc' => $this->getIdDoc()),
            array('Emisor' => $this->getEmisor()),
            ( // optional
                $this->dte->getOReceptor() !== null ?
                array('Receptor' => $this->getReceptor()) :
                array('Receptor' => ['RUTRecep' => '66666666-6'])
            ),
            array('Totales' => $this->getTotales())
        );
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
            )
        );
    }

    private function getEmisor()
    {
        return [
            'RUTEmisor' => $this->dte->getOEmisor()->getRutEmisor(),
            'RznSocEmisor' => substr($this->dte->getOEmisor()->getRazonSocial(), 0, 100),
            'GiroEmisor' => substr($this->dte->getOEmisor()->getGiroComercial(), 0, 80),
            // 'Acteco' => $this->dte->getOEmisor()->getCodActividadComercial(),
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
        return [
            'MntTotal' => $this->dte->getOTotal()->getMontoTotal(),
            // array('MontoPeriodo' => $this->dte->getOTotal()->getMontoNeto()),
            // array('VlrPagar' => $this->dte->getOTotal()->getMontoNeto()),
            'MntExe' => $this->dte->getOTotal()->getMontoExe()
        ];
    } // end function
} // end class