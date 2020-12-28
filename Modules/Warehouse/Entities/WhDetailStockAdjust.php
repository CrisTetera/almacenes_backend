<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_stock_adjust_id
 * @property int $wh_item_id
 * @property int $wh_stock_adjust_id2
 * @property float $quantity_adjust
 * @property boolean $flag_delete
 * @property WhItem $whItem
 * @property WhStockAdjust $whStockAdjust
 */
class WhDetailStockAdjust extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_detail_stock_adjust';

    /**
     * @var array
     */
    protected $fillable = ['wh_stock_adjust_id', 'wh_item_id', 'wh_stock_adjust_id2', 'quantity_adjust', 'flag_delete'];

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
    public function whStockAdjust()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhStockAdjust');
    }
}
