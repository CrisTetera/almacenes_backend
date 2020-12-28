<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhItemStockPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_item_stock_pos';

    /**
     * @var array
     */
    protected $fillable = ['wh_warehouse_id', 'wh_item_id', 'stock', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whItemPos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhItemPos', 'wh_item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehousePos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehousePos','wh_warehouse_id');
    }
}
