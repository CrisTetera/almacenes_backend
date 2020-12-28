<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pos_cash_movement_egress_type_id
 * @property int $pos_cash_movement_ingress_type_id
 * @property int $pos_cash_desk_id
 * @property int $g_user_id
 * @property float $amount
 * @property boolean $flag_delete
 * @property PosCashDesk $posCashDesk
 * @property GUser $gUser
 * @property PosCashMovementEgressType $posCashMovementEgressType
 * @property PosCashMovementIngressType $posCashMovementIngressType
 */
class PosCashMovement extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_cash_movement';

    /**
     * @var array
     */
    protected $fillable = ['pos_cash_movement_egress_type_id', 'pos_cash_movement_ingress_type_id', 'pos_cash_desk_id', 'g_user_id', 'amount', 'flag_delete'];



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
    public function gUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posCashMovementEgressType()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosCashMovementEgressType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posCashMovementIngressType()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosCashMovementIngressType');
    }
}
