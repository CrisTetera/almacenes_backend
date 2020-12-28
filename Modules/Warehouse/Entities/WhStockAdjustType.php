<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property boolean $flag_delete
 * @property WhStockAdjust $whStockAdjust
 */
class WhStockAdjustType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_stock_adjust_type';

    /**
     * @var array
     */
    protected $fillable = ['type', 'flag_delete'];

}
