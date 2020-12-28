<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

class PosCashDeskMovementPos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_cash_desk_movement_pos';

    protected $fillable = [
        'pos_movement_egress_type_id',
        'pos_movement_ingress_type_id',
        'pos_cash_desk_id',
        'g_user_id',
        'amount',
        'movement_date',
        'observation',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posCashDeskPos()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosCashDeskPos', 'pos_cash_desk_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUserPos()
    {
        return $this->belongsTo('Modules\General\Entities\GUserPos' , 'g_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posMovementEgressTypePos()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosMovementEgressTypePos', 'pos_movement_egress_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posMovementIngressTypePos()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosMovementIngressTypePos', 'pos_movement_ingress_type_id');
    }
}
