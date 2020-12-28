<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_item_id
 * @property int $wh_warehouse_id
 * @property int $wh_warehouse_movement_id
 * @property int $wh_product_id
 * @property float $quantity
 * @property boolean $flag_delete
 * @property WhItem $whItem
 * @property WhProduct $whProduct
 * @property WhWarehouse $whWarehouse
 * @property WhWarehouseMovement $whWarehouseMovement
 */
class WhStockMovement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_stock_movement';

    /**
     * @var array
     */
    protected $fillable = ['wh_item_id', 'wh_warehouse_id', 'wh_warehouse_movement_id', 'wh_product_id', 'quantity', 'flag_delete'];



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
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
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
    public function whWarehouseMovement()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehouseMovement');
    }
}
