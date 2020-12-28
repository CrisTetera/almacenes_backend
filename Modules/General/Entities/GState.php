<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_state_type_id
 * @property string $state
 * @property int $state_sequence
 * @property GStateType $gStateType
 * @property PchPurchaseOrder[] $pchPurchaseOrders
 * @property PosDailyCash[] $posDailyCashes
 * @property WhDispatchOrder[] $whDispatchOrders
 * @property WhOrderer[] $whOrderers
 * @property PchPurchaseQuotation[] $pchPurchaseQuotations
 * @property PosEmployeeSale[] $posEmployeeSales
 */
class GState extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_state';

    /**
     * @var array
     */
    protected $fillable = ['g_state_type_id', 'state', 'state_sequence'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gStateType()
    {
        return $this->belongsTo('Modules\General\Entities\GStateType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchPurchaseOrders()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDailyCashes()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDailyCash');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDispatchOrders()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDispatchOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whOrderers()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhOrderer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchPurchaseQuotations()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchPurchaseQuotation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posEmployeeSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosEmployeeSale');
    }
}
