<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property PosCashDeskMovementPos[] $posCashMovements
 */
class PosMovementIngressTypePos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_movement_ingress_type_pos';

    /**
     * @var array
     */
    protected $fillable = ['type'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posCashDeskMovementsPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosCashDeskMovementPos','pos_cash_desk_movement_id');
    }
}
