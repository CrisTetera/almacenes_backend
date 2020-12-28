<?php

namespace Modules\Pos\Services\DTE\Json\Factura;

use Modules\Pos\Services\DTE\Entities\DTE\DTE;

class GenerateDesctoRcgGlobal
{
    private $dte;

    public function __construct(DTE $dte)
    {
        $this->dte = $dte;
    } // end function

    public function getDsctoRcgGlobal()
    {
        $arrDesctoRcgAfecto = (
            $this->dte->getODescuentoRecargoGlobal()->getValorDRAfecto() > 0 ? array_merge(
                array('NroLinDR' => 1), // for default, must to specific one
                array('TpoMov' => $this->dte->getODescuentoRecargoGlobal()->getTipoMovimiento()),
                array('TpoValor' => $this->dte->getODescuentoRecargoGlobal()->getTipoValor()),
                array('ValorDR' => $this->dte->getODescuentoRecargoGlobal()->getValorDRAfecto())
            ) : array() 
        );

        $arrDesctoRcgExento = (
            $this->dte->getODescuentoRecargoGlobal()->getValorDRExento() > 0 ? array_merge(
                array('NroLinDR' => 1), // for default, must to specific one
                array('TpoMov' => $this->dte->getODescuentoRecargoGlobal()->getTipoMovimiento()),
                array('TpoValor' => $this->dte->getODescuentoRecargoGlobal()->getTipoValor()),
                array('ValorDR' => $this->dte->getODescuentoRecargoGlobal()->getValorDRExento()),
                array('IndExeDR' => $this->dte->getODescuentoRecargoGlobal()->getValorDRExento())
            ) : array()
        );
        
        return count($arrDesctoRcgAfecto) > 0 && count($arrDesctoRcgExento) > 0 ? 
               [$arrDesctoRcgAfecto, $arrDesctoRcgExento]:
               array_merge($arrDesctoRcgAfecto, $arrDesctoRcgExento);
    } // end function
} // end class