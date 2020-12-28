<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

class PosCashDeskPos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_cash_desk_pos';

    protected $fillable = [
        'number',
        // 'g_state_id',
        'flag_delete',
    ];

    /*
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
    public function gStatePos()
    {
        return $this->belongsTo('Modules\General\Entities\GStatePos');
    }*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSalesPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSalePos','pos_cash_desk_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDailyCashPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDailyCashPos','pos_cash_desk_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posCashDeskMovementPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosCashDeskMovementPos','pos_cash_desk_id');
    }
}
