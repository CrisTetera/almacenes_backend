<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhStockAdjustPos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_stock_adjust_pos';

    /**
     * @var array
     */
    protected $fillable = ['wh_inventory_id', 'g_user_id', 'wh_warehouse_id', 'description', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUserPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whInventory()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhInventoryPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehouse()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehousePos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailStockAdjusts()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailStockAdjustPos');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whStockAdjustType()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhStockAdjustTypePos');
    }
}
