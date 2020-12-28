<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhDetailStockAdjustPos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_detail_stock_adjust_pos';

    /**
     * @var array
     */
    protected $fillable = ['wh_stock_adjust_id', 'wh_item_id', 'wh_stock_adjust_id2', 'quantity_adjust', 'flag_delete'];

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
    public function whStockAdjust()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhStockAdjustPos');
    }
}
