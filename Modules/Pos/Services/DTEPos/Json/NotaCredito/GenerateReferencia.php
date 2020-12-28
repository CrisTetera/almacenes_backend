<?php

namespace Modules\Pos\Services\DTEPos\Json\NotaCredito;

use Modules\Pos\Services\DTEPos\Entities\DTE\DTE;
// use Modules\Pos\Services\DTEPos\Entities\DTE\Boleta;
// use Modules\Pos\Services\DTEPos\Entities\DTE\Factura;

class GenerateReferencia
{
    private $dte;

    public function __construct(DTE $dte)
    {
        $this->dte = $dte;
    } // end function

    public function getReferenciaJson()
    {
        return [
            'NroLinRef' => $this->dte->getOReferencia()->getNroLinRef(),
            'TpoDocRef' => $this->dte->getOReferencia()->getTpoDocRef(),
            'FolioRef' => $this->dte->getOReferencia()->getFolioRef(),
            'FchRef' => $this->dte->getOReferencia()->getFchaRef(),
            'CodRef' => $this->dte->getOReferencia()->getCodRef(),
            'RazonRef' => $this->dte->getOReferencia()->getRazonRef(),
        ];
    } // end function
} // end class