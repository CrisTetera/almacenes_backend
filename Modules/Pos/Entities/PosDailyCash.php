<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pos_cash_desk_id
 * @property int $g_user_id
 * @property int $g_user_id2
 * @property int $g_state_id
 * @property string $opening_timestamp
 * @property string $closure_timestamp
 * @property float $ingress_total
 * @property float $sale_with_cash_total
 * @property float $sale_with_card_total
 * @property float $ingress_cash_movement_total
 * @property float $egress_total
 * @property float $egress_cash_movement_total
 * @property float $estimated_cash_total
 * @property float $real_cash_total
 * @property float $difference
 * @property float $sale_with_check_total
 * @property boolean $flag_delete
 * @property GState $gState
 * @property GUser $gUser
 * @property PosCashDesk $posCashDesk
 * @property GUser $gUser
 */
class PosDailyCash extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_daily_cash';

    /**
     * @var array
     */
    protected $fillable = ['pos_cash_desk_id', 'g_user_id', 'g_user_id2', 'g_state_id', 'opening_timestamp', 'closure_timestamp', 'ingress_total', 'sale_with_cash_total', 'sale_with_card_total', 'ingress_cash_movement_total', 'egress_total', 'egress_cash_movement_total', 'estimated_cash_total', 'real_cash_total', 'difference', 'sale_with_check_total', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gState()
    {
        return $this->belongsTo('Modules\General\Entities\GState');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUserOpeningCashier()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_cashier_opening_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUserClosureCashier()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_cashier_closure_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posCashDesk()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosCashDesk');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUserSupervisor()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_cash_supervisor_user_id');
    }
}
