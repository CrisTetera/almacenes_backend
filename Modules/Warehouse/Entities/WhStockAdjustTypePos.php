<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WhStockAdjustTypePos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_stock_adjust_type_pos';

    /**
     * @var array
     */
    protected $fillable = ['type', 'flag_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whStockAdjust()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhStockAdjustPos');
    }
}
