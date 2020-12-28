<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

class PosSaleStockReservationPos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_sale_stock_reservation_pos';

    /**
     * @var array
     */
    protected $fillable = ['pos_sale_id', 'wh_warehouse_id', 'wh_item_id', 'stock', 'flag_delete'];


    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSalePos()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSalePos','pos_sale_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whWarehousePos()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhWarehousePos','wh_warehouse_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whItemPos()
    {
        return $this->belongsTo('Modules\Pos\Entities\WhItemPos','wh_item_id');
    }
}
