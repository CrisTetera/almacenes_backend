<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhStockMovementPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_stock_movement_pos';

    /**
     * @var array
     */
    protected $fillable = ['wh_item_id', 'wh_warehouse_id', 'wh_product_id', 'quantity', 'flag_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whItem()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhItemPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProductPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehouse()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehousePos');
    }
}
