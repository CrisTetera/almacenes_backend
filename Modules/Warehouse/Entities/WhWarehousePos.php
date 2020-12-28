<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhWarehousePos extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_warehouse_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whStockAdjusts()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhStockAdjustPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whStockMovements()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhStockMovementPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whItemsStockPos()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhItemStockPos','wh_warehouse_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whInventoriesPos()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhInventoryPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDetailPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDetailPos','wh_warehouse_id');
    }
    
}
