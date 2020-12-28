<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property PosCashMovement[] $posCashMovements
 */
class PosCashMovementIngressType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_cash_movement_ingress_type';

    /**
     * @var array
     */
    protected $fillable = ['type'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posCashMovements()
    {
        return $this->hasMany('Modules\Pos\Entities\PosCashMovement');
    }
}
