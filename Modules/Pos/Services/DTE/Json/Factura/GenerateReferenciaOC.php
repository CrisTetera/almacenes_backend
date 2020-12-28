<?php

namespace Modules\Pos\Services\DTE\Json\Factura;

use Modules\Pos\Services\DTE\Entities\DTE\DTE;

class GenerateReferenciaOC
{
    private $dte;

    public function __construct(DTE $dte)
    {
        $this->dte = $dte;
    } // end function

    public function getReferenciaOC()
    {
        return [
            'NroLinRef' => $this->dte->getOReferenciaOC()->getNroLinRef(),
            'TpoDocRef' => $this->dte->getOReferenciaOC()->getTpoDocRef(),
            'FolioRef' => $this->dte->getOReferenciaOC()->getFolioRef(),
            'RUTOtr' => $this->dte->getOReferenciaOC()->getRutOtr(),
            'FchRef' => $this->dte->getOReferenciaOC()->getFchRef(),
            'RazonRef' => $this->dte->getOReferenciaOC()->getRazonRef(),
        ];
    } // end function
} // end class