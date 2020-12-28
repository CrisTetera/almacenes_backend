<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

class PosDailyCashPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_daily_cash_pos';

    protected $fillable = [
        'pos_cash_desk_id',
        'g_cashier_opening_user_id',
        'g_cashier_closure_user_id',
        'g_state_id',

        'opening_timestamp',
        'closure_timestamp',

        'ingress_total',
        'initial_amount_cash',

        'sales_total',
        'sales_cash_total',
        'sales_credit_total',
        'sales_debit_total',

        'ingress_cash_movement_total', 

        'egress_total', 
        'egress_cash_movement_total', 

        'estimated_cash_total', 
        'real_cash_total', 
        'difference', 

        'opening_observation',
        'closure_observation',

        'flag_open_daily_cash',
        'flag_delete'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posCashDeskPos()
    {
        return $this->belongsTo('Modules\General\Entities\PosCashDeskPos','pos_cash_desk_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUserOpeningCashierPos()
    {
        return $this->belongsTo('Modules\General\Entities\GUserPos', 'g_cashier_opening_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUserClosureCashierPos()
    {
        return $this->belongsTo('Modules\General\Entities\GUserPos', 'g_cashier_closure_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gStatePos()
    {
        return $this->belongsTo('Modules\General\Entities\GStatePos', 'g_state_id');
    }
}
