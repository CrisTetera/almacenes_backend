<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhInventoryPos extends Model
{
     /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_inventory_pos';

    /**
     * @var array
     */
    protected $fillable = ['wh_stock_adjust_id', 'g_user_id', 'wh_warehouse_id', 'g_user_id2', 'description', 'g_state_id', 'inventory_date', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUserSupervisor()
    {
        return $this->belongsTo('Modules\General\Entities\GUserPos', 'g_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gState()
    {
        return $this->belongsTo('Modules\General\Entities\GStatePos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUserWarehouseman()
    {
        return $this->belongsTo('Modules\General\Entities\GUserPos', 'g_user_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehouse()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehousePos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whStockAdjust()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhStockAdjustPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whDetailInventories()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhDetailInventoryPos');
    }
}
