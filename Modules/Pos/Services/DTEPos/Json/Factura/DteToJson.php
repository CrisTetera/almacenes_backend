<?php

namespace Modules\Pos\Services\DTEPos\Json\Factura;

use Modules\Pos\Services\DTEPos\Entities\DTE\DTE;
use Modules\Pos\Services\DTEPos\Json\Factura\GenerateEncabezado;
use Modules\Pos\Services\DTEPos\Json\Factura\GenerateDetalle;
use Modules\Pos\Services\DTEPos\Json\Factura\GenerateDesctoRcgGlobal;
use Modules\Pos\Services\DTEPos\Json\Factura\GenerateReferenciaOC;

class DteToJson
{
    // Attributes
    private $dte;
    private $generateEncabezado;
    private $generateDetalle;
    private $generateDesctoRcgGlobal;
    private $generateReferenciaOC;

    public function __construct(DTE $dte)
    {
        $this->dte = $dte;
        $this->generateEncabezado = new GenerateEncabezado($dte);
        $this->generateDetalle = new GenerateDetalle($dte);
        $this->generateDesctoRcgGlobal = new GenerateDesctoRcgGlobal($dte);
        $this->generateReferenciaOC = new GenerateReferenciaOC($dte);
    } // end function

    public function getJson()
    {
        return [
            'response' => ["XML", "PDF", "TIMBRE", "LOGO", "FOLIO", "RESOLUCION"],
            'dte' => array_merge (
                        array('Encabezado' => $this->generateEncabezado->getEncabezado()),
                        array('Detalle' => $this->generateDetalle->getDetalle()),
                        ( //Optional
                            $this->dte->hasDescuentoGlobal() ? 
                            array('DscRcgGlobal' => $this->generateDesctoRcgGlobal->getDsctoRcgGlobal() ) : 
                            array()
                        ),
                        ( // Optional
                            $this->dte->hasReferenciaOC() ?
                            array('Referencia' => $this->generateReferenciaOC->getReferenciaOC() ) : 
                            array()
                        )
                    )
        ];

    } // end function
} // end class