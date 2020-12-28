<?php

namespace Modules\Pos\Services\DTE\Json\Factura;

use Modules\Pos\Services\DTE\Entities\DTE\DTE;

class GenerateDetalle
{
    private $dte;

    public function __construct(DTE $dte)
    {
        $this->dte = $dte;
    } // end function

    public function getDetalle()
    {
        $lineDetalle = [];
        
        foreach($this->dte->getODetalle() as $index => $detalle)
        {
            $lineDetalle[$index] = array_merge (
                ( // optional
                    $detalle->getIndExe() == 1 ? 
                    array('IndExe' => $detalle->getIndExe()) : 
                    array()
                ),
                array('NroLinDet' => $detalle->getNroLinDte()),
                array('NmbItem' => substr($detalle->getNmbItem(), 0, 80)),
                array('QtyItem' => $detalle->getQtyItem()),
                array('PrcItem' => $detalle->getPrcItem()),
                array('MontoItem' => $detalle->getMontoItem()),
                ( // optional
                    $detalle->getDescuentoPct() > 0 ? 
                    array('DescuentoPct' => $detalle->getDescuentoPct()) : 
                    array() 
                ),
                ( //optional
                    $detalle->getDescuentoMonto() > 0 ?
                    array('DescuentoMonto' => $detalle->getDescuentoMonto()) :  //FIXME: add real descuento monto 
                    array() 
                )
            );
        } 

        return $lineDetalle;
    } // end function

} // end class