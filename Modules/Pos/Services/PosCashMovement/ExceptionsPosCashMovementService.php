<?php

namespace Modules\Pos\Services\PosCashMovement;

class ExceptionsPosCashMovementService
{
    /**
     * Check if there is only one type of cash movement
     * 
     * @param int idIngerss
     * @param int idEgress
     * @return bool
     */
    public function checkIsIngresOrEgressMovement($idIngress, $idEgress)
    {
        if ( (isset($idIngress) && ! isset($idEgress)) || 
           (! isset($idIngress) && isset($idEgress) )) 
        {
            return true;
        }
        else
            throw new \Exception("La solicitud de movimiento de caja debe ser de ingreso o egreso");

    } // end function
} // end class