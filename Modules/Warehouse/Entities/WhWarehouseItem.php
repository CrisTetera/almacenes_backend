<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_warehouse_id
 * @property int $wh_item_id
 * @property float $stock
 * @property boolean $flag_delete
 * @property WhItem $whItem
 * @property WhWarehouse $whWarehouse
 */
class WhWarehouseItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_warehouse_item';

    /**
     * @var array
     */
    protected $fillable = ['wh_warehouse_id', 'wh_item_id', 'stock', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whItem()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehouse()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehouse');
    }
}
