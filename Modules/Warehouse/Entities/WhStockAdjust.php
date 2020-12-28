<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_inventory_id
 * @property int $g_user_id
 * @property int $wh_warehouse_id
 * @property string $description
 * @property boolean $flag_delete
 * @property GUser $gUser
 * @property WhInventory $whInventory
 * @property WhWarehouse $whWarehouse
 * @property WhDetailStockAdjust[] $whDetailStockAdjusts
 * @property WhStockAdjustType $whStockAdjustType
 */
class WhStockAdjust extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_stock_adjust';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_inventory_id', 
        'g_user_id', 
        'wh_warehouse_id', 
        'description', 
        'flag_delete'
    ];



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
    public function whInventory()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhInventory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehouse()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehouse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailStockAdjusts()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailStockAdjust');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whStockAdjustType()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhStockAdjustType');
    }
}
