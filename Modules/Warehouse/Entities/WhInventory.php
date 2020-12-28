<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_stock_adjust_id
 * @property int $g_user_id
 * @property int $wh_warehouse_id
 * @property int $g_user_id2
 * @property int $g_state_id
 * @property string $description
 * @property string $inventory_date
 * @property boolean $flag_delete
 * @property GUser $gUserWarehouseman
 * @property GUser $gUserSupervisor
 * @property WhWarehouse $whWarehouse
 * @property WhStockAdjust $whStockAdjust
 * @property WhDetailInventory[] $whDetailInventories
 * @property WhStockAdjust[] $whStockAdjusts
 * @property GState[] $gStates
 */
class WhInventory extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_inventory';

    /**
     * @var array
     */
    protected $fillable = ['wh_stock_adjust_id', 'g_user_id', 'wh_warehouse_id', 'g_user_id2', 'description', 'g_state_id', 'inventory_date', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUserSupervisor()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_user_id');
    }

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
    public function gUserWarehouseman()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_user_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehouse()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehouse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whStockAdjust()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhStockAdjust');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailInventories()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailInventory');
    }

}
