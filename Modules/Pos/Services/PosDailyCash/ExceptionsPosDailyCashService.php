<?php

namespace Modules\Pos\Services\PosDailyCash;

use Modules\Pos\Entities\PosDailyCash;

class ExceptionsPosDailyCashService
{
    private const G_STATE_OPEN_DAILY_CASH = 20;

    /**
     * FIXME: add comments
     */
    public function checkNotAlreadyOpenCashDesk($idDeskCash)
    {
        $arrOpenPosDailyCash = PosDailyCash::where('g_state_id', self::G_STATE_OPEN_DAILY_CASH)
                                           ->where('pos_cash_desk_id', $idDeskCash)
                                           ->get();

        if(count($arrOpenPosDailyCash) > 0)
            throw new \Exception('La caja tiene una apertura de caja activa');
        else
            return true;
    }
    
} // end class