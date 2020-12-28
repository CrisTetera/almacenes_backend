<?php

namespace Modules\Pos\Services\DTE\Json\Boleta;

use Modules\Pos\Services\DTE\Entities\DTE\DTE;
use Modules\Pos\Services\DTE\Json\Boleta\GenerateEncabezado;
use Modules\Pos\Services\DTE\Json\Boleta\GenerateDetalle;
use Modules\Pos\Services\DTE\Json\Boleta\GenerateDesctoRcgGlobal;

class DteToJson
{
    // Attributes
    private $dte;
    private $generateEncabezado;
    private $generateDetalle;
    private $generateDesctoRcgGlobal;

    public function __construct(DTE $dte)
    {
        $this->dte = $dte;
        $this->generateEncabezado = new GenerateEncabezado($dte);
        $this->generateDetalle = new GenerateDetalle($dte);
        $this->generateDesctoRcgGlobal = new GenerateDesctoRcgGlobal($dte);
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
                        )
                    )
        ];

    } // end function
} // end class