<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_state_id
 * @property int $g_user_id
 * @property string $number
 * @property string $description
 * @property string $dispatch_date
 * @property boolean $flag_delete
 * @property GState $gState
 * @property GUser $gUser
 * @property WhDetailDispatchOrder[] $whDetailDispatchOrders
 * @property WhDetailDispatchOrder[] $whDetailDispatchOrders
 */
class WhDispatchOrder extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_dispatch_order';

    /**
     * @var array
     */
    protected $fillable = ['g_state_id', 'g_user_id', 'number', 'description', 'dispatch_date', 'flag_delete'];



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
    public function gUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailDispatchOrders()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailDispatchOrder');
    }

}
